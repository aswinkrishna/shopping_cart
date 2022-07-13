<?php
namespace App\Controllers;

use App\Controllers\CommonController;
use App\Libraries\Cart;
use App\Models\CartModel;
use App\Models\ProductModel;

class CartController
{
    private $user;
    private $cartModel;
    public $cart;

    
    public function __construct()
    {
        $this->user = (object) CommonController::getUserData();
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
        $this->cart = new Cart();
    }

    public function add()
    {
        $productId = $_POST['product_id'];
        $qty = $_POST['qty'];
        if ($response = $this->validatingProduct($productId)) {
            return $response;
        }

        if (empty($this->checkCartProductExists($productId))) {
            $cartData = [
                "user_id" => $this->user->userId,
                "anonimous_id" => $this->user->anonimousId,
                "product_id" => $productId,
                "qty" => $qty,
                "created_at" => date('Y-m-d H:i:s'),
            ];
            $this->cartModel->addCartItem($cartData);
            return ["status" => "1", "message" => "Product added to Cart"];
        } else {
            $this->cartModel->updateCartItem(['product_id' => $productId, 'qty' => $qty]);
            return ["status" => "1", "message" => "Product quantity updated in Cart"];
        }
    }

    public function update()
    {
        $cartId = $_POST['cart_id'];
        $productId = $_POST['product_id'];
        $qty = $_POST['qty'];
        $operatiion = $_POST['operatiion'];
        if (empty($this->checkCartProductExists($productId))) {
            return ["status" => "0", "message" => "Product is not available in your Cart"];
        }
        $parameters = [
            'cart_id' => $cartId,
            'product_id' => $productId,
            'qty' => $qty
        ];
        if ($operatiion == 'plus') {
            $this->cartModel->increaseCartItem($parameters);
        } else {
            $this->cartModel->reduceCartItem($parameters);
        }
        return ["status" => "1", "message" => "Product quantity updated in Cart", "data" => $this->cart->getCart()];
    }
    
    public function delete()
    {
        $productId = $_POST['product_id'];
        $cart_product = $this->checkCartProductExists($productId);
        if (empty($cart_product)) {     
            return ["status" => "0", "message" => "Product is not available in your Cart"];
        }
        $condition = ["cart_id" => $cart_product->id];
        $this->cartModel->removeCartItem($condition);
        return ["status" => "1", "message" => "Product removed from Cart", "data" => $this->cart->getCart()];
    }
    
    private function checkCartProductExists($productId)
    {
        $CartProductData = $this->cartModel->checkCartProductExists($productId);
        return $CartProductData;
    }

    public function clearCart()
    {
        $this->cartModel->clearCart();
        return true;
    }

    public function validatingProduct($productId)
    {
        $condition = ["product_id" => $productId];
        $productData =  $this->productModel->getProductData($condition); 
        if (empty($productData)) {
            return ["status" => "0", "message" => "Product is not available !"];  
        }
        if ($productData->product_stock <= 0) { 
            return ["status" => "0", "message" => "Product is out of stock"];
        } 
    }
}