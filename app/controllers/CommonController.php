<?php
namespace App\Controllers;

use App\Models\CommonModel;

class CommonController
{
    private $commonModel;
    
    public function __construct()
    {
        $this->commonModel = new CommonModel();
    }

    public function getCountries()
    {
        return $this->commonModel->getCountries();        
    }
    
    public function getStates()
    {
        return $this->commonModel->getStates();
    }

    public static function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function getUserData()
    {
        if (isset($_SESSION['user_id'])) {
            return (object) ["user_id" => $_SESSION['user_id'], "anonimous_id" => "", "userId" => $_SESSION['user_id'], "anonimousId" => ""];
        } else {
            if (!isset($_COOKIE['anonimous_id'])) {
                $anonimous_id = md5(time());
                setcookie('anonimous_id', $anonimous_id, time() + (86400 * 30), "/");
            }         
            return (object) ["user_id" => 0, "anonimous_id" => $_COOKIE['anonimous_id'], "userId" => 0, "anonimousId" => $_COOKIE['anonimous_id']];
        }
    }

    public static function encrypt($string)
    {
        return base64_encode($string);
    }

    public static function decrypt($string)
    {
        return base64_decode($string);
    }
}
?>