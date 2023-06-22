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

<h3>Page Settings</h1>

<form action="./" method="get" name="">
<input type="checkbox" method="get" name="lf" value="1" <?php if ($_GET['lf'] == 1) echo "checked"?>>Load Favicon<br />
<input type="checkbox" method="get" name="li" value="1" <?php if ($_GET['li'] == 1) echo "checked"?>>Load Images<br />
<input type="checkbox" method="get" name="DQ" value="1" <?php if ($_GET['DQ'] == 1) echo "checked"?>>Disable JQuery requests<br />

<button type="submit" name="" value="">Save</button>
</form>
<a href="..<?php if (!empty($_GET)) echo '?' . http_build_query($_GET); echo '"'?>><- Back</a>
</body>
</html>
