<?php
/* *
 * 功能：退款处理文件
 * 版本：1.0
 * 日期：2012-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */

	require_once("Mobaopay.Config.php");
	require_once("lib/MobaoPay.class.php");

	// 请求数据赋值
	$data = "";
	// 商户APINAME，支付系统退款申请
	$data['apiName'] = $mobaopay_apiname_auto;
	// 商户API版本
	$data['apiVersion'] = $mobaopay_api_version;
	// 商户在支付系统的平台号
	$data['platformID'] = $platform_id;
	// 支付系统分配给商户的账号
	$data['merchNo'] = $merchant_acc;
	
	// 开始日期
	$data['startDate']=$_POST["startDate"];
	// 结束日期
	$data['endDate']=$_POST["endDate"];
	// 起始条数
	$data['startIndex']=$_POST["startIndex"];
	// 结束条数
	$data['endIndex']=$_POST["endIndex"];
	
	// 初始化
	$cMbPay = new MbPay($mbp_key, $mobaopay_gateway);
	// 准备待签名数据
	$str_to_sign = $cMbPay->prepareSign($data);
	// 数据签名
	$sign = $cMbPay->sign($str_to_sign);
	$data['signMsg'] = $sign;
	// 生成表单数据
	echo $cMbPay->buildForm($data, $mobaopay_gateway);
	
	
	
	
		
	//$resultData = $cMbPay->mobaopayTranReturn($data);
?> 