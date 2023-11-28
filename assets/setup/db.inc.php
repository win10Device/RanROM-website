<?php

$trigger_test = false; //Causes a connection attempt with null password, which will throw SQL error 1045
require 'env.php';

$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB1_DATABASE);
$sess = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB2_DATABASE);
if ($trigger_test) {
    $conn = mysqli_connect(DB_HOST, DB_USERNAME, null, DB1_DATABASE);
}

if (mysqli_connect_errno())
{
    if (!str_contains($_SERVER['REQUEST_URI'], "/api/v0/")) {
        include("{$_SERVER['DOCUMENT_ROOT']}/error/error.php");
        ErrorType(0, mysqli_connect_errno());

        //die(file_get_contents("{$_SERVER['DOCUMENT_ROOT']}/error/error.php")); //mysqli_connect_error());
    }
}
//require_once "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/session.php";
