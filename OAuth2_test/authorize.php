<?php
session_start();
// include our OAuth2 Server object
require_once __DIR__.'/server.php';

$request = OAuth2\Request::createFromGlobals();
$response = new OAuth2\Response();
if(!isset($_SESSION['auth']) || !isset($_SESSION['verified_at'])) {
	die("No, you can't preform this action");
}

// validate the authorize request
if (!$server->validateAuthorizeRequest($request, $response)) {
    $response->send();
    die;
}
if (str_contains($_GET['scope'], 'admin')) {
	//exit('<b>WARNING!</b> <form method="post"><label>You cant Authorize the client because it wants <u><b>full access</b></u> to your account including <u><b>password</b></u></label><br /> <input type="submit" value="yes" disabled> <input type="submit" name="authorized" value="no"></form>');
}
// display an authorization form
if (empty($_POST)) {
  exit('
<form method="post">
  <label>Do You Authorize TestClient?</label><br />
  <input type="submit" name="authorized" value="yes">
  <input type="submit" name="authorized" value="no">
</form>');
}

// print the authorization code if the user has authorized your client
$is_authorized = ($_POST['authorized'] === 'yes');
$userid = $_SESSION['id'];
$server->handleAuthorizeRequest($request, $response, $is_authorized, $userid);
if ($is_authorized) {
  // this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
  $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
  exit("SUCCESS! Authorization Code: $code for userid $userid");
}
$response->send();
