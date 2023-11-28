<?php
define('TITLE', "Login");
include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/header.php";
check_logged_out();
?>
<link rel="stylesheet" href="/assets/vendor/bootstrap/5.0.2/css/bootstrap.min.css">
<script src="/assets/vendor/alerty/js/alerty.min.js"></script>
<link rel="stylesheet" type="text/css" href="/assets/vendor/alerty/css/alerty.min.css">

<style>
body {
    background-image: url("/assets/images/random.png");
    background-size: cover;
    background-repeat: no-repeat;
    scrollbar-width: none;
    //overflow-y:hidden;
overflow: hidden;
}
body::-webkit-scrollbar{
    display: none;
    overflow: hidden;
}
.login-box {
  margin: 8% 20px 200px;
  margin-right: auto;
  margin-left: auto;
}
@media only screen and (max-height: 700px) {
  .login-box {
    margin: 5% 10px 100px;
  }
}
@media only screen and (max-width: 418px) { /*418px*/
  .login-box {
    max-width: 80%;
    margin: 0 -7.9%;
    scale: 91.11%;
  }
}
@media only screen and (max-width: 800px) {
  .aa {
  }
}
.border_fill {
     background-color: white;
  min-height: 20%;
  min-width: 0;
  width: 400px;
  border-radius: 5px;
  border: 15px solid white;
  padding: 1px;
  /*margin: 20px;*/
}
</style>

<?php

$check = check_session();
if (empty($_SESSION['username'])) {
 $check = true;
}
if (!$check) {
  $user1 = $_SESSION['username'];
  $profile_image = htmlspecialchars($_SESSION['profile_image']);
  $output_image = "\"/assets/uploads/users/{$profile_image}\"";
  echo ('<script> alerty.toasts(\'We could not verify your session, please enter password\'); </script>');
}
?>

<div class="ms-3"> <!-- container -->
  <div class="row">
    <!-- div class="fixed-end d-flex align-items-center justify-content-left vh-100 aa" -->
    <div class="login-box">
        <form class="border_fill form-floating" action="includes/login.inc.php" method="post" id="formId" onsubmit="return false">
        <?php insert_csrf_token(); ?>
        <div class="text-center">
            <img class="mb-1 <?php if(!$check) echo 'rounded-circle'; ?>" <?php if($check) echo 'src="/assets/images/logo.png"'; else echo 'src=' . $output_image;  ?>  alt="" width="140" height="140">
        </div>
        <h6 class="h2 mb-3 font-weight-normal text-muted text-center">Login to your Account</h6>

        <div class="form-floating mb-3">
          <input type="text" type="email" class="form-control" id="username" placeholder="name@example.com" <?php if(!$check) echo "disabled value={$user1}"; else echo "autofocus";?>>
          <label class="form-label" for="username">Email addresss/Username</label>
          <div class="invalid-feedback" id="UsernameFeedback">
             <!-- ?php echo $_SESSION['ERRORS']['nouser']; ? -->
          </div>
        </div>
        <div class="form-floating mb-2">
          <input type="password" class="form-control" id="password" placeholder="Password">
          <label for="password">Password</label>
          <div class="invalid-feedback" id="PasswordFeedback">
          </div>
        </div>
        <div class="col-12 mb-3">
            <?php if ($check) { ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="rememberme">
                <label class="form-check-label" id="aaaa" for="rememberme">
                  Remember Me
                </label>
            </div>
            <?php } else { ?>
            <i>Session Security</i>
            <?php } ?>
        </div>
        <div class="testa">
            <button class="btn btn-lg btn-primary fadeButton test" type="submit" value="loginsubmit" name="loginsubmit">Sign in</button>
            <a class="mt-3 text-muted text-center p-1"><a href="/reset-password/">forgot password?</a></a>
        </div>
        </form>
    </div>  </div>
</div>
<!--div class="container fade-in" -->
    <!-- div class="row" -->
        <!-- div class="col-sm-100" -->

        <!-- /div -->
        <!-- div class="col-sm-4 test" -->


