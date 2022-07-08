<?php
namespace App\Controllers;

use App\Config\Connection;
use App\Controllers\CommonController;
use App\Libraries\Cart;

class CartController
{
    private $pdo;
    private $user;
    public $cart;
    
    public function __construct()
    {
        $this->pdo = Connection::make();
        $this->user = (object) CommonController::getUserData();
        $this->cart = new Cart(); 
    }

    public function addCartItem($product_id, $qty)
    {
        // validating product
        $query = $this->pdo->prepare('SELECT id, product_name, product_stock from products where is_deleted = 0 and product_status = 1 and id = :product_id');
        $query->execute(["product_id" => $product_id]);
        $product_data = $query->fetch($this->pdo::FETCH_OBJ);

        if (!empty($product_data)) {
            if ($product_data->product_stock > 0) {
                // check product already in cart
                if (empty($this->checkCartProductExists($product_id))) {
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
                    if ($this->user->user_id != 0) {
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

    public function increaseCartItem($cart_id, $product_id, $qty)
    {
        if (!empty($this->checkCartProductExists($product_id))) {
            $parameters = [];
            $sql = "UPDATE cart set product_quantity = product_quantity + :qty where product_id = :product_id and id = :cart_id";
            $parameters['cart_id'] = $cart_id;
            $parameters['product_id'] = $product_id;
            $parameters['qty'] = $qty;
            $cart_query = $this->pdo->prepare($sql);
            $cart_query->execute($parameters);
            return ["status" => "1", "message" => "Product quantity updated in Cart", "data" => $this->cart->getCart()];
        } else {
            return ["status" => "0", "message" => "Product is not available in your Cart"];
        }
    }
    
    public function reduceCartItem($cart_id, $product_id, $qty)
    {
        if (!empty($this->checkCartProductExists($product_id))) {
            $parameters = [];
            $sql = "UPDATE cart set product_quantity = product_quantity - :qty where product_id = :product_id and id = :cart_id";
            $parameters['cart_id'] = $cart_id;
            $parameters['product_id'] = $product_id;
            $parameters['qty'] = $qty;
            $cart_query = $this->pdo->prepare($sql);
            $cart_query->execute($parameters);
            // checking quantity is zero
            $check_quantity = $this->pdo->prepare("SELECT product_quantity from cart where product_id = :product_id and id = :cart_id");
            $check_quantity->execute(["cart_id" =>$cart_id, "product_id" => $product_id]);
            $result = $check_quantity->fetch($this->pdo::FETCH_OBJ);
            if ($result->product_quantity == 0) {
                return $this->removeCartItem($product_id);
            }
            return ["status" => "1", "message" => "Product quantity reduced in Cart", "data" => $this->cart->getCart()];
        } else {
            return ["status" => "0", "message" => "Product is not available in your Cart"];
        }
    }

    public function removeCartItem($product_id)
    {
        $cart_product = $this->checkCartProductExists($product_id);
        if (!empty($cart_product)) {     
            $cart_query = $this->pdo->prepare("DELETE from cart where id = :cart_id");
            $cart_query->execute(["cart_id" => $cart_product->id]);
            return ["status" => "1", "message" => "Product removed from Cart", "data" => $this->cart->getCart()];
        } else {
            return ["status" => "0", "message" => "Product is not available in your Cart"];
        }
    }
    
    private function checkCartProductExists($product_id)
    {
        $sql = "SELECT id from cart where product_id = :product_id and ";
        $condition = [];
        if ($this->user->user_id != 0) {
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

    public function clearCart()
    {
        $sql = "DELETE from cart where ";
        $condition = [];
        if ($this->user->user_id != 0) {
            $sql .= "user_id = :user_id";
            $condition = ["user_id" => $this->user->user_id];
        } else {
            $sql .= "anonimous_id = :anonimous_id";
            $condition = ["anonimous_id" => $this->user->anonimous_id];
        }
        $clear_cart_query = $this->pdo->prepare($sql);
        $clear_cart_query->execute($condition);
        return true;
    }

    public function placeOrder($post_data)
    {
        $cart_data = $this->cart->getCart();
        $this->clearTempOrder();
        if ($cart_data->out_of_stock_product == 1) {
            return ["status" => 1, "message" => "Some of your product in cart is out of stock"];
        } else {
            $temp_order_data = [
                "order_no" => "ES".date('Ymd').time(),
                "user_id" => $this->user->user_id,
                "sub_total" => (float) $cart_data->sub_total,
                "total_price" => (float) $cart_data->grand_total,
                "discount_price" => (float) $cart_data->discount,
                "shipping_charge" => (float) $cart_data->shipping_charge,
                "vat_price" => 0,
                "shipping_address_id" => (int) $post_data['shipping_address_id'],
                "payment_type" => (int) $post_data['payment_type'],
                "transaction_no" => time(),
            ];
            try {
                $this->pdo->beginTransaction();
                $temp_order_query = $this->pdo->prepare("INSERT INTO `temp_orders`(`order_no`, `user_id`, `sub_total`, `total_price`, `discount_price`, `shipping_charge`, `vat_price`, `shipping_address_id`, `payment_type`, `transaction_no`) 
                VALUES(:order_no, :user_id, :sub_total, :total_price, :discount_price, :shipping_charge, :vat_price, :shipping_address_id, :payment_type, :transaction_no)");
                $temp_order_query->execute($temp_order_data);
                $order_id = $this->pdo->lastInsertId();
                foreach ($cart_data->cart_items as $item) {
                    $temp_product_data = [
                        "order_id" => $order_id,
                        "product_id" => $item->product_id,
                        "purchase_quantity" => $item->product_quantity,
                        "unit_price" => $item->product_sale_price,
                        "total_price" => $item->product_total,
                    ];
                    $temp_product_query = $this->pdo->prepare("INSERT INTO `temp_order_details`(`order_id`, `product_id`, `purchase_quantity`, `unit_price`, `total_price`) VALUES (:order_id, :product_id, :purchase_quantity, :unit_price, :total_price)");
                    $temp_product_query->execute($temp_product_data);
                }
                $this->pdo->commit();
            } catch (\PDOException $e) {
                $this->pdo->rollBack();
                return ["status" => 0, "message" => "Something went Wrong !", "call_back" => 0];
            }
            if ($post_data['payment_type'] == 1) {
                return ["status" => 1, "message" => "Payment", "call_back" => 1, "call_back_url" => "payment", "transaction_no" => CommonController::encrypt($temp_order_data['transaction_no'])];
            } else {
                if ($this->paymentSuccess($temp_order_data['transaction_no']) === true) {
                    return ["status" => 1, "message" => "Order Successfull", "call_back" => 1, "call_back_url" => "success", "transaction_no" => CommonController::encrypt($temp_order_data['transaction_no'])];
                } else {
                    return ["status" => 0, "message" => "Order Failed", "call_back" => 0];
                }
            }
        }
    }

    public function paymentSuccess($transaction_no = "")
    {
        $temp_order_query = $this->pdo->prepare("SELECT * from `temp_orders` where transaction_no = :transaction_no");
        $temp_order_query->execute(['transaction_no' => $transaction_no]);
        if ($temp_order_query->rowCount() > 0) {
            try {
                $this->pdo->beginTransaction();
                $temp_order_data = $temp_order_query->fetch($this->pdo::FETCH_OBJ);
                $order_data = [
                    "order_no" => $temp_order_data->order_no,
                    "user_id" => (int) $temp_order_data->user_id,
                    "sub_total" => (float) $temp_order_data->sub_total,
                    "total_price" => (float) $temp_order_data->total_price,
                    "discount_price" => (float) $temp_order_data->discount_price,
                    "shipping_charge" => (float) $temp_order_data->shipping_charge,
                    "vat_price" => (float) $temp_order_data->vat_price,
                    "shipping_address_id" => (int) $temp_order_data->shipping_address_id,
                    "payment_type" => (int) $temp_order_data->payment_type,
                    "payment_status" => (int) ($temp_order_data->payment_type == 1) ? 1 : 0,
                    "transaction_no" => $temp_order_data->transaction_no,
                ];
                $order_query = $this->pdo->prepare("INSERT INTO `orders`(`order_no`, `user_id`, `sub_total`, `total_price`, `discount_price`, `shipping_charge`, `vat_price`, `shipping_address_id`, `payment_type`, `payment_status`, `transaction_no`) VALUES(:order_no, :user_id, :sub_total, :total_price, :discount_price, :shipping_charge, :vat_price, :shipping_address_id, :payment_type, :payment_status, :transaction_no)");
                $order_query->execute($order_data);
                $order_id = $this->pdo->lastInsertId();

                // fetch temp products
                $temp_product_query = $this->pdo->prepare("SELECT * from temp_order_details where order_id = :order_id");
                $temp_product_query->execute(["order_id" => $temp_order_data->id]);
                $temp_products = $temp_product_query->fetchAll($this->pdo::FETCH_OBJ);
                foreach ($temp_products as $item) {
                    $temp_product_data = [
                        "order_id" => $order_id,
                        "product_id" => $item->product_id,
                        "purchase_quantity" => $item->purchase_quantity,
                        "unit_price" => $item->unit_price,
                        "total_price" => $item->total_price,
                        "product_order_status" => 1,
                    ];
                    $order_details_query = $this->pdo->prepare("INSERT INTO `order_details`(`order_id`, `product_id`, `purchase_quantity`, `unit_price`, `total_price`, `product_order_status`) VALUES (:order_id, :product_id, :purchase_quantity, :unit_price, :total_price, :product_order_status)");
                    $order_details_query->execute($temp_product_data);

                    // update product stock
                    $product_stock_query = $this->pdo->prepare("UPDATE products set product_stock = product_stock - :purchase_quantity where id = :product_id");
                    $product_stock_query->execute(["purchase_quantity" => $item->purchase_quantity, "product_id" => $item->product_id]);
                }
                $this->clearCart();
                $this->clearTempOrder();
                $this->pdo->commit();
                return true;
            } catch (\PDOException $e) {
                $this->pdo->rollBack();
                return ["status" => 0, "message" => "Something went Wrong !"];
            }
        } else {
            return false;
        }
    }

    public function clearTempOrder()
    {
        $temp_order_query = $this->pdo->prepare("SELECT * from `temp_orders` where user_id = :user_id");
        $temp_order_query->execute(['user_id' => $this->user->user_id]);
        if ($temp_order_query->rowCount() > 0) {
            $temp_order_data = $temp_order_query->fetch($this->pdo::FETCH_OBJ);
            $this->pdo->prepare("DELETE from `temp_orders` where user_id = :user_id")->execute(['user_id' => $this->user->user_id]);
            $this->pdo->prepare("DELETE from `temp_order_details`  where order_id = :order_id")->execute(["order_id" => $temp_order_data->id]);
        } 
    }
}