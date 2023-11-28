<?php
//require_once "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/session.php";

function _cleaninjections($test) {

    $find = array(
        "/[\r\n]/",
        "/%0[A-B]/",
        "/%0[a-b]/",
        "/bcc\:/i",
        "/Content\-Type\:/i",
        "/Mime\-Version\:/i",
        "/cc\:/i",
        "/from\:/i",
        "/to\:/i",
        "/Content\-Transfer\-Encoding\:/i"
    );
    $ret = preg_replace($find, "no", $test);
    return $ret;
}

function generate_csrf_token() {
    echo '';
    if (!isset($_SESSION)) {
      //session_start();
      require_once "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/session.php";
        //session_start();
    }

    if (empty($_SESSION['token'])) {

        $_SESSION['token'] = bin2hex(random_bytes(32));
    } else {
       //$_SESSION['token'] = bin2hex(random_bytes(32));
    }
}

function insert_csrf_token() {

    generate_csrf_token();
    echo '<input type="hidden" name="token" id="token" value="' . $_SESSION['token'] . '" />';
}

function get_csrf_token() {
    generate_csrf_token();
    return $_SESSION['token'];
}
function verify_csrf_token() {

    generate_csrf_token();

    if (!empty($_POST['token'])) {

        if (hash_equals($_SESSION['token'], $_POST['token'])) {

            return true;
        } 
        else {
            
            return false;
        }
    }
    else {

        return false;
    }
}