<?php /*
            <form class="form-auth" action="includes/login.inc.php" method="post" id="formId" onsubmit="return false">

                <?php insert_csrf_token(); ?>

                <div class="text-center">
                    <img class="mb-1" src="/assets/images/logo.png" alt="" width="130" height="130">
                </div>

                <h6 class="h3 mb-3 font-weight-normal text-muted text-center">Login to your Account</h6>

                <div class="text-center mb-3">
                    <small class="text-success font-weight-bold">
                        <?php
                            if (isset($_SESSION['STATUS']['loginstatus']))
                                echo $_SESSION['STATUS']['loginstatus'];

                        ?>
                    </small>
                </div>

                <div class="form-group">





                    <label for="username" class="sr-only">Username</label>

                    	<input type="text" id="username" name="username" class="form-control" placeholder="Username" required  <?php if(!check_session()) echo "disabled value=$user1"; else echo "autofocus";?>>
                    <?php
                    	if (!check_session())
                    		echo("<input type=\"hidden\" name=\"username\" class=\"form-control\" value=$user1 required>");
                    ?>
                    <!input type="text" id="username" name="username" class="form-control" placeholder="Username" value="" required autofocus>
                    <sub class="text-danger" id="nouser">
                        <?php
                            if (isset($_SESSION['ERRORS']['nouser']))
                                echo $_SESSION['ERRORS']['nouser'];
                        ?>
                    </sub>
                </div>

                <div class="form-group">
                    <label for="password" class="sr-only" id="wrongpassword">Password</label>
         			<input type="password" id="password" name="password" class="form-control" placeholder="Password" required  <?php if(!check_session()) echo "autofocus"; ?>>
                    <!input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    <sub class="text-danger" id="aaaa">
                        <?php
                            if (!check_session()) {
                            	if (!isset($_SESSION['ERRORS']['wrongpassword'])) {
                            	      echo "Please login again";
                            	}
                             }
                             if (isset($_SESSION['ERRORS']['wrongpassword']))
                          	      echo $_SESSION['ERRORS']['wrongpassword'];
                        ?>
                    </sub>
                </div>
<?php if(check_session()) { ?>
                <div class="col-auto my-1 mb-4">
                    <div class="custom-control custom-checkbox mr-sm-2">
		    	<input type="checkbox" class="custom-control-input" id="rememberme" name="rememberme">
                        <label class="custom-control-label" for="rememberme">Remember me</label>
                    </div>
                </div>
<?php } ?>

                <button class="btn btn-lg btn-primary btn-block fadeButton" type="submit" value="loginsubmit" name="loginsubmit">Login</button>

                <p class="mt-3 text-muted text-center"><a href="/reset-password/">forgot password?</a></p>

                <p class="mt-4 mb-3 text-muted text-center">
                    <a href="https://github.com/msaad1999/PHP-Login-System" target="_blank">
                        Login System
                    </a> |
                    <a href="https://github.com/msaad1999/PHP-Login-System/blob/master/LICENSE" target="_blank">
                        MIT License
                    </a>
                </p>

            </form>* /?>

        </div>
        <!-- div class="col-sm-4" -->

        <!-- /div --> * / ?>
    </div>  */ ?>

</div>

<script src="/assets/vendor/js/jquery-3.4.1.min.js"></script>
<script>
const button = document.querySelector('.fadeButton');
const div = document.querySelector('.test');
button.addEventListener('click', () => {
    div.classList.remove('fade-in');
    div.classList.add('hidden')
    var delayInMilliseconds = 800; //0.8 second
    $('.test').prop('disabled', true);
    setTimeout(function() {
        //your code to be executed after 0.8 second
        $('.test').prop('disabled', false);
        $.ajax('includes/login.inc.php', {
            type: 'POST',  // http method
            data: { token: <?php echo '"'. get_csrf_token() . '"'; ?>, username: <?php if ($check) echo 'document.getElementById("username").value'; else echo "\"{$user1}\""; ?>, password: document.getElementById("password").value, <?php if ($check) echo 'rememberme: document.getElementById("rememberme").value,'; ?> loginsubmit: "loginsubmit" },  // data to submit
            success: function (data, status, xhr) {
                var json = jQuery.parseJSON(data);
                if (json.response == "ok") {
                    window.location.replace(
                    <?php
                    switch (trim($_GET['fwd'])) {
                      case 'forums':
                        echo "'http://fourms.ranrom.xyz'";
                        break;
                      default:
                        echo "'/home'";
                    }?>);
                } else {
                    if(json.response == "err") {
                      if(json.w == "both") {
                        $('#username').removeClass('is-vaild').addClass('is-invalid')
                      }
                      if(json.w == "user") {
                        $('#username').removeClass('is-vaild').addClass('is-invalid')
                        $('#UsernameFeedback').text(json.e)
                        $('#PasswordFeedback').text('')
                      }
                      if(json.w == "pass") {
                        $('#password').removeClass('is-vaild').addClass('is-invalid')
                        $('#UsernameFeedback').text('');
                        $('#PasswordFeedback').text(json.e)
                      }
                    }
                    div.classList.add('fade-in')
                    div.classList.remove('hidden')
                }
            },
            error: function (jqXHR, textStatus, errorMessage) {
                if(jqXHR.status == 403) {
                    window.location.replace('./');
                }
                $("#aaaa").html(null);
                $("#aaaa").append("Something went wrong with request: (backend) " + jqXHR.status);
                div.classList.add('fade-in')
                div.classList.remove('hidden')
            }
        }).done(function () {
            document.getElementById('aaaa').value = "a";
        })
    }, delayInMilliseconds);
})
</script>
<style>

/* test is applied to a div */
.test {
}
.fadeButton {
}

.hidden {
  visibility: hidden;
  opacity: 0;
  transition: visibility 0.6s 0.6s, opacity 0.6s linear;
}
$input-border-color:                    $gray-400;
</style>

<?php
if(empty($_GET['nojs'])) {
  $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://{$_SERVER['HTTP_HOST']}/login_test/?nojs=1";
  echo "<noscript><meta http-equiv=\"refresh\" content=\"0; URL={$actual_link}\" /></noscript>";
}
?>
<?php

include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/footer.php";

?>
<!-- noscript> <meta http-equiv = "refresh" content = "0; url = <?php if($_SERVER['HTTPS']) { echo ("https://"); } else { echo ("http://");} echo ($_SERVER['HTTP_HOST']); echo ("/redirect.php?type=error_js&return=/login"); ?>"> </noscript -->
