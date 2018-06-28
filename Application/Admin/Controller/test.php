<?php

$starttime = mktime(0,0,0,date('m'),date('d'),date('Y'));
$now = time();

$temp = $now - $starttime;

$sjd = intval($temp / 3600);

echo $starttime + $sjd * 3600;
echo $starttime + ($sjd + 1)*3600;

?>
