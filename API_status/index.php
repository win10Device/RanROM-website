<?php
$host = $_SERVER['HTTP_HOST'];
$ip = "1.1.1.1";
require '../assets/setup/db.inc.php';
/*$ch = curl_init("http://ip-api.com/json/{$ip}");
curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $body );
curl_setopt($ch, CURLOPT_HEADERFUNCTION,
  function($curl, $header) use (&$headers)
  {
    $len = strlen($header);
    $header = explode(':', $header, 2);
    if (count($header) < 2) // ignore invalid headers
      return $len;

    $headers[strtolower(trim($header[0]))][] = trim($header[1]);
    
    return $len;
  }
);

$data = curl_exec($ch);
print_r($headers);
curl_close($ch);


echo($body);
var_dump($header);*/
$id1 = 104; //Main test account;
$id2 = 37; //Second test account;
$id3 = 100;

$timeArray[0] = 0;

for ($x = 0; $x <= 2; $x++) {
	switch ($x) {
		case 0:
		    $id = $id1;
		    break;
		case 1:
		    $id = $id2;
		    break;
		case 2:
		    $id = $id3;
		    break;
	}
	$starttime = hrtime(true);

	//Do your query and stuff here
    
	$sql = "SELECT * FROM users WHERE id=?;";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		$_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
	} else {
		mysqli_stmt_bind_param($stmt, "s", $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if ($row = mysqli_fetch_assoc($result)) {
			$username = $row['username'];
		}
	}
	
	$endtime = hrtime(true);

	$duration = $endtime - $starttime; //calculates total time taken
	$d11 = $duration/1e+6;
	$d12 = round($d11, 1, PHP_ROUND_HALF_ODD);
	$timeArray[$x] = $d12;;
} 




?>
 
<!--/div-->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="RanROM">
<meta name="twitter:title" content="<?php echo "API Timings | RanROM"; ?>">
<meta name="twitter:description" content="<?php echo "Database Query Times; Test accounts (3) {$timeArray[0]}ms, {$timeArray[1]}ms, {$timeArray[2]}ms. Third-party API; IP-API.COM - UNKNOWN .";?> ">
<meta name="twitter:image" content="<?php echo "https://$host/assets/uploads/server/tea-menhera-chan.gif"; ?>">
<meta name="twitter:image:alt" content="No IMG?">

<?php

define('TITLE', "API");
include '../assets/layouts/header.php';
//check_verified();

for ($x = 0; $x <= 2; $x++) {
	echo "Test User $x:  | {$timeArray[$x]} ms";
	echo '<br>';
}

?>

<?php
$json = '[{
    "Sessions": [
      {
        "ID": "acf21e95f695ebcf8055f20cf9c94b0d2dd5a45c119e099816dcde8755bff0dc",
        "active": true,
        "deactivate": false,
        "extra_data": [
          {
            "IP": "192.168.0.174",
            "OS": "Windows",
            "Location": "",
            "timestamps": [
              {
                "created": "1671157692",
                "expires": "",
                "last_login": "1671157692"
              }
            ],
          "browser_agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko/20100101 Firefox/107.0"
          }
        ]
      },
      {
        "ID": "da5e76a2796e4e8c094a267c56bf97e5b2f22524ec82e20c086389fd618ca0fb",
        "active": true,
        "deactivate": false,
        "extra_data": [
          {
            "IP": "192.168.137.1",
            "OS": "Windows",
            "Location": "",
            "timestamps": [
              {
                "created": "1671157692",
                "expires": "",
                "last_login": "1671157692"
              }
            ],
          "browser_agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko/20100101 Firefox/107.0"
          }
        ]
      }
    ]
  }
]';?>
<div class="py-3 px-0">
    <div class="col-xl-12 col-md-12 col-sm-12 mx-auto" style="min-width: 10%;">
        <div class="bg-white shadow rounded overflow" style="float: center;">
                    <!-- Session info object -->
		    <hr style="width:650px; margin-left:-10px">
    		    <div class="image">
			<img alt="well" src="../assets/vendor/fontawesome-6.2.1-web/svgs/solid/server.svg" width="60" />
        		<div style = "position:relative; margin-top: -20px; left:48px; top:8px;">
	    		    <a href='..'>
	      		        <status-indicator style=" position:relative; background-color:white; scale:1.8;">  <status-indicator style=" position:relative; margin-bottom:25px; scale:0.52;" active pulse></status-indicator> </status-indicator>	
	    		    </a>
		        </div>
    		    </div>
    		    <div class="text">
		    	<samp>
			    IP: <?php echo " 127.0.0.1 ({$testing})" ?><br>
			    Location: <?php echo "" . $details->country . ", " . $details->regionName . ", " . $details->city . ' (Location data is server\'s data)';?><br>
			    OS: <?php echo php_uname(); ?><br>
			    Browser Agent: Doesn't not apply
		    	</samp>
	            </div>
	             <!-- End -->
	             <!-- Session info object -->
	             <hr style="width:650px; margin-left:-10px">
        </div>
    </div>
</div>


<?php
/*$array1 = json_decode($json, true);
//print_r($array);
foreach($array1 as &$a){
    $b_json = $a['Sessions'];
    foreach($b_json as &$b){
    	$b1_1 = $b['ID'];
    	$b1_2 = $b['active'];
    	$b1_3 = $b['deactivate'];
    	echo "<hr style=\"width:50%;text-align:left;margin-left:0\">";
    	echo '<samp>';
    	echo "ID: $b1_1<br>";
    	echo "Active: $b1_2<br>";
    	echo "Deactivate: $b1_3<br>";
    	echo '</samp>';
    	$c_json = $b['extra_data'];
    	foreach($c_json as &$c){
    		$c1_1 = $c['IP'];
    		$c1_2 = $c['Location'];
    		$c1_3 = $c['OS'];
    		$c1_4 = $c['browser_agent'];
    		echo '<div class="container">
      			 <div class="image">';
    			echo '<img alt="" src="../assets/vendor/fontawesome-5.12.0/svgs/solid/desktop.svg" width="60" />';
    			echo '<status-indicator intermediary pulse></status-indicator>';
    			
    			
    		echo '</div>';
    		echo '<div class="text"';
    		echo '<h1>';
    		echo "IP: $c1_1<br>";
    		echo "GeoIP: $c1_2<br>";
    		echo "OS: $c1_3<br>";
    		echo "Browser Agent: $c1_4<br>";
    		echo "</h1>";
    		echo '</div>';
    		echo '</div>';
    		$d_json = $c['timestamps'];
    		foreach($d_json as &$d){
    			$d1_1 = $d['created'];
    			$d1_2 = $d['last_login'];
    			$d1_3 = $d['expires'];
    			echo '<samp>';
    			echo "created: $d1_1 ("; if (!empty($d1_1)) echo date('Y-m-d H:i:s', $d1_1); echo ") <br>";
    			echo "last login: $d1_2 ("; if (!empty($d1_2)) echo date('Y-m-d H:i:s', $d1_2); echo ") <br>";
    			echo "expires: $d1_3 ("; if (!empty($d1_3)) echo date('Y-m-d H:i:s', $d1_3); echo ") <br>";
    			echo "</samp>";
    
	}
	}
     }
} */
?>
    <style>
    @import '../assets/vendor/status-indicator/styles.css';
  .container {
        display: flex;
        align-items: right;
        justify-content: left
      }
      img {
        max-width: 90%
      }
      .image {
        float: left;
        flex-basis: 5%
      }
      .text {
        font-weight: bold;
        font-size: 10px;
        line-height: 1;
        padding-left: 100px;
        padding-top: 3px;
        
      }
       
    </style>

