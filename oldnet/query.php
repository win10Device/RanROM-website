<?php
if (strlen(http_build_query($_GET)) >= 30) {
   $temp['lf'] = me($_GET['lf']);
   $temp['li'] = me($_GET['li']);
   $temp['DQ'] = me($_GET['DQ']);
   $temp = http_build_query($temp);
   header("Location: ./?{$temp}");
}

function me($temp) {
    if(!empty($temp))
        return 1;
}
?>
