<?php
//echo $_SERVER['HTTP_REFERER'];
//$_SERVER['HTTP_REFERER'] = "http://www.baidu.com";
//echo $_SERVER['HTTP_REFERER'];
$url = $_GET['url'];
echo "<script>location.href='{$url}';</script>";
//header("Location:".$url);
//return;
?>


