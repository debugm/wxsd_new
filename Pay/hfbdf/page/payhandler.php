<?php 
header ( 'Content-type:text/html;charset=utf-8' );
include_once '../func/secureUtil.php';
include_once '../func/HFBConfig.php';

$bankconfig = array(


	"北京银行" => "313100000013",
	"中国工商银行" => "102100099996",
	"中国光大银行" => "303100000006",
	"广发银行" => "306581000003",
	"华夏银行" => "304100040000",
	"中国建设银行" => "105100000017",
	"交通银行" => "301290000007",
	"中国民生银行" => "305100000013",
	"中国农业银行" => "103100000026",
	"平安银行" => "307584007998",
	"上海银行" => "325290000012",
	"上海浦东发展银行" => "310290000013",
	"深圳发展银行" => "307584007998",
	"兴业银行" => "309391000011",
	"中国邮政储蓄银行" => "403100000004",
	"招商银行" => "308584000013",
	"浙商银行" => "316331000018",
	"中国银行" => "104100000004",
	"中信银行" => "302100011000",
	


);


/*
  "accNo" => $tk_record['banknumber'],
                "bankName" => $tk_record['bankname'],
                "accName" => $tk_record['bankfullname'],
                "amount" => $tk_record['money'],
		"remark" => "提现",


*/



// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
$log->LogInfo ( "===========处理实时代付请求开始============" );

//加密敏感数据
if (! empty( $_POST ['accNo'] )) {
	$buyerName = $_POST ['accNo']; // 买家姓名
	$buyerName = encryptData($buyerName);
	$_POST['accNo'] = $buyerName;
	
	if(!empty( $_POST ['accName'])){
		$contact = $_POST ['accName']; //买家联系方式
		$contact = encryptData($contact);
		$_POST['accName'] = $contact;
	}
	
}
$_POST['bankAgentId'] = $bankconfig[$_POST['bankName']];

date_default_timezone_set("PRC");
$_POST['tranCode'] = '1001';
$_POST['merchantNo'] = MERCHANTNO;
$_POST['version'] = VERSION;
$_POST['channelNo'] = CHANNELNO;
list($s1, $s2) = explode(' ', microtime()); 
$millisecond = (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000); 
$data=time();
//$_POST['tranFlow'] = $millisecond;
//$_POST['tranDate'] = date("Ymd");
$_POST['tranTime'] = date("His");
$_POST['currency'] = 'RMB';
$_POST['ext1'] = '';
$_POST['ext2'] = '';
$_POST['YUL1'] = '';
$_POST['YUL2'] = '';
$_POST['YUL3'] = '';
//签名 
sign($_POST);
$result = post ( $_POST, HFB_PAY_URL, $errMsg );
$resultData=convertStringToArray($result);
echo json_encode($resultData);

$flag = verify($resultData);

//echo $flag;

