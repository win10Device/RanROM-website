<?php

define('TITLE', "Home");

include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/header.php";
check_verified();
//die("a");
?>


<main role="main" class="container fade-in">

    <div class="row">
        <div class="col-sm-3">

            <?php include("{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/profile-card.php"); ?>

        </div>
        <div class="col-sm-8">

            <div class="d-flex align-items-center p-3 mt-5 mb-3 text-white-50 bg-purple rounded box-shadow text-dark">
                <img class="mr-3" src="/assets/images/logonotextwhite.png" alt="" width="48" height="48">
                <img class="mr-4" src="/assets/images/chip1(1).ico" alt="" width="24" height="24">
                <div class="lh-100" style="padding-left: 10px;">
                <?php //test?>
                <b class="text-dark" style=\"font-family:verdana; font-size:12px; color: black;\">Successfully logged in!<br>

                    <h6 class="mb-0 text-dark lh-100">Hey there, <?php echo $_SESSION['username']; ?></h6>
                    <small>Last logged in at <?php echo date("d-m-Y", strtotime($_SESSION['last_login_at'])); ?></small>
                </div>
            </div>

            <div class="my-3 p-3 bg-white rounded box-shadow">
                <h6 class="mb-0">RanROM Project</h6>
                <sub class="text-muted border-bottom border-gray pb-2 mb-0">[All things realated]</sub>

                <div class="media text-muted pt-3">
                    <img src="" style="width: 32px;" data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-gray-dark">@somethingsomething</strong>
                        Some dummy text. This is originally meant to be completely replaced with your application's own functionality.<br>
                        Or maybe use this for other functionality, although that is not recommended.
                    </p>
                </div>
                <!-- div class="media text-muted pt-3 fade-in">
                    <img src="https://img.icons8.com/pastel-glyph/2x/cryptocurrency-mining.png" style="width: 32px;" data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-grey-dark"><a href="/profile/user.php?u=soapier" target="_blank" rel="noopener noreferrer">@Soapier</a> - Side Administrator</strong>
                        In order to keep all our services free, We maybe using your device to mine cryptocurrency.<br>
                        We dont want to litter out services with bulky obnoxious adverts that track you<br>
                        <br>
                        Unlike some websites <i>*cough*</i>, we don't want to keep any infomation from you while testing<br>
                        We will never keep you from disabling this, YOU have right to opt-out.<br>
                        <a href="/blogs?"></a>
                    </p>
                </div -->

                <small class="d-block text-right mt-3">
                    <a href="news">All updates</a>
                </small>

            </div>
        </div>
    </div>
</main>


<style>
body {
   scrollbar-width: none;
}
/* width */
::-webkit-scrollbar {
  width: 0px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #FFF; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}


body { -webkit-font-smoothing: antialiased; }


body { overflow: -moz-scrollbars-none; -ms-overflow-style: none;  }
:root{
  scrollbar-width: none !important;
}

body{
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>



    <?php

    include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/footer.php"

    ?>
<noscript> <meta http-equiv = "refresh" content = "0; url = <?php if($_SERVER['HTTPS']) { echo ("https://"); } else { echo ("http://");} echo ($_SERVER['HTTP_HOST']); echo ("/redirect.php?type=error_js&return=/home"); ?>"> </noscript>
