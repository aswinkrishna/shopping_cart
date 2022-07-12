<?php 
namespace App\Models;

use App\Config\Connection;
use App\Controllers\CommonController;

class CartModel
{
    private $pdo;
    private $user;

    public function __construct()
    {
        $this->pdo = Connection::make();
        $this->user = (object) CommonController::getUserData();
    }

    public function checkCartProductExists($productId)
    {
        $sql = "SELECT id from cart where product_id = :product_id and ";
        $condition = [];
        if ($this->user->userId != 0) {
            $sql .= "user_id = :user_id";
            $condition = ["user_id" => $this->user->userId];
        } else {
            $sql .= "anonimous_id = :anonimous_id";
            $condition = ["anonimous_id" => $this->user->anonimousId];
        }
        $condition['product_id'] = $productId;
        $cart_product_exists_query = $this->pdo->prepare($sql);
        $cart_product_exists_query->execute($condition);
        return $cart_product_exists_query->fetch($this->pdo::FETCH_OBJ);
    }

    public function addCartItem($cartData)
    {
        $cartQuery = $this->pdo->prepare("INSERT into cart(`user_id`, `anonimous_id`, `product_id`, `product_quantity`, `created_at`) values(:user_id, :anonimous_id, :product_id, :qty, :created_at)");
        $cartQuery->execute($cartData);
    }

    public function updateCartItem($additionalConditions)
    {
        $parameters = [];
        $sql = "UPDATE cart set product_quantity = product_quantity + :qty where product_id = :product_id";
        if ($this->user->user_id != 0) {
            $sql .= " and user_id = :user_id";
            $parameters = ["user_id" => $this->user->userId];
        } else {
            $sql .= " and anonimous_id = :anonimous_id";
            $parameters = ["anonimous_id" => $this->user->anonimousId];
        }
        $parameters['product_id'] = $additionalConditions['product_id'];
        $parameters['qty'] = $additionalConditions['qty'];
        $cart_query = $this->pdo->prepare($sql);
        $cart_query->execute($parameters);
    }
    
    public function increaseCartItem($parameters)
    {
        $cart_query = $this->pdo->prepare("UPDATE cart set product_quantity = product_quantity + :qty where product_id = :product_id and id = :cart_id");
        $cart_query->execute($parameters);
        return $this->pdo->lastInsertId();
    }

    public function reduceCartItem($parameters)
    {
        $sql = "UPDATE cart set product_quantity = product_quantity - :qty where product_id = :product_id and id = :cart_id";
        $cart_query = $this->pdo->prepare($sql);
        $cart_query->execute($parameters);
        
        // checking quantity is zero
        $check_quantity = $this->pdo->prepare("SELECT id,product_quantity from cart where product_id = :product_id and id = :cart_id");
        $check_quantity->execute(["cart_id" =>$parameters['cart_id'], "product_id" => $parameters['product_id']]);
        $result = $check_quantity->fetch($this->pdo::FETCH_OBJ);
        if ($result->product_quantity == 0) {
            return $this->removeCartItem(['cart_id' => $result->id]);
        }
    }

    public function removeCartItem($condition)
    {
        $cart_query = $this->pdo->prepare("DELETE from cart where id = :cart_id");
        $cart_query->execute($condition);
    }

    public function clearCart()
    {
        $sql = "DELETE from cart where ";
        $condition = [];
        if ($this->user->userId != 0) {
            $sql .= "user_id = :user_id";
            $condition = ["user_id" => $this->user->userId];
        } else {
            $sql .= "anonimous_id = :anonimous_id";
            $condition = ["anonimous_id" => $this->user->anonimousId];
        }
        $clear_cart_query = $this->pdo->prepare($sql);
        $clear_cart_query->execute($condition);
    }
}