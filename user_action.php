<?php
require_once './config.php';

use App\Controllers\UserController;

$user = new UserController();
if(!empty($_POST))
{
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

        default:
            # code...
            break;
    }
}
?>
