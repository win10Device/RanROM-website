<?php
class Session {
  private $mysqli;

  public function __construct(){
    GLOBAL $mysqli;
    // Instantiate new Database object
    require "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/env.php";
    require "{$_SERVER['DOCUMENT_ROOT']}/assets/setup/db.inc.php";
    $mysqli = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB2_DATABASE);
    register_shutdown_function('session_write_close');
    session_set_save_handler(array($this, '_open'), array($this, '_close'), array($this, '_read'), array($this, '_write') , array($this, '_destroy'), array($this, '_clean'));
    session_start();
//    unset($_SESSION);
  }
  function _open($savepath, $id) {
    GLOBAL $mysqli;
    $stmt = $mysqli->prepare("SELECT data FROM session WHERE id = ? LIMIT 1");
    $stmt->bind_param('s', $id);
//    $stmt->execute();
//    $result = $stmt->get_result();
 //   $num = $result->num_rows;
 //   if ($num > 0) {
 //     return false;
 //   } else {
      return true;
//    }
    $stmt->close();
    //return false;
  }

  function _close(/*$id, $data*/) {
    GLOBAL $mysqli;
//    mysqli_close($mysqli);
    return true;
  }

  function _read($id) {
    GLOBAL $mysqli;

    $stmt = $mysqli->prepare("SELECT data FROM session WHERE id = ?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $num = $result->num_rows;

    if ($num>0) {
        $record = $result->fetch_assoc();
        return $record['data'];
    }
    $stmt->close();
    return "";
  }

  function _write($id, $data) {
    GLOBAL $mysqli;
    $ip = "UNSET";
    if (empty($_SERVER['HTTP_X_FORWARDED_FOR']))
      $ip = "local";
    else
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $access = time();
    $stmt = $mysqli->prepare("REPLACE INTO session VALUES (?,?,?,?)");
    $stmt->bind_param('ssss', $id, $access, $data, $ip);
    $stmt->execute();
    $stmt->close();
    return true;
  }

  function _destroy($id) {
    GLOBAL $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM session WHERE id = ?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    //mysqli_stmt_close($stmt);
    $stmt->close();
    return true;
  }

  function _clean($max) {
    GLOBAL $mysqli;

    $old = time() - $max;

    $stmt = $mysqli->prepare("DELETE FROM session WHERE access < ?");
    $stmt->bind_param('s', $old);
    $stmt->execute();
    $stmt->close();
  }
}
$session = new Session();	//Start a new PHP MySQL session
