<?php
header("content-Type: text/html; charset=UTF-8");

include_once("./config.php");

file_put_contents('./log.txt',date('Y-m-d H:i:s')."--".json_encode($_POST).'\n',FILE_APPEND);

$merchant_code	= $_POST["merchant_code"];
$interface_version = $_POST["interface_version"];
$sign_type = $_POST["sign_type"];
$dinpaySign = base64_decode($_POST["sign"]);
$notify_type = $_POST["notify_type"];
$notify_id = $_POST["notify_id"];
$order_no = $_POST["order_no"];
$order_time = $_POST["order_time"];
$order_amount = $_POST["order_amount"];
$trade_status = $_POST["trade_status"];
$trade_time = $_POST["trade_time"];
$trade_no = $_POST["trade_no"];
$bank_seq_no = $_POST["bank_seq_no"];
$extra_return_param = $_POST["extra_return_param"];
$userName = $extra_return_param;
$signStr = "";
	
if($bank_seq_no != ""){
	$signStr = $signStr."bank_seq_no=".$bank_seq_no."&";
}

if($extra_return_param != ""){
	$signStr = $signStr."extra_return_param=".$extra_return_param."&";
}	

$signStr = $signStr."interface_version=".$interface_version."&";	

$signStr = $signStr."merchant_code=".$merchant_code."&";

$signStr = $signStr."notify_id=".$notify_id."&";

$signStr = $signStr."notify_type=".$notify_type."&";

$signStr = $signStr."order_amount=".$order_amount."&";	

$signStr = $signStr."order_no=".$order_no."&";	

$signStr = $signStr."order_time=".$order_time."&";	

$signStr = $signStr."trade_no=".$trade_no."&";	

$signStr = $signStr."trade_status=".$trade_status."&";

$signStr = $signStr."trade_time=".$trade_time;

$ddbill_public_key = openssl_get_publickey($ddbill_public_key);

$flag = openssl_verify($signStr,$dinpaySign,$ddbill_public_key,OPENSSL_ALGO_MD5);	

$log = $merchant_code.'|'.$interface_version.'|'.$sign_type.'|'.$_REQUEST["sign"].'|'.$notify_type.'|'.$notify_id.'|'.$order_no.'|'.$order_time.'|'.$order_amount.'|'.$trade_status.'|'.$trade_time.'|'.$trade_no.'|'.$bank_seq_no.'|'.$extra_return_param;

//file_put_contents('log.txt', $log.PHP_EOL, FILE_APPEND);

$flag = 1;
if($flag){	
	echo"SUCCESS";	
	$dbhost = 'localhost';
                $dbuser  = 'root';
                $dbpwd   = 'weiwei9527';
                $dbname  = 'payment1';
                $dbprefix = 'lzh';

        $conn = mysql_connect($dbhost,$dbuser,$dbpwd);
        if (!$conn) {
                die('Could not connect: ' . mysql_error());
        }
mysql_select_db($dbname,$conn);
mysql_query("SET NAMES UTF8");
        $sql = "select * from pay_usercharge where orderid='{$order_no}' and status=1";

        $res = mysql_query($sql);
        $ret = mysql_fetch_array($res);
        if($ret)
        {
                exit('SUCCESS');
        }


        $sql = "update  pay_usercharge set status=1 where orderid='{$oid}'";
        mysql_query($sql);
        $sql = "select * from pay_usercharge where orderid='{$oid}'";
        $res = mysql_query($sql);
        $ret = mysql_fetch_array($res);
        if($ret)
        {
            $uid = $ret['userid'];
	    $amt = $order_amount;
            $sql = "update pay_money set wallet=wallet+{$amt} where userid={$uid}";

            mysql_query($sql);

        }
	
}else{
	echo"Verification Error"; 
}
?>
