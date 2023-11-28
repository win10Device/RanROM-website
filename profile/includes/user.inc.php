<?php
//$data = $_GET['u'];
$data = str_replace("/profile/", null, $_SERVER['REQUEST_URI']);
if(str_contains($data, "?")) {
  $data = $_GET['u'];
}
if(str_contains($data, '/')) {
  http_response_code(403);
  die();
}
if (empty($data)) {
  $data = $_GET['u'];
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
}

$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);

$username = $data;

require "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/db.inc.php";
    
$sql = "SELECT * FROM users WHERE username=?;";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
	$_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
} else {
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
		$id = isset($row['id']);
		$user = htmlspecialchars($row['username']);
                $firstname = htmlspecialchars($row['first_name']);
                $lastname = htmlspecialchars($row['last_name']);
                $gender = $row['gender'];
                $headline = htmlspecialchars($row['headline']);
                $bio = htmlspecialchars($row['bio']);
                $profile_image = htmlspecialchars($row['profile_image']);
                $banner_image = htmlspecialchars($row['banner_image']);
                $userlvl = htmlspecialchars($row['user_level']);
                $deleted = !empty($row['deleted_at']);
                $test = $row['licence_key'];
        }
}
