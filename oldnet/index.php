<?php
include("{$_SERVER['DOCUMENT_ROOT']}/oldnet/query.php");
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
     <h2>Welcome to the "lite" version of <?php echo $_SERVER['SERVER_NAME']; ?></h2>
     <a>This was design for users on legecy device* and slow networks</a><br>
     <small>* Some pages require basic HTML5 and Cookie Storage support for core functions</small><br><br>
       <a href="./settings<?php if (!empty($_GET)) echo '?' . http_build_query($_GET); echo '"'?>>Page Settings -></a><br>
       <a href="./login<?php if (!empty($_GET)) echo '?' . http_build_query($_GET); echo '"'?>>Login -></a><br>
       <a href="#">Contact Us -></a><br>
   </div>
<?php if (!empty($_GET['li'])) { ?>
<span title="Test Image. you can disable image loading by going to page settings">
   <img src="https://www.ranrom.xyz/assets/uploads/users/63ef0b948e7be9.32875037.webp" alt="Test Image" hover="test image" style="width: 60px; padding: 20px;"/>
</span>
<?php } ?>
</body>
</html>
