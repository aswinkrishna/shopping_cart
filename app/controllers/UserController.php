<?php
namespace App\Controllers;

use App\Config\Connection;

class UserController 
{
    private $pdo;
    
    public function __construct()
    {
        $this->pdo = Connection::make();
    }
    public function createUser($post_data = [])
    {        
        $query = $this->pdo->prepare("SELECT * from users where user_email =:email_address");
        $query->execute(["email_address" => $post_data['email_address']]);
        $already_exists = $query->rowCount();
        if ($already_exists == 0) {
            $insert_data = [
                "first_name" => $post_data['first_name'],
                "last_name" => $post_data['last_name'],
                "user_email" => trim($post_data['email_address']),
                "user_password" => md5(trim($post_data['password'])),
                "country_code" => $post_data['country'],
                "user_mobile" => $post_data['mobile_number'],
                "created_at" => date("Y-m-d H:i:s"),
            ];
            $new_user_query = $this->pdo->prepare("INSERT INTO `users`(`first_name`, `last_name`, `user_email`, `user_password`, `user_mobile`, `country_code`, `created_at`) VALUES (:first_name, :last_name, :user_email, :user_password, :user_mobile, :country_code, :created_at)");
            $new_user_query->execute($insert_data);
            if ($this->pdo->lastInsertId()) {
                return ['status'=>1,"message"=>"Signup Successfull"];
            } else {
                return ['status'=>0,"message"=>"Signup Failed"];
            }            
        } else {
            return ['status'=>2,"message"=>"Email is already Exists !"];
        }
    }
    public function userLogin($post_data = [])
    {
        $query = $this->pdo->prepare("SELECT * from users where user_email= :email_address and user_password = :user_password");
        $query->execute(["email_address" => trim($post_data['email_address']), "user_password" => md5(trim($post_data['user_password']))]);
        if ($query->rowCount() > 0) {
            $user_data = $query->fetch($this->pdo::FETCH_OBJ);
            $_SESSION['user_id'] = $user_data->id;
            $_SESSION['user_name'] = $user_data->first_name." ".$user_data->last_name;

            // updating anonimous cart products
            $anonimous_id = $_COOKIE['anonimous_id'];
            $this->pdo->prepare("UPDATE cart set `user_id`= :user_id where anonimous_id = :anonimous_id")->execute(["user_id" => $user_data->id, "anonimous_id" => $anonimous_id]);
            return ['status'=>1,"message"=>"login Successfull"];
        } else {
            return ['status'=>0,"message"=>"Invalid Credentials"];
        }
    }

    public function addNewShippingAddress($post_data = [])
    {
        $insert_data = [
            "user_id" => $_SESSION['user_id'],
            "full_name" => $post_data['shipping_full_name'],
            "address_line_1" => $post_data['shipping_address_line1'],
            "address_line_2" => $post_data['shipping_address_line2'],
            "country_id" => $post_data['shipping_country'],
            "state_id" => $post_data['shipping_state'],
            "city" => $post_data['shipping_city'],
            "zipcode" => $post_data['shipping_zipcode'],
            "created_at" => date('Y-m-d H:i:s'),
            "is_default" => 1,
            "is_deleted" => 0,
        ];
        try {
            $this->pdo->beginTransaction();
            $this->pdo->prepare("UPDATE `user_shipping_addresses` set is_default = 0 where user_id = :user_id")->execute(["user_id" => $_SESSION['user_id']]);
            $shipping_address_query = $this->pdo->prepare("INSERT INTO `user_shipping_addresses`(`user_id`, `full_name`, `address_line_1`, `address_line_2`, `country_id`, `state_id`, `city`, `zipcode`, `created_at`, `is_default`, `is_deleted`) VALUES (:user_id, :full_name, :address_line_1, :address_line_2, :country_id, :state_id, :city, :zipcode, :created_at, :is_default, :is_deleted)");
            $shipping_address_query->execute($insert_data);
            $this->pdo->commit();
            return ["status" => 1, "message" => "New address added"];
        } catch(\PDOException $e) {
            $this->pdo->rollBack();
            return ["status" => 0, "message" => "Please try again !"];
        }
    }

    public function getAllShippingAddresses()
    {
        $query = $this->pdo->prepare("SELECT user_shipping_addresses.*, countries.country_name, states.state_name    from `user_shipping_addresses` LEFT JOIN countries on user_shipping_addresses.country_id = countries.id LEFT JOIN states on user_shipping_addresses.state_id = states.id where user_shipping_addresses.user_id = :user_id");
        $query->execute(["user_id" => $_SESSION['user_id']]);
        $result = $query->fetchAll($this->pdo::FETCH_OBJ);
        return $result;
    }
}
?>