<?php

require 'env.php';


$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB1_DATABASE);
$conn_game = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB2_DATABASE);

if (!$conn)
{
    die("Connection failed on database 1: ". mysqli_connect_error());
}
if (!$conn_game)
{
    die("Connection failed on database 2: ". mysqli_connect_error());
}
