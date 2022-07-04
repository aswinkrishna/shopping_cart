<?php
namespace App\Config;

class Connection
{
    public static function make()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        try{
            return new \PDO("mysql:host=$servername;dbname=shopping_cart", $username, $password);
        } catch(\PDOException $e) {
            die("Connection Failed- ".$e->getMessage());
        }   
    }
}
?>