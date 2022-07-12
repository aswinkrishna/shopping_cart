<?php
namespace App\Controllers;

use App\Config\Connection;
use App\Models\UserModel;

class UserController 
{
    private $pdo;
    private $userModel;

    public function __construct()
    {
        $this->pdo = Connection::make();
        $this->userModel = new UserModel();
    }

    public function createUser($post_data = [])
    {        
        $alreadyExists = $this->userModel->checkEmailAlreadyExists(["email_address" => $post_data['email_address']]);
        if ($alreadyExists != 0) {
            return ['status'=>2,"message"=>"Email is already Exists !"];
        }
        $userData = [
            "first_name" => $post_data['first_name'],
            "last_name" => $post_data['last_name'],
            "user_email" => trim($post_data['email_address']),
            "user_password" => passwordEncrypt($post_data['password']),
            "country_code" => $post_data['country'],
            "user_mobile" => $post_data['mobile_number'],
            "created_at" => date("Y-m-d H:i:s"),
        ];
        $userId = $this->userModel->createNewUser($userData);
        if ($userId == 0) {
            return ['status'=>0,"message"=>"Signup Failed"];
        } 
        return ['status'=>1,"message"=>"Signup Successfull"];
    }

    public function userLogin($postData = [])
    {
        $authStatus = $this->userModel->userAuthCheck($postData);
        if ($authStatus == 0) {
            return ['status'=>0,"message"=>"Invalid Credentials"];
        }
        $userData = $this->userModel->getUserData(['email_address' => $postData['email_address']]);
        $_SESSION['user_id'] = $userData->id;
        $_SESSION['user_name'] = $userData->first_name." ".$userData->last_name;

        // updating anonimous user cart products
        $anonimousId = $_COOKIE['anonimous_id'];
        $this->userModel->updateAnonimousUserCart(["user_id" => $userData->id, "anonimous_id" => $anonimousId]);
        return ['status'=>1,"message"=>"login Successfull"];
    }
}
?>