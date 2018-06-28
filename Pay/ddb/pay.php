<?php
header("content-Type: text/html; charset=UTF-8");
include('./config.php');
function getIP() { 
	if (isset($_SERVER)) { 
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
	$realip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
	} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) { 
	$realip = $_SERVER['HTTP_CLIENT_IP']; 
	} else { 
	$realip = $_SERVER['REMOTE_ADDR']; 
	} 
	} else { 
	if (getenv("HTTP_X_FORWARDED_FOR")) { 
	$realip = getenv( "HTTP_X_FORWARDED_FOR"); 
	} elseif (getenv("HTTP_CLIENT_IP")) { 
	$realip = getenv("HTTP_CLIENT_IP"); 
	} else { 
	$realip = getenv("REMOTE_ADDR"); 
	} 
	} 
	return $realip; 
}


$amt = intval($_GET['amt']);
$bank = '';
//$username = $_GET['user'];
$orderId = $_GET['oid'];


$merchant_code = "1000501416";
$service_type = "direct_pay";
$interface_version ="V3.0";
$sign_type ="RSA-S";
$input_charset = "UTF-8";
$notify_url = "http://p.thyztrade.com/Pay/ddb/notify.php";
$order_no = $orderId;
$order_time = date( 'Y-m-d H:i:s' );
$order_amount = $amt;
$product_name = "charge";
$return_url = "http://p.thyztrade.com/Pay/ddb/return.php";
$pay_type = "";
$redo_flag = "";	
$product_code = "";	
$product_desc = "";	
$product_num = "";
$show_url = "";	
$client_ip ="" ;	
$bank_code = "";	
$extend_param = "";
//$extra_return_param = $username;


$signStr= "";

if($bank_code != ""){
	$signStr = $signStr."bank_code=".$bank_code."&";
}
if($client_ip != ""){
	$signStr = $signStr."client_ip=".$client_ip."&";
}
if($extend_param != ""){
	$signStr = $signStr."extend_param=".$extend_param."&";
}
if($extra_return_param != ""){
	$signStr = $signStr."extra_return_param=".$extra_return_param."&";
}


$signStr = $signStr."input_charset=".$input_charset."&";	
$signStr = $signStr."interface_version=".$interface_version."&";	
$signStr = $signStr."merchant_code=".$merchant_code."&";	
$signStr = $signStr."notify_url=".$notify_url."&";		
$signStr = $signStr."order_amount=".$order_amount."&";		
$signStr = $signStr."order_no=".$order_no."&";		
$signStr = $signStr."order_time=".$order_time."&";	

if($pay_type != ""){
	$signStr = $signStr."pay_type=".$pay_type."&";
}

if($product_code != ""){
	$signStr = $signStr."product_code=".$product_code."&";
}	
if($product_desc != ""){
	$signStr = $signStr."product_desc=".$product_desc."&";
}

$signStr = $signStr."product_name=".$product_name."&";

if($product_num != ""){
	$signStr = $signStr."product_num=".$product_num."&";
}	
if($redo_flag != ""){
	$signStr = $signStr."redo_flag=".$redo_flag."&";
}
if($return_url != ""){
	$signStr = $signStr."return_url=".$return_url."&";
}		

$signStr = $signStr."service_type=".$service_type;

if($show_url != ""){		
	$signStr = $signStr."&show_url=".$show_url;
}

$merchant_private_key= openssl_get_privatekey($merchant_private_key);
$sign_info = '';
openssl_sign($signStr,$sign_info,$merchant_private_key,OPENSSL_ALGO_MD5);

$sign = base64_encode($sign_info);


?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>	
	<body onLoad="document.dinpayForm.submit();">
		<form name="dinpayForm" method="post" action="https://pay.ddbill.com/gateway?input_charset=UTF-8">
			<input type="hidden" name="sign"		  value="<?php echo $sign?>" />
			<input type="hidden" name="merchant_code" value="<?php echo $merchant_code?>" />
			<input type="hidden" name="bank_code"     value="<?php echo $bank_code?>"/>
			<input type="hidden" name="order_no"      value="<?php echo $order_no?>"/>
			<input type="hidden" name="order_amount"  value="<?php echo $order_amount?>"/>
			<input type="hidden" name="service_type"  value="<?php echo $service_type?>"/>
			<input type="hidden" name="input_charset" value="<?php echo $input_charset?>"/>
			<input type="hidden" name="notify_url"    value="<?php echo $notify_url?>">
			<input type="hidden" name="interface_version" value="<?php echo $interface_version?>"/>
			<input type="hidden" name="sign_type"     value="<?php echo $sign_type?>"/>
			<input type="hidden" name="order_time"    value="<?php echo $order_time?>"/>
			<input type="hidden" name="product_name"  value="<?php echo $product_name?>"/>
			<input Type="hidden" Name="client_ip"     value="<?php echo $client_ip?>"/>
			<input Type="hidden" Name="extend_param"  value="<?php echo $extend_param?>"/>
			<input Type="hidden" Name="extra_return_param" value="<?php echo $extra_return_param?>"/>
			<input Type="hidden" Name="pay_type"  value="<?php echo $pay_type?>"/>
			<input Type="hidden" Name="product_code"  value="<?php echo $product_code?>"/>
			<input Type="hidden" Name="product_desc"  value="<?php echo $product_desc?>"/>
			<input Type="hidden" Name="product_num"   value="<?php echo $product_num?>"/>
			<input Type="hidden" Name="return_url"    value="<?php echo $return_url?>"/>
			<input Type="hidden" Name="show_url"      value="<?php echo $show_url?>"/>
			<input Type="hidden" Name="redo_flag"     value="<?php echo $redo_flag?>"/>
		</form>
	</body>
</html>
