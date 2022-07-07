<?php
require_once './config.php';

use App\Controllers\PaymentController;

$payment = new PaymentController();

$jsonStr = file_get_contents('php://input');
$jsonObj = json_decode($jsonStr);

$response = $payment->stripePayment($jsonObj);
echo json_encode($response);
?>