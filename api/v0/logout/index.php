<?php
header('Content-Type: application/json; charset=utf-8');

/*$json = file_get_contents('php://input');
$data = json_decode($json);

if (empty($json)) {
    $temp['error'] = "Null Request";
    die(json_encode($temp));
}
if (empty($data->username)) {
    $temp['error'] = "Invaild Request";
    die(json_encode($temp));
}*/

session_start();
session_unset();
session_destroy();

if(empty($_SESSION)) {
    $temp['success'] = "session destroyed";
    echo json_encode($temp);
    unset($temp);
}
//echo $_SESSION['auth'];
