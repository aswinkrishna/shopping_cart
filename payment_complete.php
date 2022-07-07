<?php
require_once './config.php';

use App\Controllers\CartController;
use App\Controllers\CommonController;

$transaction_no = CommonController::decrypt($_GET['transaction_id']);
$cart = new CartController();
$response = $cart->paymentSuccess($transaction_no);
if ($response)
{
    header('Location:success?transaction_no='.$_GET['transaction_id']);
}
else
{
    header('Location:checkout');
}
?>