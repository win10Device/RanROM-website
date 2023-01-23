<?php
http_response_code(204);
require '../assets/includes/auth_functions.php';
require '../assets/includes/datacheck.php';
require '../assets/includes/security_functions.php';

function generate_licence_token() {
    	$username = htmlspecialchars($_POST['username']);
    	if (!isset($_SESSION)) {
        	$newid = $_POST['session'];
		session_id($newid);
		session_start();
		header("session: $newid");
    	}
	require '../assets/setup/db.inc.php';
	if (!empty($username)) {
		$sql = "SELECT * FROM SRG_users WHERE username=?;";
		$stmt = mysqli_stmt_init($conn_game);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Error: SQL ERROR");
		} else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
        		if ($row = mysqli_fetch_assoc($result)) {
        			$_SESSION['token'] = md5($username) . md5($row['licence_key']);
        		}
    		}
    	} else {
    		header("Error: fields cannot be empty");
    		die();
    	}
}

function verify_licence_token() {
    generate_licence_token();
    
    if (!empty($_POST['token'])) {
	if (!empty($_SESSION['token'])) {
        	if (hash_equals($_SESSION['token'], $_POST['token'])) {
           		return true;
        	} else {
        		return false;
        	}
        
    } else {

            return false;
        }
    }
    else {

        return false;
    }
}
if (!isset($_POST['loginsubmit'])){
    
    header("Location: ../");
    exit();
}
else {



    /*
    * -------------------------------------------------------------------------------
    *   Verifying CSRF token
    * -------------------------------------------------------------------------------
    */

    if (!verify_licence_token()){

        $_SESSION['STATUS']['loginstatus'] = 'Request could not be validated';
        
        header("Error: Something went wrong");
        exit();
    }

    

    require '../assets/setup/db.inc.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {

        $_SESSION['STATUS']['loginstatus'] = 'fields cannot be empty';
        header("Error: fields cannot be empty");
        exit();
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
            header("Error: SQL ERROR");
            exit();
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

        $sql = "SELECT * FROM users WHERE username=?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
            header("ERROR: SQL ERROR");
            exit();
        } 
        else {

            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {

                $pwdCheck = password_verify($password, $row['password']);

                if ($pwdCheck == false) {

                    $_SESSION['ERRORS']['wrongpassword'] = 'wrong password';
                    header("Error: wrong password");
                    exit();
                } 
                else if ($pwdCheck == true) {

                    //session_start();

                    
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
                    $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
                    header("Id: " . $_SESSION['id']);
                    header("Username: " . $_SESSION['username']);
                    header("Email: " . $_SESSION['email']);
                    header("First_name: " . $_SESSION['first_name']);
                    header("Last_name: " . $_SESSION['last_name']);
                    header("Gender: " . $_SESSION['gender']);
                    header("Headline: " . $_SESSION['headline']);
                    header("Bio: " . $_SESSION['bio']);
                    header("Profile_image: " . $_SESSION['profile_image']);
                    header("Banner_image: " . $_SESSION['banner_image']);
                    header("User_level: " . $_SESSION['user_level']);
                    header("Verified_at: " . $_SESSION['verified_at']);
                    header("Created_at: " . $_SESSION['created_at']);
                    header("Deleted_at: " . $_SESSION['deleted_at']);
                    header("Last_login_at: " . $_SESSION['last_login_at']);


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
                            header("ERROR: SQL ERROR");
                            exit();
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
                            header("Error: SQL ERROR");
                            exit();
                        }
                        else {
                            
                            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ssss", $_SESSION['email'], $selector, $hashedToken, date('Y-m-d\TH:i:s', time() + 864000));
                            mysqli_stmt_execute($stmt);
                        }
                    }

                    header("placeholder: ?");
                    exit();
                } 
            } 
            else {

                $_SESSION['ERRORS']['nouser'] = 'username does not exist';
                header("Error: username does not exist");
                exit();
            }
        }
    }
}
