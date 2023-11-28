<?php
echo "<!DOCTYPE html>";

    $s1 = $_SERVER['QUERY_STRING'];
    $s2 = $_GET['error'];
    $s3   = $_GET['return'];
    $host = $_SERVER['HTTP_HOST'];
    //Error - Javascript
?>

<?php if ($s2 == "nojs") {
  if ($s3 != null) {
    if ($_SERVER['HTTPS'] == true) {
      echo "<script>window.location.assign(\"https://{$host}$s3\");</script>";
    } else {
      echo "<script>window.location.assign(\"http://{$host}$s3\");</script>";
    }
  }?>
<body>
  <h3 style="font-family:verdana; color:red;">Please enable Javascript then reload the page!</h3>
  <div style="margin-left: 10px;">
    <b style="font-family:verdana; font-size:12px; color:black;">If javascript is enabled but not functioning consider the following;<br></b>
    <b style="font-family:verdana; font-size:12px; color:black;">• Updating/removing browser extensions. <br>• Updating/reinstalling your browser. <br>• Switching to a newer browser. <br>• Upgrading your operating system and/or hardware. <br> </b>
    <a style="font-family:verdana; font-size:12px; color:blue;" target="_blank" href="https://www.enable-javascript.com/"> How to enable JavaScript </a><br>
  </div>
</body>
</html>
<?php } ?>
