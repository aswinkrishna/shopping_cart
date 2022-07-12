<?php
require_once './config.php';

use App\Controllers\OrderController;

$order = new OrderController();
$action = $_POST['action'];
if (!method_exists($order,$action)) {
    echo json_encode(['status'=>0,"message"=>"Something went wrong !"]);
    die;
}
$response = $order->{$action}();
echo json_encode($response);
?>