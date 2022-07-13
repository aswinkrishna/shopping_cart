<?php
namespace App\Controllers;

use App\Models\ProductModel;

class ProductController
{
    private $productModel;
    
    public function __construct()
    {
        $this->productModel = new ProductModel();
    }
    
    public function getAllProducts()
    {
        $products = $this->productModel->getAllProducts();
        return $products;
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