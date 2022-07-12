<?php
namespace App\Controllers;

use App\Config\Connection;
use App\Controllers\CommonController;
use App\Libraries\Cart;
use App\Models\CartModel;
use App\Models\OrderModel;

class OrderController
{
    private $pdo;
    private $user;
    private $cartModel;
    private $orderModel;
    public $cart;

    public function __construct()
    {
        $this->pdo = Connection::make();
        $this->user = (object) CommonController::getUserData();
        $this->cart = new Cart();
        $this->cartModel = new CartModel();
        $this->orderModel = new OrderModel();
    }

    public function placeOrder($post_data)
    {
        $cart_data = $this->cart->getCart();
        $this->orderModel->clearTempOrder();
        if ($cart_data->out_of_stock_product == 1) {
            return ["status" => 1, "message" => "Some of your product in cart is out of stock"];
        }
        $tempOrderData = [
            "order_no" => "ES".date('Ymd').time(),
            "user_id" => $this->user->userId,
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
            $order_id = $this->orderModel->createTempOrder($tempOrderData);
            foreach ($cart_data->cart_items as $item) {
                $tempProductData = [
                    "order_id" => $order_id,
                    "product_id" => $item->product_id,
                    "purchase_quantity" => $item->product_quantity,
                    "unit_price" => $item->product_sale_price,
                    "total_price" => $item->product_total,
                ];
                $this->orderModel->createTempOrderDetails($tempProductData);
            }
            $this->pdo->commit();
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            return ["status" => 0, "message" => "Something went Wrong !", "call_back" => 0];
        }
        if ($post_data['payment_type'] == 1) {
            return [
                "status" => 1, 
                "message" => "Payment", 
                "call_back" => 1, 
                "call_back_url" => "payment", 
                "transaction_no" => CommonController::encrypt($tempOrderData['transaction_no'])
            ];
        } else {
            if ($this->paymentSuccess($tempOrderData['transaction_no']) === true) {
                return [
                    "status" => 1, 
                    "message" => "Order Successfull", 
                    "call_back" => 1, 
                    "call_back_url" => "success", 
                    "transaction_no" => CommonController::encrypt($tempOrderData['transaction_no'])
                ];
            } else {
                return ["status" => 0, "message" => "Order Failed", "call_back" => 0];
            }
        }
    }

    public function paymentSuccess($transactionNo = "")
    {
        $tempOrderCondition = ['transaction_no' => $transactionNo];
        if ($this->orderModel->validateTempOrder($tempOrderCondition) == 0) {
            return false;
        } 
        try {
            $this->pdo->beginTransaction();
            $temp_order_data = $this->orderModel->getTempOrder($tempOrderCondition);
            $orderData = [
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
            $orderId = $this->orderModel->createOrder($orderData);

            // fetch temp products
            $tempProducts = $this->orderModel->getTempOrderDetails(["order_id" => $temp_order_data->id]);
            foreach ($tempProducts as $item) {
                $ProductData = [
                    "order_id" => $orderId,
                    "product_id" => $item->product_id,
                    "purchase_quantity" => $item->purchase_quantity,
                    "unit_price" => $item->unit_price,
                    "total_price" => $item->total_price,
                    "product_order_status" => 1,
                ];
                $this->orderModel->createOrderDetails($ProductData);

                // update product stock
                $this->orderModel->updateProductStock(["purchase_quantity" => $item->purchase_quantity, "product_id" => $item->product_id]);
            }
            $this->cartModel->clearCart();
            $this->orderModel->clearTempOrder();
            $this->pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            return ["status" => 0, "message" => "Something went Wrong !"];
        }
    }
}