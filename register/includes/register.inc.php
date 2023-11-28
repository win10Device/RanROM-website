<?php
require "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/session.php";
//session_start();

require "{$_SERVER['DOCUMENT_ROOT']}/assets/includes/auth_functions.php";
require "{$_SERVER['DOCUMENT_ROOT']}/assets/includes/datacheck.php";
require "{$_SERVER['DOCUMENT_ROOT']}/assets/includes/security_functions.php";

check_logged_out();


if (isset($_POST['signupsubmit'])) {

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
    *   Exit function, replaces the repeating code for the samething
    * -------------------------------------------------------------------------------
    */

    function ExitFunc() {
        header("Location: ../");
        exit();
    }

    /*
    * -------------------------------------------------------------------------------
    *   Verifying CSRF token
    * -------------------------------------------------------------------------------
    */

    if (!verify_csrf_token()){

        $_SESSION['STATUS']['signupstatus'] = 'Request could not be validated';
        ExitFunc();
    }

    require '../../assets/setup/db.inc.php';
    
    //filter POST data
    function input_filter($data) {
        $data= trim($data);
        $data= stripslashes($data);
        //$data= htmlspecialchars($data);
        return $data;
    }
    
    $username = input_filter($_POST['username']);
    $email = input_filter($_POST['email']);
    $password = input_filter($_POST['password']);
    $passwordRepeat  = input_filter($_POST['confirmpassword']);
    $headline = input_filter($_POST['headline']);
    $bio = input_filter($_POST['bio']);
    $full_name = input_filter($_POST['first_name']);
    $last_name = input_filter($_POST['last_name']);

    if (isset($_POST['gender'])) 
        $gender = input_filter($_POST['gender']);
    else
        $gender = NULL;


    /*
    * -------------------------------------------------------------------------------
    *   Data Validation
    * -------------------------------------------------------------------------------
    */
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {

        $_SESSION['ERRORS']['formerror'] = 'required fields cannot be empty, try again';
        ExitFunc();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {

        $_SESSION['ERRORS']['usernameerror'] = 'Invalid Username';
        ExitFunc();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $_SESSION['ERRORS']['emailerror'] = 'Invalid Email';
        ExitFunc();
    } else if ($password !== $passwordRepeat) {

        $_SESSION['ERRORS']['passworderror'] = "Password doesn\'t match!";
        ExitFunc();
    } else {
	if(strlen($username) < 5) {
            $_SESSION['ERRORS']['usernameerror'] = 'Username too short!';
            ExitFunc();
        }
        if (!availableUsername($conn, $username)){

            $_SESSION['ERRORS']['usernameerror'] = 'Username already exists!';
            ExitFunc();
        }
        if (!availableEmail($conn, $email)){

            $_SESSION['ERRORS']['emailerror'] = 'Email already taken!';
            ExitFunc();
        }

        /*
        * -------------------------------------------------------------------------------
        *   Image Upload
        * -------------------------------------------------------------------------------
        */

        $FileNameNew = '_defaultUser.png';
        $file = $_FILES['avatar'];

        if (!empty($_FILES['avatar']['name'])){

            $fileName = $_FILES['avatar']['name'];
            $fileTmpName = $_FILES['avatar']['tmp_name'];
            $fileSize = $_FILES['avatar']['size'];
            $fileError = $_FILES['avatar']['error'];
            $fileType = $_FILES['avatar']['type']; 

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');
            if (in_array($fileActualExt, $allowed)){

                if ($fileError === 0){

                    if ($fileSize < 10000000){

                        $FileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = "{$_SERVER['DOCUMENT_ROOT']}/assets/uploads/users/" . $FileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

                    }
                    else {

                        $_SESSION['ERRORS']['imageerror'] = 'Image size should be less than 10MB!';
                        ExitFunc();
                    }
                }
                else {

                    $_SESSION['ERRORS']['imageerror'] = 'Image upload failed, try again';
                    ExitFunc();
                }
            }
            else {

                $_SESSION['ERRORS']['imageerror'] = 'Invalid image type, try again';
                ExitFunc();
            }
        }


        /*
        * -------------------------------------------------------------------------------
        *   User Creation
        * -------------------------------------------------------------------------------
        */

        $sql = "insert into users(username, email, password, first_name, last_name, gender, 
                headline, bio, profile_image, created_at) 
                values ( ?,?,?,?,?,?,?,?,?, NOW() )";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['scripterror'] = /*'SQL ERROR'*/'Database Error!';
            ExitFunc();
        } 
        else {

            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, "sssssssss", $username, $email, $hashedPwd, $full_name, $last_name, $gender, $headline, $bio, $FileNameNew);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            /*
            * -------------------------------------------------------------------------------
            *   Sending Verification Email for Account Activation
            * -------------------------------------------------------------------------------
            */
            
            require 'sendverificationemail.inc.php';

            $_SESSION['STATUS']['loginstatus'] = 'Account Created, Please login';
            header("Location: /login/");
            exit();
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} 
else {

    ExitFunc();
}
