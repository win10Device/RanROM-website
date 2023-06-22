<?php
//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n<br>";
$browser = get_browser($_SERVER['HTTP_USER_AGENT'], true);
//print_r($browser);
?>

<!DOCTYPE html>
<html>
<head>
<?php if(empty($_GET['lf'])) {?>
  <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
<?php } ?>
</head>
<body style="font-family: Helvetica, Arial, sans-serif;">
   <div>
     <h2>Hello, World!</h2>
     <a>Nothing here just yet</a><br><br>
       <a href="../<?php if (!empty($_GET)) echo '?' . http_build_query($_GET); echo '"'?>><- Back</a><br>
       <form class="form-auth" action="../../login/includes/login.inc.php" method="post">
                <?php insert_csrf_token(); ?>
       </form>
   </div>

</body>
</html><?php
