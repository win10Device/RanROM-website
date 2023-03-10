<?php
/*$json = '[{
    "Sessions": [
      {
        "ID": "acf21e95f695ebcf8055f20cf9c94b0d2dd5a45c119e099816dcde8755bff0dc",
        "active": true,
        "deactivate": false,
        "extra_data": [
          {
            "IP": "192.168.0.174",
            "OS": "Windows",
            "GeoIP": "",
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
            "GeoIP": "",
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
]';*/
function Decode($json) {
$array1 = json_decode($json, true);
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
    		$c1_2 = $c['GeoIP'];
    		$c1_3 = $c['OS'];
    		$c1_4 = $c['browser_agent'];
    		echo '<div class="container">
      			 <div class="image">';
    			echo '<img alt="" src="../vendor/fontawesome-5.12.0/svgs/solid/desktop.svg" width="60" />';
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
}
}
?>
    <style>
    @import '../vendor/status-indicator/styles.css';
      .container {
        display: flex;
        align-items: right;
        justify-content: left
      }
      img {
        max-width: 90%
      }
      .image {
        flex-basis: 5%
      }
      .text {
        font-size: 12px;
        padding-left: 0px;
        
      }
       
    </style>

