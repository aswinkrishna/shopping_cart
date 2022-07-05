<?php
namespace App\Controllers;

use App\Config\Connection;
use App\Controllers\CommonController;
use stdClass;

class CartController
{
    private $pdo;
    private $user;
    
    public function __construct()
    {
        $this->pdo = Connection::make();
        $this->user = (object) CommonController::getUserData();
    }

    public function addCartItem($product_id, $qty)
    {
        // validating product
        $query = $this->pdo->prepare('SELECT id, product_name, product_stock from products where is_deleted = 0 and product_status = 1 and id = :product_id');
        $query->execute(["product_id" => $product_id]);
        $product_data = $query->fetch($this->pdo::FETCH_OBJ);

        if(!empty($product_data)) {
            if($product_data->product_stock > 0) {
                // check product already in cart
                if(empty($this->checkCartProductExists($product_id))) {
                    $cart_data = [
                        "user_id" => $this->user->user_id,
                        "anonimous_id" => $this->user->anonimous_id,
                        "product_id" => $product_id,
                        "qty" => $qty,
                        "created_at" => date('Y-m-d H:i:s'),
                    ];
                    $cart_query = $this->pdo->prepare("INSERT into cart(`user_id`, `anonimous_id`, `product_id`, `product_quantity`, `created_at`) values(:user_id, :anonimous_id, :product_id, :qty, :created_at)");
                    $cart_query->execute($cart_data);
                    return ["status" => "1", "message" => "Product added to Cart"];
                } else {
                    $parameters = [];
                    $sql = "UPDATE cart set product_quantity = product_quantity + :qty where product_id = :product_id";
                    if($this->user->user_id != 0) {
                        $sql .= " and user_id = :user_id";
                        $parameters = ["user_id" => $this->user->user_id];
                    } else {
                        $sql .= " and anonimous_id = :anonimous_id";
                        $parameters = ["anonimous_id" => $this->user->anonimous_id];
                    }
                    $parameters['product_id'] = $product_id;
                    $parameters['qty'] = $qty;
                    $cart_query = $this->pdo->prepare($sql);
                    $cart_query->execute($parameters);
                    return ["status" => "1", "message" => "Product quantity updated in Cart"];
                }
            } else {
                return ["status" => "0", "message" => "Product is out of stock"];
            }
        } else {
            return ["status" => "0", "message" => "Product is not available !"];
        }
    }

    public function increaseCartItem($product_id, $qty)
    {
        if(!empty($this->checkCartProductExists($product_id))) {
            $parameters = [];
            $sql = "UPDATE cart set product_quantity = product_quantity+:qty where product_id = :product_id";
            if($this->user->user_id != 0) {
                $sql .= "and user_id = :user_id";
                $parameters = ["user_id" => $this->user->user_id];
            } else {
                $sql .= "and anonimous_id = :anonimous_id";
                $parameters = ["anonimous_id" => $this->user->anonimous_id];
            }
            $parameters['product_id'] = $product_id;
            $parameters['qty'] = $qty;
            $cart_query = $this->pdo->prepare($sql);
            $cart_query->execute($parameters);
            return ["status" => "1", "message" => "Product quantity updated in Cart"];
        } else {
            return ["status" => "0", "message" => "Product is not available in your Cart"];
        }
    }
    
    public function reduceCartItem($product_id, $qty)
    {
        if(!empty($this->checkCartProductExists($product_id))) {
            $parameters = [];
            $sql = "UPDATE cart set product_quantity = product_quantity-:qty where product_id = :product_id";
            if($this->user->user_id != 0) {
                $sql .= "and user_id:user_id";
                $parameters = ["user_id" => $this->user->user_id];
            } else {
                $sql .= "and anonimous_id:anonimous_id";
                $parameters = ["anonimous_id" => $this->user->anonimous_id];
            }
            $parameters['product_id'] = $product_id;
            $parameters['qty'] = $qty;
            $cart_query = $this->pdo->prepare($sql);
            $cart_query->execute($parameters);
            return ["status" => "1", "message" => "Product quantity updated in Cart"];
        } else {
            return ["status" => "0", "message" => "Product is not available in your Cart"];
        }
    }

    public function removeCartItem($product_id)
    {
        $cart_product = $this->checkCartProductExists($product_id);
        if(!empty($cart_product)) {     
            $cart_query = $this->pdo->prepare("DELETE from cart where id = :cart_id");
            $cart_query->execute(["cart_id" => $cart_product->id]);
            return ["status" => "1", "message" => "Product removed from Cart"];
        } else {
            return ["status" => "0", "message" => "Product is not available in your Cart"];
        }
    }

    public function getTotalCartItem()
    {

    }

    public function getCart()
    {
        $data = [];
        $sql = "SELECT cart.product_quantity, products.product_id, products.product_name, products.product_image, products.product_regular_price, products.product_sale_price, products.product_stock from cart LEFT JOIN products on cart.product_id = products.id where products.product_status = 1 and products.is_deleted = 0";
        $condition = [];
        if($this->user->user_id != 0) {
            $sql .= "user_id = :user_id";
            $condition = ["user_id" => $this->user->user_id];
        } else {
            $sql .= "anonimous_id = :anonimous_id";
            $condition = ["anonimous_id" => $this->user->anonimous_id];
        }
        $cart_product_query = $this->pdo->prepare($sql);
        $cart_product_query->execute($condition);
        $data['cart_items'] = $cart_product_query->fetchAll($this->pdo::FETCH_OBJ);

        $cart_summary = [];
        foreach($data['cart_items'] as $items) {
            
        }

        return (object) $data;
    }
    
    private function checkCartProductExists($product_id)
    {
        $sql = "SELECT id from cart where product_id = :product_id and ";
        $condition = [];
        if($this->user->user_id != 0) {
            $sql .= "user_id = :user_id";
            $condition = ["user_id" => $this->user->user_id];
        } else {
            $sql .= "anonimous_id = :anonimous_id";
            $condition = ["anonimous_id" => $this->user->anonimous_id];
        }
        $condition['product_id'] = $product_id;
        $cart_product_exists_query = $this->pdo->prepare($sql);
        $cart_product_exists_query->execute($condition);
        return $cart_product_exists_query->fetch($this->pdo::FETCH_OBJ);
    }
}