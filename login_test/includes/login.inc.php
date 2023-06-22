<?php
session_start();

require "{$_SERVER['DOCUMENT_ROOT']}/assets/includes/auth_functions.php";
require "{$_SERVER['DOCUMENT_ROOT']}/assets/includes/datacheck.php";
require "{$_SERVER['DOCUMENT_ROOT']}/assets/includes/security_functions.php";

check_logged_out();

if (!isset($_POST['loginsubmit'])){
    header("Location: ../");
    exit();
}
else {

    /*
    * -------------------------------------------------------------------------------
    *   Securing against Header Injection
    * -------------------------------------------------------------------------------
    */

    foreach($_POST as $key => $value){

        $_POST[$key] = _cleaninjections(trim($value));
    }


    /*
    * -------------------------------------------------------------------------------
    *   Verifying CSRF token
    * -------------------------------------------------------------------------------
    */

    if (!verify_csrf_token()){

        $_SESSION['STATUS']['loginstatus'] = 'Request could not be validated';

        //header("Location: ../");
        exit($_SESSION['STATUS']['loginstatus']);
    }


    require "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/db.inc.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['STATUS']['loginstatus'] = 'fields cannot be empty';
        //header("Location: ../");
        exit($_SESSION['STATUS']['loginstatus']);
    }
    else {

        /*
        * -------------------------------------------------------------------------------
        *   Updating last_login_at
        * -------------------------------------------------------------------------------
        */

        $sql = "UPDATE users SET last_login_at=NOW() WHERE username=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR';
            //header("Location: ../");
            exit($_SESSION['ERRORS']['sqlerror']);
        }
        else {

            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
        }



        /*
        * -------------------------------------------------------------------------------
        *   Creating SESSION Variables
        * -------------------------------------------------------------------------------
        */

	if (str_contains($username, "@")) {
	    $sql = "SELECT * FROM users WHERE email=?;";
	} else {
            $sql = "SELECT * FROM users WHERE username=?;";
	}
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
            //header("Location: ../");
            exit($_SESSION['ERRORS']['scripterror']);
        }
        else {

            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {

                $pwdCheck = password_verify($password, $row['password']);

                if ($pwdCheck == false) {

                    $_SESSION['ERRORS']['wrongpassword'] = 'wrong password';
                    //header("Location: ../");
                    exit($_SESSION['ERRORS']['wrongpassword']);
                }
                else if ($pwdCheck == true) {

                    session_start();

                    $_SESSION['SESSION_TYPE'] = "GUI";

                    if($row['verified_at'] != NULL){

                        $_SESSION['auth'] = 'verified';
                    } else{

                        $_SESSION['auth'] = 'loggedin';
                    }

                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = htmlspecialchars($row['username']);
                    $_SESSION['email'] = htmlspecialchars($row['email']);
                    $_SESSION['first_name'] = htmlspecialchars($row['first_name']);
                    $_SESSION['last_name'] = htmlspecialchars($row['last_name']);
                    $_SESSION['gender'] = $row['gender'];
                    $_SESSION['headline'] = htmlspecialchars($row['headline']);
                    $_SESSION['bio'] = htmlspecialchars($row['bio']);
                    $_SESSION['profile_image'] = htmlspecialchars($row['profile_image']);
                    $_SESSION['banner_image'] = htmlspecialchars($row['banner_image']);
                    $_SESSION['user_level'] = htmlspecialchars($row['user_level']);
                    $_SESSION['verified_at'] = $row['verified_at'];
                    $_SESSION['created_at'] = $row['created_at'];
                    $_SESSION['updated_at'] = $row['updated_at'];
                    $_SESSION['deleted_at'] = $row['deleted_at'];
                    $_SESSION['last_login_at'] = $row['last_login_at'];
                    $_SESSION['S_json'] = $row['sessions'];
                    $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];

                    /*
                    * -------------------------------------------------------------------------------
                    *   Setting rememberme cookie
                    * -------------------------------------------------------------------------------
                    */

                    if (isset($_POST['rememberme'])){

                        $selector = bin2hex(random_bytes(8));
                        $token = random_bytes(32);

                        $sql = "DELETE FROM auth_tokens WHERE user_email=? AND auth_type='remember_me';";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {

                            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
                            //header("Location: ../");
                            exit($_SESSION['ERRORS']['scripterror']);
                        }
                        else {

                            mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
                            mysqli_stmt_execute($stmt);
                        }

                        setcookie(
                            'rememberme',
                            $selector.':'.bin2hex($token),
                            time() + 864000,
                            '/',
                            NULL,
                            false, // TLS-only
                            true  // http-only
                        );

                        $sql = "INSERT INTO auth_tokens (user_email, auth_type, selector, token, expires_at) 
                                VALUES (?, 'remember_me', ?, ?, ?);";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {

                            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
                            //header("Location: ../");
                            exit($_SESSION['ERRORS']['scripterror']);
                        }
                        else {

                            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ssss", $_SESSION['email'], $selector, $hashedToken, date('Y-m-d\TH:i:s', time() + 864000));
                            mysqli_stmt_execute($stmt);
                        }
                    }

                    //header("Location: /home/");
                    exit("ok");
                }
            }
            else {

                $_SESSION['ERRORS']['nouser'] = 'username does not exist';
                //header("Location: ../");
                exit($_SESSION['ERRORS']['nouser']);
            }
        }
    }
}
