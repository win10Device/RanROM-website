<?php

session_start();

require '../assets/setup/env.php';
require '../assets/setup/db.inc.php';
require '../assets/includes/auth_functions.php';
require '../assets/includes/security_functions.php';
if (isset($_SESSION['auth'])) {
    if (isset($_SESSION['expire']) && $_SESSION['expire'] < time() - 864100) { //Delete way too old sessions
    	session_unset();
        session_destroy();
        echo 'logout_redirect';
    } else {
    	$_SESSION['expire'] = ALLOWED_INACTIVITY_TIME;
    }
}

generate_csrf_token();
check_remember_me();
if (!empty($_SESSION['deleted_at'])) {
	header("Location: ../logout");
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo APP_DESCRIPTION;  ?>">
    <meta name="author" content="<?php echo APP_OWNER;  ?>">

    <title><?php echo TITLE . ' | ' . APP_NAME; ?></title>
    <!<link rel="icon" type="image/png" href="../assets/images/favicon.png">
    <link rel="icon" type="image/png" href="../assets/images/chip1(1).ico">

    <link rel="stylesheet" href="../assets/vendor/bootstrap-4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/fontawesome-6.2.1-web/css/all.min.css">
 
    <!-- Custom styles -->
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="custom.css" >

</head>

<?php require 'navbar.php'; ?>

