<?php

define('TITLE', "Signup");
include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/header.php";
check_logged_out();

?>


<div class="container">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-lg-4">

            <form class="form-auth" action="includes/register.inc.php" method="post" enctype="multipart/form-data">

                <?php insert_csrf_token(); ?>

                <div class="picCard text-center">
                    <div class="avatar-upload">
                        <div class="avatar-preview text-center z-n1">
                            <div id="imagePreview" style="background-image: url( /assets/uploads/users/_defaultUser.png );"></div>
                        </div>
                        <div class="avatar-edit">
                            <input name='avatar' id="avatar" class="fas fa-pencil" type='file' />
                            <label for="avatar"></label>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <sub class="text-danger">
                        <?php
                            if (isset($_SESSION['ERRORS']['imageerror']))
                                echo $_SESSION['ERRORS']['imageerror'];

                        ?>
                    </sub>
                </div>

                <h6 class="h3 mt-3 mb-3 font-weight-normal text-muted text-center">Create an Account</h6>
                <div class="text-center mb-3" style="font-family:Sans-serif; font-size:12px;">This website is still in development, if your account infomation is deemed to be inappropriate, your account information will be edited and notified of the changes!</div>
                <div class="text-center mb-3" style="font-family:Sans-serif; font-size:12px; position: relative; left: 0px; bottom: 15px;"">(Passwords cannot be viewed or edited)</div>

                <div class="text-center mb-3">
                    <small class="text-success font-weight-bold">
                        <?php
                            if (isset($_SESSION['STATUS']['signupstatus']))
                                echo $_SESSION['STATUS']['signupstatus'];

                        ?>
                    </small>
                </div>

                <div class="form-floating mb-2">
                  <input type="username" class="form-control <?php if (isset($_SESSION['ERRORS']['usernameerror'])) echo "is-invalid"; else echo "is-vaild"; ?>" id="username" name="username" placeholder="s" aria-describedby="validationUsername">
                  <label for="username">Username</label>
                  <div id="validationUsername" class="invalid-feedback">
                  <?php
                            if (isset($_SESSION['ERRORS']['usernameerror']))
                                echo $_SESSION['ERRORS']['usernameerror'];
                  ?>
                  </div>
                </div>

                <div class="form-floating mb-3">
                  <input type="email" class="form-control <?php if (isset($_SESSION['ERRORS']['emailerror'])) echo '';/*echo "is-invalid"; else echo "is-vaild";*/ ?>" id="email" name="email" placeholder="name@example.com" required aria-describedby="validationPassword">
                  <label for="email">Email address</label>
                  <div id="validationEmail" class="invalid-feedback">
                   <?php
                            if (isset($_SESSION['ERRORS']['emailerror']))
                                echo $_SESSION['ERRORS']['emailerror'];
                  ?>
                  </div>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>

        <div class="text-center mb-3" >
	  <b class="text-danger" style="font-family:Sans-serif; font-size:12px; position: relative; left: 0px; bottom: 0px;" >Our security may not be the strongest, so please use a password you've never used before</b>
	</div>
                <div class="form-floating">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                  <label for="password">Password</label>
                </div>
                <div class="form-floating">
                  <input type="password" class="form-control <?php if (isset($_SESSION['ERRORS']['passworderror'])) echo "is-invalid"; else echo "is-vaild"; ?>" id="confirmpassword" name="confirmpassword" placeholder="Password" aria-describedby="validationPassword" required>
                  <label for="confirmpassword">Confirm Password</label>
                  <div id="validationPassword" class="invalid-feedback">
                    <?php
                            //if (isset($_SESSION['ERRORS']['passworderror']))
                                echo $_SESSION['ERRORS'] ['passworderror'];
                     ?>
                  </div>
                </div>
                <hr>
                <span class="h5 mb-5 font-weight-normal text-muted text-center">Optional</span>
                <br><br>


                <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                  <label for="first_name">First Name</label>
                </div>

                <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                  <label for="last_name">Last Name</label>
                </div>

                <div class="form-floating mb-2 mt-4">
                  <input type="text" class="form-control" id="headline" name="headline" placeholder="Headline">
                  <label for="headline">Headline</label>
                </div>


                <div class="form-floating mb-2">
                  <textarea class="form-control" id="bio" name="bio" placeholder="bio" style="height: 100px"></textarea>
                  <label for="bio">Tell us about yourself...</label>
                </div>

                <div class="form-group mb-2">
                  <label>Gender</label>
                  <div class="custom-control custom-radio custom-control ms-2">
                    <input type="radio" id="male" name="gender" class="custom-control-input" value="m">
                    <label class="custom-control-label" for="male">Male</label>
                  </div>
                  <div class="custom-control custom-radio custom-control ms-2">
                    <input type="radio" id="female" name="gender" class="custom-control-input" value="f">
                    <label class="custom-control-label" for="female">Female</label>
                  </div>
                </div>

                <button class="btn btn-lg btn-primary btn-block" type="submit" name='signupsubmit'>Signup</button>

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
        <div class="col-md-4">

        </div>
    </div>
</div>



<?php

include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/footer.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);

            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#avatar").change(function() {
        console.log("here");
        readURL(this);
    });


;(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 5e2; // 0.5 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                $el.is(':input') && $el.on('keyup keypress paste',function(e){
                    if (e.type=='keyup' && e.keyCode!=8) return;
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);

$('#username').donetyping(function(){
    if (document.getElementById("username").value.length > 5) {
        fetch('https://www.ranrom.xyz/register/test.php', {
            method: 'POST',
            headers: {
                 'Content-Type': 'application/x-www-form-urlencoded' //'application/json'
            },
            body: "User=" + document.getElementById("username").value //}) //JSON.stringify({ "id": 78912 })
        })
        .then(response => response.json())
        .then(function(response) {
            if(response === false) {
                console.log("a");
                $('#validationUsername').text("Username already taken!")
                $('#username').addClass("is-invalid")
                $('#username').removeClass("is-valid")
            } else {
                $('#validationUsername').text("")
                $('#username').removeClass("is-invalid")
                $('#username').addClass("is-valid")
            };
        })
    } else if (document.getElementById("username").value != "") {
        $('#validationUsername').text("Username too short!")
        $('#username').addClass("is-invalid")
    } else {
        $('#validationUsername').text("")
        $('#username').addClass("is-invalid")
        $('#username').removeClass("is-valid")
    };
});
</script>

<noscript> <meta http-equiv = "refresh" content = "0; url = <?php if($_SERVER['HTTPS']) { echo ("https://"); } else { echo ("http://");} echo ($_SERVER['HTTP_HOST']); echo ("/redirect.php?type=error_js&return=/register"); ?>"> </noscript>
