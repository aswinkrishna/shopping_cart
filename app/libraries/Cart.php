<?php
namespace App\Libraries;

use App\Config\Connection;
use App\Controllers\CommonController;

class Cart
{
    private $pdo;
    private $user;

    public function __construct()
    {
        $this->pdo = Connection::make();
        $this->user = (object) CommonController::getUserData();
    }
    
    public function getCart()
    {
        $data = [];
        $sql = "SELECT cart.id as cart_id, cart.product_quantity, products.id as product_id, products.product_name, products.product_code, products.product_image, products.product_regular_price, products.product_sale_price, products.product_stock,(products.product_sale_price * cart.product_quantity) as product_total from cart LEFT JOIN products on cart.product_id = products.id where products.product_status = 1 and products.is_deleted = 0";
        $condition = [];
        if ($this->user->user_id != 0) {
            $sql .= " and cart.user_id = :user_id";
            $condition = ["user_id" => $this->user->user_id];
        } else {
            $sql .= " and cart.anonimous_id = :anonimous_id";
            $condition = ["anonimous_id" => $this->user->anonimous_id];
        }
        $sql .= " group by cart.product_id";
        $cart_product_query = $this->pdo->prepare($sql);
        $cart_product_query->execute($condition);
        $cart_items = $cart_product_query->fetchAll($this->pdo::FETCH_OBJ);

        $cart_sub_total = 0;
        $out_of_stock_product = 0;
        foreach ($cart_items as $items) {
            $cart_sub_total += $items->product_total;
            if ($items->product_stock <= 0) {
                $out_of_stock_product = 1;
            }
        }
        $cart_summary['out_of_stock_product'] = $out_of_stock_product;
        $cart_summary['sub_total'] = $cart_sub_total;
        $cart_summary['shipping_charge'] = 0;
        $cart_summary['discount'] = 0;
        $cart_summary['grand_total'] = $cart_summary['sub_total'] - $cart_summary['discount'] + $cart_summary['shipping_charge'];
        
        $data = (object) $cart_summary;
        $data->cart_items = (object) $cart_items;
        return (object) $data;
    }
}