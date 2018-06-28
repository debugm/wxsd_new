<?php 
header ( 'Content-type:text/html;charset=utf-8' );
include_once '../func/secureUtil.php';

// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
$log->LogInfo ( "===========处理支付请求开始============" );

//加密敏感数据
if (! empty( $_POST ['buyerName'] )) {
	$buyerName = $_POST ['buyerName']; // 买家姓名
	$buyerName = encryptData($buyerName);
	$_POST['buyerName'] = $buyerName;
	
	if(!empty( $_POST ['contact'])){
		$contact = $_POST ['contact']; //买家联系方式
		$contact = encryptData($contact);
		$_POST['contact'] = $contact;
	}
	
} else {
	echo '买家姓名为空';
	return;
}

//签名 
sign($_POST);
//var_dump($_POST);exit();
$html = create_html($_POST, HFB_PAY_URL);

echo $html;

