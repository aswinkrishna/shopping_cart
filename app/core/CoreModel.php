<?php
namespace App\Core;

use App\Config\Connection;

class CoreModel
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = Connection::make();
    }
}