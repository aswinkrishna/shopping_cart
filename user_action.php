<?php
require_once './config.php';

use App\Controllers\AddressController;
use App\Controllers\UserController;

$user = new UserController();
$address = new AddressController();
if (!empty($_POST)) {
    $action = $_POST['form_action'];
    switch ($action) {
        case 'new_user':
            $response = $user->createUser($_POST);
            echo json_encode($response);
            break;
        case 'login':
            $response = $user->userLogin($_POST);
            echo json_encode($response);
            break;
        case 'add_address':
            $response = $address->addNewShippingAddress($_POST);
            echo json_encode($response);
            break;  
        case 'get_all_addresses':
            $response = $address->getAllShippingAddresses();
            echo json_encode(["status" => 1, "message" => "Success", "data" => $response]);
            break;          
        default:
            echo json_encode(['status'=>0,"message"=>"Something went wrong !"]);
            break;
    }
} else {
    echo json_encode(['status'=>0,"message"=>"Something went wrong !"]);
}
?>
