<?php

define('TITLE', "Edit Profile");
include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/header.php";
check_verified();

//XSS filter for session variables
function xss_filter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//var_dump($_SESSION['ISSUES']);
?>
<?php if ($_SESSION['username'] == htmlspecialchars("\'") || $_SESSION['username'] == 'test')
echo "<h3>Your attempts are pointless</h3>";
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">

            <?php include("{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/profile-card.php"); ?>

        </div>
        <div class="col-md-1">

        </div>
        <div class="col-lg-7">
            <form class="form-auth" action="includes/profile-edit.inc.php" method="post" enctype="multipart/form-data" autocomplete="off">

                <?php insert_csrf_token(); ?>

                <div class="picCard text-center">
                    <div class="avatar-upload">
                        <div class="avatar-preview text-center">
                            <div id="imagePreview" style="background-image: url( /assets/uploads/users/<?php echo $_SESSION['profile_image'] ?> );">
                            </div>
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
                <div class="text-center">
                    <small class="text-success font-weight-bold">
                        <?php
                            if (isset($_SESSION['STATUS']['editstatus']))
                                echo $_SESSION['STATUS']['editstatus'];

                        ?>
                    </small>
                </div>

                <h6 class="h3 mt-3 mb-3 font-weight-normal text-muted text-center">Edit Your Profile</h6>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?php echo xss_filter($_SESSION['username']); ?>" autocomplete="off">
                    <sub class="text-danger" id="validationUsername">
                        <?php
                            if (isset($_SESSION['ERRORS']['usernameerror']))
                                echo $_SESSION['ERRORS']['usernameerror'];

                        ?>
                    </sub>
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="<?php echo xss_filter($_SESSION['email']); ?>">
                    <sub class="text-danger">
                        <?php
                            if (isset($_SESSION['ERRORS']['emailerror']))
                                echo $_SESSION['ERRORS']['emailerror'];

                        ?>
                    </sub>
                </div>

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="<?php echo xss_filter(htmlspecialchars_decode($_SESSION['first_name'])); ?>">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo xss_filter(htmlspecialchars_decode($_SESSION['last_name'])); ?>">
                </div>

                <div class="form-group mt-4">
                    <label for="headline">Headline</label>
                    <input type="text" id="headline" name="headline" class="form-control" placeholder="headline" value="<?php echo xss_filter(htmlspecialchars_decode($_SESSION['headline'])); ?>">
                </div>

                <div class="form-group">
                    <label for="bio">Profile Details</label>
                    <textarea type="text" id="bio" name="bio" class="form-control" placeholder="Tell us about yourself..."><?php echo xss_filter(htmlspecialchars_decode($_SESSION['bio'])); ?></textarea>
                </div>

                <div class="form-group mb-5">
                    <label>Gender</label>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="male" name="gender" class="custom-control-input" value="m" <?php if ($_SESSION['gender'] == 'm') echo 'checked' ?>>
                        <label class="custom-control-label" for="male">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="female" name="gender" class="custom-control-input" value="f" <?php if ($_SESSION['gender'] == 'f') echo 'checked' ?>>
                        <label class="custom-control-label" for="female">Female</label>
                    </div>
                </div>

                <hr>
                    <span class="h5 font-weight-normal text-muted mb-4">Password Edit</span>
                    <br>
                    <sub class="text-danger mb-4">
                        <?php
                            if (isset($_SESSION['ERRORS']['passworderror']))
                                echo $_SESSION['ERRORS']['passworderror'];

                        ?>
                    </sub>
                    <br><br>

                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Current Password" autocomplete="new-password">
                    </div>

                    <div class=" form-group">
                        <input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="New Password" autocomplete="new-password">
                    </div>

                    <div class=" form-group mb-5">
                        <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password" autocomplete="new-password">
                    </div>

                    <button class="btn btn-lg btn-primary btn-block mb-5" type="submit" name='update-profile'>Confirm Changes</button>
                
            </form>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>



<?php

include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/footer.php";

?>

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
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">

;(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 5e2;
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
    if (document.getElementById("username").value === "<?php echo strip_tags($_SESSION['username']); ?>") {
        $('#validationUsername').text("")
        $('#username').removeClass("is-invalid")
        $('#username').removeClass("is-valid")
    } else {
    if (document.getElementById("username").value.length > 5) {
        fetch('https://www.ranrom.xyz/register/test.php', {
            method: 'POST',
            headers: {
                 'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "User=" + document.getElementById("username").value
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
    }
    };
});
</script>
<noscript> <meta http-equiv = "refresh" content = "0; url = <?php if($_SERVER['HTTPS']) { echo ("https://"); } else { echo ("http://");} echo ($_SERVER['HTTP_HOST']); echo ("/redirect.php?type=error_js&return=/profile-edit"); ?>"> </noscript>
