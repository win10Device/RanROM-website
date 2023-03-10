<?php
//$data = /** whatever you're serializing **/;
$array0 = array("{$_SERVER['REQUEST_METHOD']}", "1");
$data['Hello'] = 'World!';

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
