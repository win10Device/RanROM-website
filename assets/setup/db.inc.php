<?php

require 'env.php';


$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB1_DATABASE);

if (!$conn)
{
    die("Connection failed on database 1: ". mysqli_connect_error());
}
