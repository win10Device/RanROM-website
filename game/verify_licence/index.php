<form>
  <div>
    <label for="uname">Query licence: </label>
    <input
      type="text"
      id="uname"
      name="key"
      required
      size="28"
      placeholder="key"
      minlength="64"
      maxlength="128"
      autofocus
      />
    <span class="validity"></span>
  </div>
  <div>
    <button>Search</button>
  </div>
</form>


<?php
if (!empty($_POST['key'])) {
	$key = htmlspecialchars($_POST['key']);
	header("test1: $key");
} else {
	$key = htmlspecialchars($_GET['key']);
	header("test2: $key");
}

//require '../../assets/includes/auth_functions.php';
//require '../../assets/includes/datacheck.php';
require '../../assets/includes/security_functions.php';

//check_logged_in();

    /*
    * -------------------------------------------------------------------------------
    *   Securing against Header Injection
    * -------------------------------------------------------------------------------
    */

    //foreach($_POST as $key => $value){

//        $_POST[$key] = _cleaninjections(trim($value));
//    }


    

    require '../../assets/setup/db.inc.php';


    if (empty($key)) {

        $_SESSION['STATUS']['loginstatus'] = 'fields cannot be empty';
    } 
    else {

        /*
        * -------------------------------------------------------------------------------
        *   Updating last_login_at
        * -------------------------------------------------------------------------------
        */

        $sql = "UPDATE SRG_users SET last_accessed=NOW() WHERE licence_key=?;";
        $stmt = mysqli_stmt_init($conn_game);
        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR';
            echo "SQL ERROR 1";
            header("error: SQL ERROR 1");
        }
        else {

            mysqli_stmt_bind_param($stmt, "s", $key);
            mysqli_stmt_execute($stmt);
        }
        
        $sql = "SELECT * FROM SRG_users WHERE licence_key=?;";
        $stmt = mysqli_stmt_init($conn_game);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
            header("error: SQL ERROR 1");
        } 
        else {

            mysqli_stmt_bind_param($stmt, "s", $key);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
		if (true == true) {


			$temp01 = $row['id'];
			$temp02 = htmlspecialchars($row['username']);
			$temp03 = htmlspecialchars($row['email']);
			$temp04 = htmlspecialchars($row['licence_key']);
			$temp05 = $row['connected_id'];
			$temp06 = htmlspecialchars($row['extra']);
			$temp07 = $row['created_at'];
			$temp08 = $row['updated_at'];
			$temp09 = $row['deleted_at'];
			$temp10 = $row['last_accessed'];
			header("Key: $temp04");
			header("User: $temp02");
			header("Id: $temp01");
			header("Email: $temp03");
			header("Connected_id: $temp05");
			header("JSON: $temp06");
			header("Created_at: $temp07");
			header("Updated_at: $temp08");
			header("Deleted_at: $temp09");
			header("Last_accessed: $temp10");
			echo "<br>";
			echo "id: $temp01 <br>";
			echo "username: $temp02 <br>";
                    	echo "email: $temp03 <br>";
                    	echo "licence_key: $temp04 <br>";
                    	echo "connected_id: $temp05 <br>";
                    	echo "extra: $temp06 <br>";
                    	echo "created_at: $temp07 <br>";
                    	echo "updated_at: $temp08 <br>";
                    	echo "deleted_at: $temp09 <br>";
                    	echo "last_accessed: $temp10 <br>";
                    	echo "test: " . md5($temp02) . md5($temp04);

                    //header("Location: ../../home/");
                    //exit();
                } 
            } 
            else {

                $_SESSION['ERRORS']['nouser'] = 'licence does not exist';
                echo "licence key does not exist in second database";
                header("error: licence key doesn't exist");
            }
        }
}
