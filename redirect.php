<?php
echo "<!DOCTYPE html>";

    $s1 = $_SERVER['QUERY_STRING'];
    $s2 = $_GET['type'];
    $s3   = $_GET['return'];
    
    if ($s2 == "error_js") { ?>
    <script> window.location.assign(" <?php if($_SERVER['HTTPS']) { echo ("https://"); } else { echo ("http://");} echo ($_SERVER['HTTP_HOST']); echo ("/$s3"); ?> ");</script>
		<noscript> <meta http-equiv = "refresh" content = "0; url = 
		<?php if($_SERVER['HTTPS']) { echo ("https://"); } else { echo ("http://");} echo ($_SERVER['HTTP_HOST']); echo ("/error/?error=nojavascript&return=$s3");?>"></noscript>
		
		
    <?php }?>
