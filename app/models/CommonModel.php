<?php
namespace App\Models;

use App\Core\CoreModel;

class CommonModel extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCountries()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM countries");
        $stmt->execute();
        return $stmt->fetchAll($this->pdo::FETCH_OBJ);
    }

    public function getStates()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM states");
        $stmt->execute();
        return $stmt->fetchAll($this->pdo::FETCH_OBJ);
    }
}