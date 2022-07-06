<?php
namespace App\Controllers;

use App\Config\Connection;

class CommonController
{
    public static function getCountries()
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare("SELECT * FROM countries");
        $stmt->execute();
        return $stmt->fetchAll($pdo::FETCH_OBJ);
    }
    public static function getStates()
    {
        $pdo = Connection::make();
        $stmt = $pdo->prepare("SELECT * FROM states");
        $stmt->execute();
        return $stmt->fetchAll($pdo::FETCH_OBJ);
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
            return ["user_id" => $_SESSION['user_id'], "anonimous_id" => ""];
        } else {
            if (!isset($_COOKIE['anonimous_id'])) {
                $anonimous_id = md5(time());
                setcookie('anonimous_id', $anonimous_id, time() + (86400 * 30), "/");
                return (object) ["user_id" => 0, "anonimous_id" => $anonimous_id];
            } else {
                return (object) ["user_id" => 0, "anonimous_id" => $_COOKIE['anonimous_id']];
            }            
        }
    }
}
?>