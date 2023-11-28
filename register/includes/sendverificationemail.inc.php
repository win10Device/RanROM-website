<?php


require '../../assets/setup/env.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../assets/vendor/PHPMailer/src/Exception.php';
require '../../assets/vendor/PHPMailer/src/PHPMailer.php';
require '../../assets/vendor/PHPMailer/src/SMTP.php';


//require_once("{$_SERVER['DOCUMENT_ROOT']}/error/error.php");
//ErrorType(-2);

if (isset($_POST['signupsubmit'])) {

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $url = "https://{$_SERVER['HTTP_HOST']}/verify/includes/verify.inc.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $expires = 'DATE_ADD(NOW(), INTERVAL 1 HOUR)';


    $sql = "DELETE FROM auth_tokens WHERE user_email=? AND auth_type='account_verify';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR';
        header("Location: ../");
        exit();
    }
    else {

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
    }


    $sql = "INSERT INTO auth_tokens (user_email, auth_type, selector, token, expires_at) 
            VALUES (?, 'account_verify', ?, ?, " . $expires . ");";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR';
        header("Location: ../");
        exit();
    }
    else {
        
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sss", $email, $selector, $hashedToken);
        mysqli_stmt_execute($stmt);
    }


    mysqli_stmt_close($stmt);
    mysqli_close($conn);


    $to = $email;
    $subject = 'Verify Your Account';
    
    /*
    * -------------------------------------------------------------------------------
    *   Using email template
    * -------------------------------------------------------------------------------
    */

    $mail_variables = array();

    $mail_variables['APP_NAME'] = APP_NAME;
    $mail_variables['username'] = $username;
    $mail_variables['email'] = $email;
    $mail_variables['url'] = $url;

    $message = file_get_contents("./template_verificationemail.php");

    foreach($mail_variables as $key => $value) {
        
        $message = str_replace('{{ '.$key.' }}', $value, $message);
    }


    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->SMTPSecure = MAIL_ENCRYPTION;
        $mail->Port = MAIL_PORT;

        $mail->setFrom(MAIL_FROM, APP_NAME);
        $mail->addAddress($to);


        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;


        //This should be the same as the domain of your From address
        $mail->DKIM_domain = MAIL_DKIM_DOMAIN;
        //See the DKIM_gen_keys.phps script for making a key pair -
        //here we assume you've already done that.
        //Path to your private key:
        $mail->DKIM_private = MAIL_DKIM_FILE;
        //Set this to your own selector
        $mail->DKIM_selector = MAIL_DKIM_SELECTOR;
        //Put your private key's passphrase in here if it has one
        $mail->DKIM_passphrase = MAIL_DKIM_PASS;
        //The identity you're signing as - usually your From address
        $mail->DKIM_identity = $mail->From;
        //Suppress listing signed header fields in signature, defaults to true for debugging purpose
        $mail->DKIM_copyHeaderFields = false;
        //Optionally you can add extra headers for signing to meet special requirements
        $mail->DKIM_extraHeaders = ['List-Unsubscribe', 'List-Help'];


        $mail->send();
    } 
    catch (Exception $e) {

        
    }

    /*
    * ------------------------------------------------------------
    *   Script Endpoint 
    * ------------------------------------------------------------
    */
}
else {

    header("Location: ../");
    exit();
}
