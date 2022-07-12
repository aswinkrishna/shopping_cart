<?php
namespace App\Models;

use App\Config\Connection;
use App\Controllers\CommonController;

class OrderModel
{
    private $pdo;
    private $user;

    public function __construct()
    {
        $this->pdo = Connection::make();
        $this->user = (object) CommonController::getUserData();
    }

    public function createTempOrder($tempOrderData)
    {
        $temp_order_query = $this->pdo->prepare("INSERT INTO `temp_orders`(`order_no`, `user_id`, `sub_total`, `total_price`, `discount_price`, `shipping_charge`, `vat_price`, `shipping_address_id`, `payment_type`, `transaction_no`) VALUES(:order_no, :user_id, :sub_total, :total_price, :discount_price, :shipping_charge, :vat_price, :shipping_address_id, :payment_type, :transaction_no)");
        $temp_order_query->execute($tempOrderData);
        return $this->pdo->lastInsertId();
    }

    public function createTempOrderDetails($tempProductData)
    {
        $tempProductQuery = $this->pdo->prepare("INSERT INTO `temp_order_details`(`order_id`, `product_id`, `purchase_quantity`, `unit_price`, `total_price`) VALUES (:order_id, :product_id, :purchase_quantity, :unit_price, :total_price)");
        $tempProductQuery->execute($tempProductData);
    }

    public function getTempOrder($condition)
    {
        $temp_order_query = $this->pdo->prepare("SELECT * from `temp_orders` where transaction_no = :transaction_no");
        $temp_order_query->execute($condition);
        return $temp_order_query->fetch($this->pdo::FETCH_OBJ);
    }

    public function getTempOrderDetails($condition)
    {
        $temp_product_query = $this->pdo->prepare("SELECT * from temp_order_details where order_id = :order_id");
        $temp_product_query->execute($condition);
        return $temp_product_query->fetchAll($this->pdo::FETCH_OBJ);
    }

    public function createOrder($orderData)
    {
        $order_query = $this->pdo->prepare("INSERT INTO `orders`(`order_no`, `user_id`, `sub_total`, `total_price`, `discount_price`, `shipping_charge`, `vat_price`, `shipping_address_id`, `payment_type`, `payment_status`, `transaction_no`) VALUES(:order_no, :user_id, :sub_total, :total_price, :discount_price, :shipping_charge, :vat_price, :shipping_address_id, :payment_type, :payment_status, :transaction_no)");
        $order_query->execute($orderData);
        return $this->pdo->lastInsertId();
    }

    public function createOrderDetails($productData)
    {
        $order_details_query = $this->pdo->prepare("INSERT INTO `order_details`(`order_id`, `product_id`, `purchase_quantity`, `unit_price`, `total_price`, `product_order_status`) VALUES (:order_id, :product_id, :purchase_quantity, :unit_price, :total_price, :product_order_status)");
        $order_details_query->execute($productData);
    }

    public function updateProductStock($parameters)
    {
        $product_stock_query = $this->pdo->prepare("UPDATE products set product_stock = product_stock - :purchase_quantity where id = :product_id");
        $product_stock_query->execute($parameters);
    }

    public function validateTempOrder($condition)
    {
        $temp_order_query = $this->pdo->prepare("SELECT * from `temp_orders` where transaction_no = :transaction_no");
        $temp_order_query->execute($condition);
        return $temp_order_query->rowCount();
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