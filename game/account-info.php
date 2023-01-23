<?php

define('TITLE', "Home");
include '../assets/layouts/header.php';
$aa = $_SESSION['username'];
$ab = $_SESSION['first_name'];
$ac = $_SESSION['last_name'];
$ad = $_SESSION['gender'];
$ae = $_SESSION['headline'];
$af = $_SESSION['bio'];
$ag = $_SESSION['email'];
$ah = $_SESSION['profile_image'];
$ai = $_SESSION['verified_at'];
$as = $_SESSION['created_at'];
echo $ah;

header("username: $aa");
header("first_name: $ab");
header("last_name: $ac");
header("gender: $ad");
header("headline: $ae");
header("bio: $af");
header("email: $ag");
header("profile_image: $ah");
header("verified_at: $ai");
header("created_at: $as");

//check_verified();
//http_response_code(204);
//exit();
?>
<img src="../assets/uploads/users/<?php echo $_SESSION['profile_image']; ?>" alt="..." width="130" class="rounded mb-2 img-thumbnail">
