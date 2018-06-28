<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/func/secureUtil.php';


$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );// 初始化日志

// testEncrytp();
// testDecrypt();
	
testJson();

function testJson(){
	$v = '{"YUL1":"","merchantNo":"S20170907011890","paySerialNo":"121212","refundAmt":"","refundCount":"","remark":"","rtnCode":"2000","rtnCodeY":"","rtnMsg":"订单不存在","rtnMsgY":"","sign":"hCEJYBID59kMeEQWUFklhUYKo0\/OBESTTAAc\/jpI9vYW4idA1xzckG4VPMATnml4EOTKGmEFCB1B\n\/plJSMhXEjBAjfsmw0JtUjYFFtEqkyl8Rhq1NSTcCcgj64bP6B7kcz40IGoEgN2JY9avlMkUQYMx\nwNdq98FAaerZr52wAeI=","status":"","tranSerialNum":"20160141036871674","tranSerialNumY":""}';
	
	$resultData = json_decode($v, true);
	
	var_dump($resultData);
	
	echo '验签结果' . verify($resultData);
}
function testDecrypt(){
	$v = "XLQoxV/FU8uuoItmqhEQZ4xgX4DHen35GST0cwpcBoJgEl+QbJu+UKk27qW5tP7fZnNGKOWzOvCWm/Jhq1nbQFYanloeNhNzXxd5S+AyVzlWMcQ7KzTdlpJqoMzHnfrgwvvpt9c7cIDxS+vvxL6kIOWd/ka3u5sf0jWkmcF1zpU=";
	$v = decryptData($v);
	
	echo  "明文：" . $v;
}

function testEncrytp(){
	$v = "123";
	$v = encryptData( $v );
	
	echo "密文：" .$v;
}


	
	
	function testSign(){
		$params = array(
				//以下信息非特殊情况不需要改动
				'version' => '5.0.0',		  //版本号
				'encoding' => 'utf-8',		  //编码方式
				'certId' => '', //证书ID
				'signMethod' => '01',		  //签名方法
				'txnType' => '00',		      //交易类型
				'txnSubType' => '00',		  //交易子类
				'bizType' => '000000',		  //业务类型
				'accessType' => '0',		  //接入类型
				'channelType' => '07',		  //渠道类型
		
				//TODO 以下信息需要填写
				'orderId' => $_POST["orderId"],	//请修改被查询的交易的订单号，8-32位数字字母，不能含“-”或“_”，此处默认取demo演示页面传递的参数
				'merId' => $_POST["merId"],	    //商户代码，请改自己的测试商户号，此处默认取demo演示页面传递的参数
				'txnTime' => $_POST["txnTime"],	//请修改被查询的交易的订单发送时间，格式为YYYYMMDDhhmmss，此处默认取demo演示页面传递的参数
		);
		
		sign ( $params ); // 签名
		
		echo $params;
	}
	
	
	
	function testSort(){
		$param = array(
				'remark' => '',
				'tranCode' => '',
				'bankCode' => '',
				'cardNum' => '',
				'certificateNum' => '',
				'tranTime' => '',
				'certificateType' => '',
				'channelNo' => '',
				'ext1' => '',
				'merchantNo' => '',
				'mobile' => '',
				'notifyUrl' => '',
				'tranDate' => '',
				'tranSerialNum' => '',
				'userName' => '',
				'version' => '',
				'YUL1' => '',
				'YUL2' => '',
				'YUL3' => '',
		);
		
		ksort($param);
		
		echo $param;
	}
	