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
    public function createUser($post_data)
    {        
        $query = $this->pdo->prepare("SELECT * from users where user_email =:email_address");
        $query->execute(["email_address" => $post_data['email_address']]);
        $already_exists = $query->rowCount();
        if($already_exists == 0) {
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
            if($this->pdo->lastInsertId()) {
                return ['status'=>1,"message"=>"Signup Successfull"];
            } else {
                return ['status'=>0,"message"=>"Signup Failed"];
            }            
        } else {
            return ['status'=>2,"message"=>"Email is already Exists !"];
        }
    }
    public function userLogin($post_data)
    {
        $query = $this->pdo->prepare("SELECT * from users where user_email= :email_address and user_password = :user_password");
        $query->execute(["email_address" => trim($post_data['email_address']), "user_password" => md5(trim($post_data['user_password']))]);
        if($query->rowCount() > 0) {
            $user_data = $query->fetch($this->pdo::FETCH_OBJ);
            $_SESSION['user_id'] = $user_data->id;
            $_SESSION['user_name'] = $user_data->first_name." ".$user_data->last_name;
            return ['status'=>1,"message"=>"login Successfull"];
        } else {
            return ['status'=>0,"message"=>"Invalid Credentials"];
        }
    }
}
?>