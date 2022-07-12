<?php
require_once './config.php';

$className = "App\\Controllers\\".$_POST['class'];
$method = $_POST['action_method'];
if (!class_exists($className)) {
    echo json_encode(['status'=>0,"message"=>"Class does not exists !"]);
    exit;
}
$classObject = new $className();
if (!method_exists($className,$method)) {
    echo json_encode(['status'=>0,"message"=>"Method does not exists !"]);
    exit;
}
echo json_encode($classObject->{$method}());
?>