<?php
require_once './src/MCPing.php';
require_once './src/MCQuery.php';
require_once './src/Exceptions/MCPingException.php';
require_once './src/Exceptions/MCQueryException.php';
require_once './src/Responses/MCBaseResponse.php';
require_once './src/Responses/MCPingResponse.php';
require_once './src/Responses/MCQueryResponse.php';
	//using the class
use MCServerStatus\MCPing;
use MCServerStatus\MCQuery;
	
	//include composer autoload
	//require_once('../vendor/autoload.php');
	
	//checking account
	$response=MCPing::check('play.ranrom.xyz');
	echo '<img src="' . $response->favicon . '">';
	//get informations from object
	//var_dump($response);
//echo ($response->online);
//var_dump($response->getMotdToText());
	//echo "<br>" . $response['motd'];
	//or from array
	var_dump($response->toArray());
?>
