<?php
namespace App\Models;

use App\Config\Connection;

class AddressModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::make();    
    }

    public function addNewAddress($addressData)
    {
        try {
            $this->pdo->beginTransaction();
            $this->pdo->prepare("UPDATE `user_shipping_addresses` set is_default = 0 where user_id = :user_id")->execute(["user_id" => $_SESSION['user_id']]);
            $shipping_address_query = $this->pdo->prepare("INSERT INTO `user_shipping_addresses`(`user_id`, `full_name`, `address_line_1`, `address_line_2`, `country_id`, `state_id`, `city`, `zipcode`, `created_at`, `is_default`, `is_deleted`) VALUES (:user_id, :full_name, :address_line_1, :address_line_2, :country_id, :state_id, :city, :zipcode, :created_at, :is_default, :is_deleted)");
            $shipping_address_query->execute($addressData);
            $this->pdo->commit();
            return ["status" => 1, "message" => "New address added"];
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            return ["status" => 0, "message" => "Please try again !"];
        }
    }

    public function getAllAddress($condition)
    {
        $query = $this->pdo->prepare("SELECT user_shipping_addresses.*, countries.country_name, states.state_name    from `user_shipping_addresses` LEFT JOIN countries on user_shipping_addresses.country_id = countries.id LEFT JOIN states on user_shipping_addresses.state_id = states.id where user_shipping_addresses.user_id = :user_id");
        $query->execute($condition);
        return $query->fetchAll($this->pdo::FETCH_OBJ);
    }
}