<?php
$username_whitelist = array("furdox", "deleted", "soapier", "zenith", "kiyo");
if (!empty($_POST['username'])) {
  if (!in_array($_POST['username'], $username_whitelist)) {
    $response['issue'] = "Username was rejected because it's not whitelisted";
    unset($_POST);
  }
}

header('Content-Type: application/json; charset=utf-8');

/*if ($_SERVER["REQUEST_METHOD"] == "GET") {
   $json = json_encode($_GET);
}*/

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $json = file_get_contents('php://input');
}

$data = json_decode($json);

$temp = $data->username;
$temp = trim($temp);
$temp = stripslashes($temp);
$temp = htmlspecialchars($temp);
$username = $temp;
unset($temp);
*/

//session_start();
//$_SESSION['SESSION_TYPE'] = "API";
//$_SESSION['auth'] = "verified";


session_start();

require "{$_SERVER['DOCUMENT_ROOT']}/assets/includes/auth_functions.php";
require "{$_SERVER['DOCUMENT_ROOT']}/assets/includes/datacheck.php";
require "{$_SERVER['DOCUMENT_ROOT']}/assets/includes/security_functions.php";

//check_logged_out();

if (!true/*!isset($_POST['loginsubmit'])*/){
    
//    header("Location: ../");
//    exit();
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

//        header("Location: ../");
//        exit();
    }


    require "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/db.inc.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $response['error'] = 'Null Request';
//        $_SESSION['STATUS']['loginstatus'] = 'fields cannot be empty';
//        header("Location: ../");
//        exit();
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

//            $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR';
//            header("Location: ../");
//            exit();
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
$response['error'] = 'SQL ERROR';
            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
//            header("Location: ../");
//            exit();
        }
        else {

            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {

                $pwdCheck = password_verify($password, $row['password']);

                if ($pwdCheck == false) {
$response['error'] = 'error';
//                    $_SESSION['ERRORS']['wrongpassword'] = 'wrong password';
//                    header("Location: ../");
//                    exit();
                }
                else if ($pwdCheck == true) {

                    session_start();

                    $_SESSION['SESSION_TYPE'] = "API";

                    if($row['verified_at'] != NULL){

                        $_SESSION['auth'] = 'verified';
                    } else{

                        $_SESSION['auth'] = 'loggedin';
                    }

                    $response['body']['id'] = $row['id'];
                    $response['body']['username'] = htmlspecialchars($row['username']);
                    //$response['body']['email'] = htmlspecialchars($row['email']);
                    //$response['body']['first_name'] = htmlspecialchars($row['first_name']);
                    //$response['body']['last_name'] = htmlspecialchars($row['last_name']);
                    $response['body']['gender'] = $row['gender'];
                    $response['body']['headline'] = htmlspecialchars($row['headline']);
                    $response['body']['bio'] = htmlspecialchars($row['bio']);
                    $response['body']['profile_image'] = htmlspecialchars($row['profile_image']);
                    $response['body']['banner_image'] = htmlspecialchars($row['banner_image']);
                    $response['body']['user_level'] = htmlspecialchars($row['user_level']);
                    $response['body']['verified_at'] = $row['verified_at'];
                    $response['body']['created_at'] = $row['created_at'];
                    $response['body']['updated_at'] = $row['updated_at'];
                    $response['body']['deleted_at'] = $row['deleted_at'];
                    $response['body']['last_login_at'] = $row['last_login_at'];
                    $response['test'] = array("a", "b");
                    //$response['body']['S_json'] = $row['sessions'];
                    //$response['body']['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];

                    if (empty($row['verified_at'])) {
                      $response = null;
                      $response['error'] = "Account is not verified";
                    }
                    if (isset($row['deleted_at'])) {
                      $response = null;
                      $response['error'] = "Account was deleted";
                      $response['deleted'] = $row['deleted_at'];
                    }


                    /*
                    * -------------------------------------------------------------------------------
                    *   Setting rememberme cookie
                    * -------------------------------------------------------------------------------
                    */

//                    header("Location: /home/");
//                    exit();
                }
            }
            else {
               $response['error'] = "user not found";

//                $_SESSION['ERRORS']['nouser'] = 'username does not exist';
//                header("Location: ../");
//                exit();
            }
        }

    }
$response['critical']['message'] = "This page isn't complete, This address is NOT up to RanROM Project's security standard and may present security flaws, hence is currently limited and only whitelisted usernames can request";
$response['critical']['rich_text'] = "<color=\"red\">This service is <b>NOT</b> up to RanROM Project's security standard and may present secuirty flaws, hence is currently limited and only <i>whitelisted</i> usernames can request";
echo json_encode($response);
unset($response);
}
