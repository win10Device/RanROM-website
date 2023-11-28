<?php
if ($_SERVER['HTTP_ACCEPT'] != 'application/json') {
?>
<html>
<head>
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="RanROM Project">
  <meta property="og:title" content="API">
  <meta property="og:description" content="API of RanROM Project, you're not meant to request it like this...">
  <!-- meta property="og:image" content="https://cdn.discordapp.com/attachments/1055707718423416832/1087595076219306004/D8pQK08.gif" -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="RanROM Porject">
  <meta name="twitter:creator" content="@SoapierGlobe">
  <meta name="twitter:card" content="summary">
  <meta content="#43B581" data-react-helmet="true" name="theme-color" />


  <!-- meta name="twitter:card" content="summary" -->
  <!-- meta name="twitter:site" content="@RanROM" -->
  <!-- meta name="twitter:title" content="Kiyo is a furry" -->
  <!-- meta name="twitter:description" content="Yes, I did create a webpage just for this" -->
</head>
</html>
<?php
} else {
header('Content-Type: application/json; charset=utf-8');
//$data = /** whatever you're serializing **/;
$foo = file_get_contents("php://input");
if (json_decode($foo, true)['content'] == 'status') {
    $data['error'] = "not_ready";
    $data['reason'] = "Server can't process auth api requests right now";
    die(json_encode($data));
}

die();
}
