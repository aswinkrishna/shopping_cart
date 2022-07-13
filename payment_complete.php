<?php
require_once './config.php';

use App\Controllers\OrderController;

$transaction_no = decrypt($_GET['transaction_id']);
$cart = new OrderController();
$response = $cart->completeOrder($transaction_no);
if ($response)
{
    header('Location:success?transaction_no='.$_GET['transaction_id']);
}
else
{
    header('Location:checkout');
}
?>