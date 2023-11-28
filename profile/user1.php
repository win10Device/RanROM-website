<?php
require './includes/user.inc.php';
if (!$deleted) {
	if (!$id) {
		$title = "User not found";
		$user = "User was not found!<br>...";
		$output_image = "https://media.tenor.com/7-TMUfFEAysAAAAi/menhera-sad.gif";
		$output_image2 = $output_image;
		$firstname = "Noone is here...";
	} else {
		$title = "{$user}'s profile";
		$output_image = "/assets/uploads/users/{$profile_image}";
		$output_image2 = "/assets/uploads/users/{$profile_image}"; //https://{$_SERVER['HTTP_HOST']}
		unset($firstname);
		unset($lastname);
                $firstname = ""; //"[NAMES WHERE REDACTED FOR USER PRIVACY]";
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
<!-- DOCTYPE html -->
<!-- head -->

<!-- /head -->
<?php
//$CUSTOM_METATAG = true;
define('TITLE', "$title");
include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/header.php";
if ($user == $_SESSION['username']) {
	$user .= " (you)";
	}
?>
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="RanROM">
        <meta name="twitter:title" content="<?php echo APP_NAME . ' | ' . $title; ?>">
        <meta name="twitter:description" content="<?php echo "$user\n$firstname $lastname\n\n$bio"; ?>">
        <meta name="twitter:image" content="<?php echo $output_image2; ?>">
        <meta name="twitter:image:alt" content="No IMG?">
<main class="container fade-in" role="main">
<style>
  #test1 {
    /*background-image: url("/assets/images/profile_banner.jpg");*/
    background-image: url("/assets/uploads/server/20220107_130914.webp");
    background-size: 100%;
    background-repeat: no-repeat;
    pointer-events: none;
    /*width: 100%;
    height: 1000px;*/
  }
  @media screen and (max-width: 1200px) {
    #test1 {
        background-size: 150%;
    }
  }
  @media screen and (max-width: 1000px) {
    #test1 {
        background-size: 300%;
    }
  }
}
</style>
<!-- div class="row py-5 px-5 box-shadow shadow">
</div -->
<section class="h-100 gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-12">
        <div class="card">
          <div class="rounded-top text-white d-flex flex-row" style="backgroundd-color: #000; height:200px;" id="test1">
            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
<!-- src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp" -->
              <img src="<?php echo $output_image; ?>"
                alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                style="width: 150px; z-index: 1">

              <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                style="z-index: 1;">
                Edit profile
              </button>
            </div>
            <div class="ms-3" style="margin-top: 130px;">
              <!-- h5>Andy Horwitz</h5>
              <p>New York</p -->
              <h5>Test User</h5>
              <p>wijefoiwe</p>
            </div>
          </div>
          <div class="p-4 text-black" style="background-color: #f8f9fa;">
            <!-- div class="d-flex justify-content-end text-center py-1">
              <div>
                <p class="mb-1 h5">253</p>
                <p class="small text-muted mb-0">Photos</p>
              </div>
              <div class="px-3">
                <p class="mb-1 h5">1026</p>
                <p class="small text-muted mb-0">Followers</p>
              </div>
              <div>
                <p class="mb-1 h5">478</p>
                <p class="small text-muted mb-0">Following</p>
              </div>
            </div -->
          </div>
          <div class="card-body p-4 text-black">
            <div class="mb-5">
              <p class="lead fw-normal mb-1">About</p>
              <div class="p-4" style="background-color: #f8f9fa;">
                <p class="font-italic mb-1">Web Developer</p>
                <p class="font-italic mb-1">Lives in New York</p>
                <p class="font-italic mb-0">Photographer</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="row bio">

    <div class="col-xl-6 col-md-9 col-sm-12 mx-auto">

    <?php echo $bio; ?>

    </div>

</div>
</main>
<?php

include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/footer.php";

?>
