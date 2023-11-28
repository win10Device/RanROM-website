<?php
header('X-Robots-Tag: noindex');
$a = htmlspecialchars(trim($_GET['t']));

$data = str_replace("/api/text.php/", null, $_SERVER['REQUEST_URI']);
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);

switch ($a) {
  default: //case "furry":
    if ($data == "furry.txt") {
      header("Content-Type: text/plain");
      echo "Hylia is a furry";
    }
  break;
}
