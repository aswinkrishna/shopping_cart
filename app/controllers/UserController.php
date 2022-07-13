<?php
namespace App\Controllers;

use App\Models\UserModel;

class UserController 
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function create($post_data = [])
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
}
?>