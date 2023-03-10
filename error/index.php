<?php
echo "<!DOCTYPE html>";

    $s1 = $_SERVER['QUERY_STRING'];
    $s2 = $_GET['error'];
    $s3   = $_GET['return'];
    $host = $_SERVER['HTTP_HOST'];
    //Error - Javascript
?>

<?php if ($s2 == "nojavascript") {
    if ($s3 != null) {
       	if ($_SERVER['HTTPS'] == true) { ?>
       		<script>window.location.assign(<?php echo("\"https://$host/$s3\"");?>);</script>
<?php   } else {?>
       		<script>window.location.assign(<?php echo("\"http://$host/$s3\"");?>);</script>
<?php   }
    }?>
<b style="font-family:verdana; font-size:13px; color:red;">Please enable Javascript then reload the page!<br></b>
<b style="font-family:verdana; font-size:12px; color:black;">If javascript is enabled but not functioning consider the following;<br></b>
<b style="font-family:verdana; font-size:12px; color:black;">• Updating/removing browser extensions. <br>• Updating/reinstalling your browser. <br>• Switching to a newer browser. <br>• Upgrading your operating system and/or hardware. <br> </b>
<a style="font-family:verdana; font-size:12px; color:blue;" target="_blank" href="https://www.enable-javascript.com/"> How to enable JavaScript </a> <br>
<?php } ?>
