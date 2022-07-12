<?php
namespace App\Libraries;

use App\Controllers\CommonController;
use App\Models\CartModel;

class Cart
{
    private $user;
    private $cartModel;

    public function __construct()
    {
        $this->user = (object) CommonController::getUserData();
        $this->cartModel = new CartModel();
    }
    
    public function getCart()
    {
        $data = [];
        $cartItems = $this->cartModel->getCart();
        $cartSubTotal = 0;
        $outOfStockProduct = 0;
        foreach ($cartItems as $items) {
            $cartSubTotal += $items->product_total;
            if ($items->product_stock <= 0) {
                $outOfStockProduct = 1;
            }
        }
        $cartSummary['out_of_stock_product'] = $outOfStockProduct;
        $cartSummary['sub_total'] = $cartSubTotal;
        $cartSummary['shipping_charge'] = 0;
        $cartSummary['discount'] = 0;
        $cartSummary['vat'] = 0;
        $cartSummary['grand_total'] = $cartSummary['sub_total'] - $cartSummary['discount'] + $cartSummary['shipping_charge'];
        
        $data = (object) $cartSummary;
        $data->cart_items = (object) $cartItems;
        return (object) $data;
    }
}