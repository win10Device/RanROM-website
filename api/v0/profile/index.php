<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
   $json = json_encode($_GET);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $json = file_get_contents('php://input');
}

$data = json_decode($json);

if (empty($data)) {
    $temp['error'] = "Null Request";
    die(json_encode($temp));
}
if (empty($data->username)) {
    $temp['error'] = "Invaild Request";
    die(json_encode($temp));
}
/*
function obfuscate_email($email)
{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/3);
    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);
}
*/
$temp = $data->username;
$temp = trim($temp);
$temp = stripslashes($temp);
$temp = htmlspecialchars($temp);
$username = $temp;
unset($temp);
require "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/db.inc.php";

if (mysqli_connect_errno()) {
    $temp['fatal_error'] = "failed to connect to database " . mysqli_connect_error();
    die(json_encode($temp));
}

$sql = "SELECT * FROM users WHERE username=?;";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
} else {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $response['username'] = $row['username'];
        //$response['email'] = obfuscate_email($row['email']);
        //$response['first_name'] = $row['first_name'];
        //$response['last_name'] = $row['last_name'];
        $response['gender'] = $row['gender'];
        $response['headline'] = $row['headline'];
        $response['bio'] = $row['bio'];
        $response['image'] = $row['profile_image'];
        $response['banner'] = $row['banner_image'];
        $response['created_at'] = $row['created_at'];

        if (empty($row['verified_at'])) {
            $response = null;
            $response['error'] = "Account is not verified";
        }
        if (isset($row['deleted_at'])) {
            $response = null;
            $response['error'] = "Account was deleted";
            $response['deleted'] = $row['deleted_at'];
        }
    } else {
        $response['error'] = "user not found";
    }
}
echo json_encode($response);
unset($response);
