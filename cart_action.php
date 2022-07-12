<?php
require_once './config.php';

use App\Controllers\CartController;

$cart = new CartController();
$action = $_POST['action'];
if (!method_exists($cart,$action)) {
    echo json_encode(['status'=>0,"message"=>"Something went wrong !"]);
}
$response = $cart->{$action}();
echo json_encode($response);

?>