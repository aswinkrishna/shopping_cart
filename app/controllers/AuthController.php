<?php
namespace App\Controllers;

use App\Models\AuthModel;

class AuthController 
{
    private $authModel;
    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function login()
    {
        $postData = $_POST;
        $authStatus = $this->authModel->userAuthCheck($postData);
        if ($authStatus == 0) {
            return ['status'=>0,"message"=>"Invalid Credentials"];
        }
        $userData = $this->authModel->getUserData(['email_address' => $postData['email_address']]);
        $_SESSION['user_id'] = $userData->id;
        $_SESSION['user_name'] = $userData->first_name." ".$userData->last_name;

        // updating anonimous user cart products
        $anonimousId = $_COOKIE['anonimous_id'];
        $this->authModel->updateGuestUserCart(["user_id" => $userData->id, "anonimous_id" => $anonimousId]);
        return ['status'=>1,"message"=>"login Successfull"];
    }
}