<?php
namespace App\Controllers;

use App\Config\Connection;
use App\Models\ProductModel;

class ProductController
{
    private $pdo;
    private $productModel;
    
    public function __construct()
    {
        $this->pdo = Connection::make();
        $this->productModel = new ProductModel();
    }
    
    public function getAllProducts()
    {
        $products = $this->productModel->getAllProducts();
        return $products;
    }
}