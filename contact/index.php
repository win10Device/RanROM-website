<?php

define('TITLE', "Contact Us");
include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/header.php";

?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<main role="main" class="container">

    <div class="row">
        <div class="col-sm-3">

            <?php include("{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/profile-card.php"); ?>

        </div>
        <div class="col-sm-7 px-5 mt-5">
<!-- form-auth -->
            <form class="" action="includes/contact.inc.php" method="post">

                <?php insert_csrf_token(); ?>

                <h6 class="h3 mb-3 font-weight-normal text-muted  text-center">Contact Us</h6>

                <div class="text-center mb-3">
                    <small class="text-success font-weight-bold">
                        <?php
                            if (isset($_SESSION['STATUS']['mailstatus']))
                                echo $_SESSION['STATUS']['mailstatus'];

                        ?>
                    </small>
                    <small class="text-danger font-weight-bold">
                        <?php
                            if (isset($_SESSION['ERRORS']['mailstatus']))
                                echo $_SESSION['ERRORS']['mailstatus'];

                        ?>
                    </small>
                </div>

                <?php if(!isset($_SESSION['auth'])) { ?>
                <div class="form-floating mb-3" style="display:block;">
                  <input type="text" class="form-control" id="name" name="name" placeholder="name@example.com">
                  <label for="name">Name</label>
                </div>

                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                  <label for="email">Email</label>
                </div>

                <?php } ?>
                <div class="form-floating mb-3">
                  <textarea class="form-control" placeholder="Message..." id="message" name="message" style="height: 100px"></textarea>
                  <label for="message">Message...</label>
                </div>
                <div class="g-recaptcha" data-sitekey="6Lf_bpEoAAAAADzszKrJ71vCTpM9YPcNotCaZUbV">
                </div><br>
                <div class="p-2 text-center">
                  <button type="submit" name="contact-submit" value="contact-submit" class="btn btn-primary" style="width: 30%;">Send</button>
                </div>
                <!-- div class="text-center mx-5 px-5">
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="contact-submit" value="contact-submit">Submit</button>
                </div -->

                <p class="mt-4 mb-3 text-muted text-center">
                    <a href="https://github.com/msaad1999/PHP-Login-System" target="_blank">
                        Login System
                    </a> | 
                    <a href="https://github.com/msaad1999/PHP-Login-System/blob/master/LICENSE" target="_blank">
                        MIT License
                    </a>
                </p>

            </form>

        </div>
    </div>
</main>




<?php

include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/footer.php";

?>
