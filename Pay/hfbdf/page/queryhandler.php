<?php 
header ( 'Content-type:text/html;charset=utf-8' );
include_once '../func/secureUtil.php';

// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
$log->LogInfo ( "===========处理查询请求开始============" );

$_POST['tranCode'] = '1004';
$_POST['merchantNo'] = MERCHANTNO;
$_POST['version'] = VERSION;
$_POST['channelNo'] = CHANNELNO;
list($s1, $s2) = explode(' ', microtime()); 
$millisecond = (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000); 
$data=time();
$_POST['tranFlow'] = $millisecond;
$_POST['tranDate'] = date("Ymd");
$_POST['tranTime'] = date("His");
//签名 
sign($_POST);

//发送请求，接收json响应结果
$result = post ( $_POST, HFB_PAY_URL, $errMsg );
if (! $result) { //没收到200应答的情况
	echo "查询结果：" . $result . "<BR>";
	echo "POST请求失败：" . $errMsg;
	return;
}
$resultData=convertStringToArray($result);
echo json_encode($resultData);
//验签
/*
$flag = verify($resultData);

if($flag){
	$code = $resultData['rtnCode'];
	$msg = $resultData['rtnMsg'];
	
	echo "查询成功：" . "<BR>";
	echo "code：" . $code . "<BR>";
	echo "msg:" . $msg;
		
	
}else{
	echo "查询结果：" . $result . "<BR>";
	echo "验签失败！";
}

$log->LogInfo ( "查询返回结果为>" . $result );

$log->LogInfo ( "===========处理查询请求结束============" );
*/
