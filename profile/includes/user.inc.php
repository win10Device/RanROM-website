<?php
$username = $_GET['u'];
require '../assets/setup/db.inc.php';
    
$sql = "SELECT * FROM users WHERE username=?;";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
	$_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
	echo "SQL ERROR 1";
} else {
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
		$id = $row['id'];
		$user = $row['username'];
                $email = $row['email'];
                $firstname = $row['first_name'];
                $last_name = $row['last_name'];
                $gender = $row['gender'];
                $headline = $row['headline'];
                $bio = $row['bio'];
                $profile_image = $row['profile_image'];
                $banner_image = $row['banner_image'];
                $userlvl = $row['user_level'];
                $deleted = $row['deleted_at'];
        }
}
