<?php
$host = $_SERVER['HTTP_HOST'];
session_start();
if(!empty($_POST['endpoint-ip'])) {
	$_SESSION['endpoint-ip'] = $_POST['endpoint-ip'];
}
?>
<script src="../assets/vendor/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
function getIP(callback) {
    $.getJSON("https://api.ipify.org/?format=json",function(returndata){
        callback(returndata);
    })
    .fail(function(returndata) { if(!alert("Something blocked an API from loading, meaning we couldn't get your IP, if you have a adblock, please disable it for this website.\nWe need to collect your IP purely for account security\n\nExiting this prompt will log you out")) document.location = '<?php echo "https://$host/logout" ?>'; })
}

getIP(function(returndata){
    //received data!
    $.ajax({
         url: "./",
         data: { 'endpoint-ip' : returndata.ip },
         type: "POST",
         beforeSend: function(xhr){xhr.setRequestHeader('endpoint-ip', "");},
      });
});
</script>
