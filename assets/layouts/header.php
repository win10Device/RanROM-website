<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/session.php";
//new MySessionHandler();
//session_start();

require "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/env.php";
require "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/db.inc.php";
require "{$_SERVER['DOCUMENT_ROOT']}/assets/includes/auth_functions.php";
require "{$_SERVER['DOCUMENT_ROOT']}/assets/includes/security_functions.php";
if (isset($_SESSION['auth'])) {
    if (isset($_SESSION['expire']) && $_SESSION['expire'] < time() - 864100) { //Delete way too old sessions
    	session_unset();
        session_destroy();
	header("Location: /logout");
        echo 'logout_redirect';
    } else {
    	$_SESSION['expire'] = ALLOWED_INACTIVITY_TIME;
    }
}
if (isset($_SESSION['SESSION_TYPE'])) {
    if ($_SESSION['SESSION_TYPE'] != "GUI") {
        session_unset();
        session_destroy();
        header("Location: /logout");
        echo 'logout_redirect';
    }
}

generate_csrf_token();
check_remember_me();
if (!empty($_SESSION['deleted_at'])) {
	header("Location: /logout");
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
    <!-- link rel="icon" type="image/png" href="/assets/images/favicon.png" -->
    <link rel="icon" type="image/png" href="/assets/images/chip1(1).ico">

    <!-- link rel="stylesheet" href="/assets/vendor/bootstrap/5.0.2/css/bootstrap.min.css" -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- link rel="stylesheet" href="/assets/vendor/bootstrap/4.3.1/css/bootstrap.min.css" -->
    <link rel="stylesheet" href="/assets/vendor/fontawesome-6.2.1-web/css/all.min.css">

    <!-- Custom styles -->
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="custom.css" >

    <script src="/assets/vendor/alerty/js/alerty.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/vendor/alerty/css/alerty.min.css">
</head>
<?php require 'navbar.php';?>
