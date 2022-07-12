<?php
namespace App\Models;

use App\Config\Connection;

class UserModel
{
    public function __construct()
    {
        $this->pdo = Connection::make();
    }

    public function checkEmailAlreadyExists($condition)
    {
        $query = $this->pdo->prepare("SELECT * from users where user_email =:email_address");
        $query->execute($condition);
        return $query->rowCount();
    }

    public function createNewUser($userData)
    {
        $new_user_query = $this->pdo->prepare("INSERT INTO `users`(`first_name`, `last_name`, `user_email`, `user_password`, `user_mobile`, `country_code`, `created_at`) VALUES (:first_name, :last_name, :user_email, :user_password, :user_mobile, :country_code, :created_at)");
        $new_user_query->execute($userData);
        return $this->pdo->lastInsertId();
    }

    public function getUserData($condition)
    {
        $query = $this->pdo->prepare("SELECT * from users where user_email= :email_address");
        $query->execute($condition);
        return $query->fetch($this->pdo::FETCH_OBJ);
    }

    public function updateAnonimousUserCart($condition)
    {
        $this->pdo->prepare("UPDATE cart set `user_id`= :user_id where anonimous_id = :anonimous_id")->execute($condition);
    }
}