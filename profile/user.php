<?php
$host = $_SERVER['HTTP_HOST'];
require './includes/user.inc.php';
if (empty($deleted)) {
	if (empty($id)) {
		$title = "User not found";
		$user = "User was not found!<br>...";
		$output_image = "https://media.tenor.com/7-TMUfFEAysAAAAi/menhera-sad.gif";
		$output_image2 = $output_image;
		$firstname = "Noone is here...";
		$lastname = null;
		$gender = null;
		$headline = null;
		$bio = null;
	} else {
		$title = "$user's profile";
		$output_image = "../assets/uploads/users/$profile_image";
		$output_image2 = "https://$host/assets/uploads/users/$profile_image";
	}
} else {
	$title = "User not found";
	$user = "Account was deleted!<br>...";
	$output_image = "https://media.tenor.com/gMJc9aJxtzYAAAAi/cry-menhera.gif";
	$output_image2 = $output_image;
	$firstname = "Why?";
	$lastname = null;
	$gender = null;
	$headline = null;
	$bio = null;
}
?>
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="RanROM">
<meta name="twitter:title" content="<?php echo "RanROM | $title"; ?>">
<meta name="twitter:description" content="<?php echo "$user\n$firstname $lastname\n\n$bio"; ?>">
<meta name="twitter:image" content="<?php echo $output_image2; ?>">
<meta name="twitter:image:alt" content="No IMG?">

<?php
define('TITLE', "$title");
include '../assets/layouts/header.php';
if ($user == $_SESSION['username']) {
	$user .= " (you)";
}
?>

<div class="row py-5 px-4 ">
    <div class="col-xl-12 col-md-12 col-sm-12 mx-auto ">

        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-5 pb-5 bg-dark profile-cover">
                <div class="media align-items-end profile-header">
                    <div class="profile mr-3">
                        <img src="<?php echo $output_image; ?>" alt="No IMG?" width="130" class="rounded mb-2 img-thumbnail">
                    </div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0"><?php echo $user;?></h4>
                        <p class="small">

                            <?php if ($gender == 'm'){ ?>

                            <i class="fa fa-male"></i>
                            

                            <?php } elseif ($gender == 'f'){ ?>

                            <i class="fa fa-female"></i>

                            <?php } ?>

                            <?php echo $firstname . ' ' . $lastname; ?>
                        </p>

                        <p class="mb-4">
                            <?php echo $headline; ?>
                        </p>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>

<div class="row bio">

    <div class="col-xl-6 col-md-9 col-sm-12 mx-auto">
    
    <?php echo $bio; ?> 

    </div>

</div>

<?php

include '../assets/layouts/footer.php'

?>
