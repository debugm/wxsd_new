<?php




$dbhost = 'localhost';
$dbuser  = 'root';
$dbpwd   = 'Gy1979712@@';
$dbname  = 'xingcai';
	
$conn = mysql_connect($dbhost,$dbuser,$dbpwd);
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db($dbname,$conn);
mysql_query("SET NAMES UTF8");
$orderId = $_POST['orderid'];

$isok = mysql_query("SELECT id FROM blast_member_recharge where state = 2 and rechargeId = '".$orderId."'");
$id = mysql_result($isok, 0);

if($id > 0){	
	echo json_encode(array('status' =>"ok", 'callback' => "http://game.app002.cn"));
	exit;
}
?>