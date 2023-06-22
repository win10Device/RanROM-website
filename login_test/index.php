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
}
body::-webkit-scrollbar{
    display: none;
}
.login-box {
  margin: 8% 20px 200px;
  margin-right: auto;
  margin-left: auto;
}
@media only screen and (max-width: 418px) {
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
if (!check_session()) {
	$user1 = $_SESSION['username'];
	echo ('<script> alerty.toasts(\'We could not verify your session, please enter password\'); </script>');
}
?>

<div class="container-fluid">
<div class="row">
    <!-- div class="fixed-end d-flex align-items-center justify-content-left vh-100 aa" -->
    <div class="login-box">
        <form class="border_fill form-floating" action="includes/login.inc.php" method="post" id="formId" onsubmit="return false">
        <?php insert_csrf_token(); ?>
        <div class="text-center">
            <img class="mb-1" src="/assets/images/logo.png" alt="" width="140" height="140">
        </div>
        <h6 class="h2 mb-3 font-weight-normal text-muted text-center">Login to your Account</h6>

        <div class="form-floating mb-3">
          <input type="text" type="email" class="form-control <?php if(isset($_SESSION['ERRORS']['nouser'])) echo 'is-invalid"'; else echo '"'; ?> /*id="floatingInput"*/ id="username" placeholder="name@example.com" value="test@example.com" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback">
          <label for="floatingInput">Email addresss/Username</label>
          <div id="validationServerUsernameFeedback" class="invalid-feedback">
             <?php echo $_SESSION['ERRORS']['nouser']; ?>
          </div>
        </div>
        <div class="form-floating mb-2">
          <input type="password" class="form-control" /*id="floatingPassword"*/ id="password" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
        <div class="col-12 mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" id="aaaa" for="flexCheckDefault">
                  Default checkbox
                </label>
            </div>
        </div>
        <div class="test">
            <button class="btn btn-lg btn-primary fadeButton" type="submit" value="loginsubmit" name="loginsubmit">Sign in</button>
        </div>
        </form>
    </div>
</div>
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
//const UB = document.querySelector('.username');

button.addEventListener('click', () => {
    div.classList.remove('fade-in');
    div.classList.add('hidden')
    var delayInMilliseconds = 800; //0.8 second

    setTimeout(function() {
        //your code to be executed after 0.8 second
        $.ajax('includes/login.inc.php', {
            type: 'POST',  // http method
            data: { token: /*document.getElementById("token").value*/<?php echo '"'. get_csrf_token() . '"'; ?>, username: document.getElementById("username").value, password: document.getElementById("password").value, loginsubmit: "loginsubmit" },  // data to submit
            success: function (data, status, xhr) {
                if (data == "ok") {
                    window.location.replace('/home');
                } else {
                    $("#aaaa").html(null);
                    $("#aaaa").append(data);
		    $("#username").add('is-invaild')
                    //UB.classList.add('is-invaild')
                    div.classList.add('fade-in')
                    div.classList.remove('hidden')
                }
                //$('p').append('status: ' + status + ', data: ' + data);
                //document.getElementById("aaaa").value = "a"; //<?php echo "\"{$_SESSION['ERRORS']['wrongpassword']} a\""; ?>;
            },
            error: function (jqXHR, textStatus, errorMessage) {
                //$('p').append('Error' + errorMessage);
                if(jqXHR.status == 403) {
                    window.location.replace('./');
                }
                $("#aaaa").html(null);
                $("#aaaa").append("Something went wrong with request: (backend) " + jqXHR.status);
                div.classList.add('fade-in')
                div.classList.remove('hidden')
            }
        }).done(function () {
            //console.log(<?php echo "\"{$_SESSION['ERRORS']['wrongpassword']}\"";?>);
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

include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/footer.php";

?>


<noscript> <meta http-equiv = "refresh" content = "0; url = <?php if($_SERVER['HTTPS']) { echo ("https://"); } else { echo ("http://");} echo ($_SERVER['HTTP_HOST']); echo ("/redirect.php?type=error_js&return=/login"); ?>"> </noscript>
