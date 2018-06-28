<?php 
header ( 'Content-type:text/html;charset=utf-8' );
include_once '../func/secureUtil.php';

// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
$log->LogInfo ( "===========处理支付前台通知开始============" );

$paramStr = createLinkString($_POST);
$log->LogInfo ( "===========处理支付前台通知:" . $paramStr );

// 验签
$flag = verify($_POST);

if($flag){
	$log->LogInfo ( "处理支付前台通知验签成功，可继续后续业务");
	echo $paramStr;
	
}else{
	$log->LogInfo ( "处理支付前台通知验签失败");
}

$log->LogInfo ( "===========处理支付前台通知结束============" );


