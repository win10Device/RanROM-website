<?php
if ($_SERVER['HTTP_ORIGIN'] != "https://www.ranrom.xyz") {
  http_response_code(401);
x/ exit();
}
$data = $_POST['User'];
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
$username = $data;

require '../assets/setup/db.inc.php';

$sql = "SELECT * FROM users WHERE username=?;";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
	$_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
} else {
	mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
	$result = mysqli_stmt_num_rows($stmt);
        if ($result > 0) {
            echo 'false';
        } else {

            echo 'true';
        }
}
