<?php
namespace App\Models;

use App\Core\CoreModel;

class AuthModel extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function userAuthCheck($postData)
    {
        $query = $this->pdo->prepare("SELECT * from users where user_email= :email_address and user_password = :user_password");
        $query->execute(["email_address" => trim($postData['email_address']), "user_password" => passwordEncrypt($postData['user_password'])]);
        return $query->rowCount();
    }

    public function getUserData($condition)
    {
        $query = $this->pdo->prepare("SELECT * from users where user_email= :email_address");
        $query->execute($condition);
        return $query->fetch($this->pdo::FETCH_OBJ);
    }

    public function updateGuestUserCart($condition)
    {
        $this->pdo->prepare("UPDATE cart set `user_id`= :user_id where anonimous_id = :anonimous_id")->execute($condition);
    }
}