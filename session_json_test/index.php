<?php
 /*
 * --------------------------------------------------------------------------------------------------
 * This is a page only for testing, if this was included with the bundle,
 * Delete this file, remove access this folder completely or at least remove all code from this file.
 * If you don't, this page WILL present a security risk to your users and your database
 * ---------------------------------------------------------------------------------------------------
 */
wefoiuweyfqwhefoipqwefijowqefqwjekfioiwqhefg6y7qweufjjkwleojifh8webufjk	wejoif8h7g	wufkw	'
f'p;oe	wiufy	wghejkfl;'
	wef;lmk	wnjehfwjefkl	'
wef	wkfu	wefjiowekfoiuyg	ewfiowohfu	woef
//^ all of it to break the page and cause 500




define('TITLE', "Test Page - DO NOT SHIP");

include '../assets/layouts/header.php';
check_verified();
echo "<pre> This is a page only for testing, if this was included with the bundle, <b>Delete this file</b> or at least <b>remove access this folder completely</b><br> If you are a random user coming across this page <b>please contact the network administrator</b> to remove this page</pre><br>";

?>
<div class="row py--2 px-2 ">
    <div class="col-xl-12 col-md-12 col-sm-12 mx-auto ">
<form>
  <div>
    <label for="uname">Query username: </label>
    <input
      type="search"
      id="uname"
      name="user"
      required
      size="28"
      placeholder="username"
      autofocus
      />
    <span class="validity"></span>
  </div>
  <div>
    <button>Search</button>
  </div>
</form>
<form method="post">
  <div>
    <label for="uname1">Set data: </label>
    <input
      type="text"
      id="uname1"
      name="JSON"
      size="28"
      placeholder="JSON"
      />
    <span class="validity"></span>
  </div>
  <div>
    <button>Submit</button>
  </div>
</form>

<?php

$username = htmlspecialchars($_GET['user']);
if ($_GET['user'] == "username") {
	echo "ha ha... Very funny...<br>";
}


require '../assets/setup/db.inc.php';
    
$sql = "SELECT * FROM users WHERE username=?;";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
	$_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
} else {
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
        	$ID = $row['id'];
                $JSON = $row['sessions'];
                echo $JSON;
        }
         else {

                $_SESSION['ERRORS']['nouser'] = 'user doesn\'t exist';
                echo "username does not exist in first database";
            }
}

//INSERT INTO example (docs)
//  VALUES ('["hot", "cold"]');
if (!empty($_POST['JSON'] && $_POST['JSON'] != "")) {
$JSON = $_POST['JSON'];
$sql = "UPDATE users SET SESSIONS=?";
$sql .= " WHERE id=?;";
$stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
            header("Location: ../");
            exit();
        } 
        else {
			mysqli_stmt_bind_param($stmt, "ss", $JSON, $ID);
			mysqli_stmt_execute($stmt);
            }
}
?>
<code><br><br>If this is the RanROM website, most likely this page is a "Hollow Shell" and all functions have been disabled and/or broken</code>
</div>
</div>
