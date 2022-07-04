<?php
namespace App\Controllers;

use App\Config\Connection;
use App\Controllers\CommonController;

class CartController
{
    private $pdo;
    private $user;
    public function __construct()
    {
        $this->pdo = Connection::make();
        $this->user = CommonController::getUserData();
    }
    public function addCartItem()
    {

    }
    public function removeCartItem()
    {

    }
    public function clearCart()
    {

    }
    public function getTotalCartItem()
    {

    }
    public function getCart()
    {

    }
}