<?php
/* *
 * 功能：一般支付处理文件
 * 版本：1.0
 * 日期：2012-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */
 
	require_once("Mobaopay.Config.php");
	require_once("lib/MobaoPay.class.php");


	// 请求数据赋值
	$data = "";
	// 商户APINMAE，WEB渠道一般支付
	$data['apiName'] = "MERCH_AMT_QUERY";
	// 商户API版本
	$data['apiVersion'] = "1.0.0.0";
	// 商户在支付系统的平台号
	$data['platformID'] = $platform_id;
	// 支付系统分配给商户的账号
	$data['merchNo'] = $merchant_acc;
	$data['txnType'] = "1";
	$data['tradeDate'] = date('Ymd');
	
	
	// 初始化
	$cMbPay = new MbPay($mbp_key, $mobaopay_gateway);
	// 准备待签名数据
	$str_to_sign = $cMbPay->prepareSign($data);
	// 数据签名
	$sign = $cMbPay->sign($str_to_sign);
	$data['signMsg'] = $sign;
	// 生成表单数据
	echo $cMbPay->buildForm($data, $mobaopay_gateway);
	
	//$cMbPay->mobaopayOrder($data);
?> 
