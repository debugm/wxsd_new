<?php 
header ( 'Content-type:text/html;charset=utf-8' );
include_once '../func/secureUtil.php';

// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
$log->LogInfo ( "===========处理退款请求开始============" );


//签名 
sign($_POST);

//发送请求，接收json响应结果
$result = post ( $_POST, HFB_REFUND_URL, $errMsg );
if (! $result) { //没收到200应答的情况
	echo "退款结果：" . $result . "<BR>";
	echo "POST请求失败：" . $errMsg;
	return;
}

$resultData = json_decode($result, true);

//验签
$flag = verify($resultData);

if($flag){
	$code = $resultData['rtnCode'];
	$msg = $resultData['rtnMsg'];
	
	echo "退款成功：" . "<BR>";
	echo "code：" . $code . "<BR>";
	echo "msg:" . $msg;
		
	
}else{
	echo "退款结果：" . $result . "<BR>";
	echo "验签失败！";
}

$log->LogInfo ( "退款返回结果为>" . $result );

$log->LogInfo ( "===========处理退款请求结束============" );
