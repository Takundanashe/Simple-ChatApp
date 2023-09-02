<?php
date_default_timezone_set("Asia/Kolkata");
$now = new DateTime("now");
$date= date_create("2022-11-10");
$date1 = date_create("2022-10-15");
$interval = date_diff($date, $date1);
//echo $interval->format('%R%a days');
$date2 = date('m/d/Y h:i:s a', time());
$xc =date_create($date2);


$interval1 = date_diff($date, $xc);
 $result= $interval1->format('%R%a');
echo $result;
if($result>0){
	echo "Today";
}
