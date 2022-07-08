<?php
namespace App\Controllers;

use App\Config\Connection;

class ProductController
{
    private $pdo;
    
    public function __construct()
    {
        $this->pdo = Connection::make();
    }
    
    public function getAllProducts()
    {
        $query = $this->pdo->prepare("SELECT id, product_name, product_description, product_code, product_image, product_regular_price, product_sale_price from products where product_status = 1 and product_stock > 0 and is_deleted = 0");
        $query->execute();
        $products = $query->fetchAll($this->pdo::FETCH_OBJ);
        return $products;
    }
}