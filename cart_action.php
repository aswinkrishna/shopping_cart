<?php
require_once './config.php';

use App\Controllers\CartController;

$cart = new CartController();

if(!empty($_POST)) {
    $action = $_POST['action'];
    switch ($action) {
        case 'add':
            $response = $cart->addCartItem($_POST['product_id'],$_POST['qty']);
            echo json_encode($response);
            break;
        case 'increase':
            $response = $cart->increaseCartItem($_POST['product_id'],$_POST['qty']);
            echo json_encode($response);
            break;
        case 'reduce':
            $response = $cart->reduceCartItem($_POST['product_id'],$_POST['qty']);
            echo json_encode($response);
            break;            
        case 'remove':
            $response = $cart->removeCartItem($_POST['product_id']);
            echo json_encode($response);
            break;        
        default:
            echo json_encode(['status'=>0,"message"=>"Something went wrong !"]);
            break;
    }
}

?>