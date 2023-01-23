<?php

define('TITLE', "Home");
include '../assets/layouts/header.php';


//$c = "http://$a/test2/send-key?$b";
//header("Location: $c");
//echo $c;
//check_verified();
//http_response_code(204);
//exit();

if ($_SERVER['QUERY_STRING'] != "") {

    // WARNING: Never use confidential strings for prefix!
    $newid = $_SERVER['QUERY_STRING'];
    // Set deleted timestamp. Session data must not be deleted immediately for reasons.
    $_SESSION['deleted_time'] = time();
    // Finish session
    session_commit();
    // Make sure to accept user defined session ID
    // NOTE: You must enable use_strict_mode for normal operations.
    ini_set('session.use_strict_mode', 0);
    // Set new custom session ID
    session_id($newid);
    // Start with custom session ID
    session_start();
$b = session_id();
header("session: $b");
} else {
/*http_response_code(900);  // set the code 204
var_dump(headers_sent());  // check if headers are sent*/
header("HTTP/1.1 418 I'm a teapot");
}
?>
<!DOCTYPE html>
<html>
<h1>418 I'm a teapot</h1><br>
<p>The HTCPCP Server is a teapot. The responding entity MAY be short and stout.</p>
<script>
domainBypass = null;
</script>
