<?php
require_once './config.php';

use App\Controllers\PaymentController;

$payment = new PaymentController();
$response = $payment->make();
echo json_encode($response);
?>