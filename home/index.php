<?php

define('TITLE', "Home");
include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/header.php";
check_verified();

?>


<main role="main" class="container">

    <div class="row">
        <div class="col-sm-3">

            <?php include("{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/profile-card.php"); ?>

        </div>
        <div class="col-sm-9">

            <div class="d-flex align-items-center p-3 mt-5 mb-3 text-white-50 bg-purple rounded box-shadow">
                <img class="mr-3" src="/assets/images/logonotextwhite.png" alt="" width="48" height="48">
                <img class="mr-3" src="/assets/images/chip1(1).ico" alt="" width="24" height="24">
                <div class="lh-100">
                <?php //test?>
                <b style=\"font-family:verdana; font-size:12px; color:black;\">Successfully logged in!<br>
                
                    <h6 class="mb-0 text-white lh-100">Hey there, <?php echo $_SESSION['username']; ?></h6>
                    <small>Last logged in at <?php echo date("d-m-Y", strtotime($_SESSION['last_login_at'])); ?></small>
                </div>
            </div>

            <div class="my-3 p-3 bg-white rounded box-shadow">
                <h6 class="mb-0">RanROM Project</h6>
                <sub class="text-muted border-bottom border-gray pb-2 mb-0">[All things realated]</sub>

                <div class="media text-muted pt-3">
                    <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-gray-dark">@somethingsomething</strong>
                        Some dummy text. This is originally meant to be completely replaced with your application's own functionality.<br>
                        Or maybe use this for other functionality, although that is not recommended.
                    </p>
                </div>
                <div class="media text-muted pt-3">
                    <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-gray-dark">@somethingsomething</strong>
                        Some dummy text. This is originally meant to be completely replaced with your application's own functionality.<br>
                        Or maybe use this for other functionality, although that is not recommended.
                    </p>
                </div>
                <div class="media text-muted pt-3">
                    <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-gray-dark">@somethingsomething</strong>
                        Some dummy text. This is originally meant to be completely replaced with your application's own functionality.<br>
                        Or maybe use this for other functionality, although that is not recommended.
                    </p>
                </div>
                
                
                <small class="d-block text-right mt-3">
                    <a href="news">All updates</a>
                </small>
                
            </div>

        </div>
    </div>
</main>




    <?php

    include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/footer.php"

    ?>
<noscript> <meta http-equiv = "refresh" content = "0; url = <?php if($_SERVER['HTTPS']) { echo ("https://"); } else { echo ("http://");} echo ($_SERVER['HTTP_HOST']); echo ("/redirect.php?type=error_js&return=/home"); ?>"> </noscript>
