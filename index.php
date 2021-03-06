<?php
// error_reporting(0);
include 'routes.php';
require_once 'config.php';

$request = $_SERVER['REQUEST_URI'];
$router = new Router($request); 
$router->get('/', 'app/views/home');
$router->get('/home', 'app/views/home');
$router->get('/cart','app/views/cart');
$router->get('/checkout','app/views/checkout');
$router->get('/product','app/views/product');
$router->get('/login','app/views/login');
$router->get('/logout','logout');
$router->get('/payment','app/views/payment');
$router->get('/success','app/views/success');
?>