<?php
header('Content-Type: application/json; charset=utf-8');
//var_dump($_REQUEST);
$data = array();
//$data =
//$data['error'] = "not_ready";
//$data['a']['reason'] = "Server can't process auth api requests right now"

//   !--  MEDIA SERVER  --!
// User ID = md5 of ID, using that for media.ranrom.xyz/avatar/(hash)/(image name).webp

$a = 0;
while ($a <= 0) {
  $temp_hold['uid'] = str_split(md5("{$a}_gay_furdox"), 6)[0];
  $temp_hold['name'] = "Test Mod {$a}";
  $temp_hold['mod'] = "dev-{$a}";
$md51 = str_split(md5($temp_hold['mod']), 8);
  $temp_hold['metadata']['img'] = "https://media.ranrom.xyz/avatar/g/{$md51[0]}/{$temp_hold['uid']}/image.webp?size=preview";
  $temp_hold['metadata']['by'] = "ranrom.autogen";
  $temp_hold['metadata']['description'] = array("Short Description", "Long Description");
  $temp_hold['metadata']['category'] = array("Test_Mod", "DevNotProduction");
  $temp_hold['metadata']['downloads'] = array("Total_NotApply", "Unique_NotApply");
  $temp_hold['metadata']['social_id'] = "NotApply";
  $mod[$a] = $temp_hold;
  unset($temp_hold);
  $a++;
}
/***
$temp_hold['uid'] = "000000";
$temp_hold['name'] = "Test Mod 0";
$temp_hold['mod'] = "main-1";
$temp_hold['metadata']['by'] = "";
$temp_hold['metadata']['category'] = array("Test_Mod", "DevNotProduction");
$temp_hold['metadata']['downloads'] = array("Total", "Unique");
$temp_hold['metadata']['social_id'] = "NotApply";
***/
//$mod[0][0] = $temp_hold;//"Test Mod 0";
//$mod[1]['mod'] = "Test Mod 1";
$data['Modlist'] = $mod;
die(json_encode($data));
