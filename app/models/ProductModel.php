<?php
namespace App\Models;

use App\Config\Connection;
use App\Controllers\CommonController;

class ProductModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::make();
    }

    public function getProductData($condition)
    {
        $query = $this->pdo->prepare('SELECT id, product_name, product_stock from products where is_deleted = 0 and product_status = 1 and id = :product_id');
        $query->execute($condition);
        return $query->fetch($this->pdo::FETCH_OBJ);
    }
}