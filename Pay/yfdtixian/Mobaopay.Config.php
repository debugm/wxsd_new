<?php
/* *
 * 配置文件
 * 版本：1.0
 * 日期：2015-03-25
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */
 
	/*--请在这里配置您的基本信息--*/
	
	// 商户APINAME，WEB渠道一般支付
	$mobaopay_apiname_pay = "WEB_PAY_B2C";
	$mobaopay_apiname_query = "MOBO_TRAN_QUERY";
	// 商户APINAME，商户订单信息查询
	$mobaopay_apiname_sing = "SINGLE_ENTRUST_SETT";
	// 商户APINAME，支付系统退款申请
	$mobaopay_apiname_refund = "MOBO_TRAN_RETURN";
	// 商户APINAME，结算查询
	$mobaopay_apiname_auto = "AUTO_SETT_QUERY";
	// 商户API版本
	$mobaopay_api_version = "1.0.0.0";
	// 商户API版本
	$jiufupay_api_version = "1.0.0.1";
	
	
	/****以下信息以实际为准****/
	$mbp_key = "aa63226a26018d302282abfe066feacf";
	$mobaopay_gateway = "http://cloud.kuruibo.com/cgi-bin/netpayment/pay_gate.cgi";
	// 商户在支付系统的平台号  
	$platform_id = "866376110023579";
	// 支付系统分配给商户的账号
	$merchant_acc = "866376110023579";
	// 商户通知地址（请根据自己的部署情况设置下面的路径）
	$merchant_notify_url = "http://kuruibo.com/callback.php";
	
	// 银行代码列表
	// 北京农商  
	// 工行
	$bankcode['ICBC'] = "ICBC";
	// 农行 
	$bankcode['ABC'] = "ABC";
	// 中行
	$bankcode['BOC'] = "BOC";
	// 建行
	$bankcode['CCB'] = "CCB";
	// 交行 
	$bankcode['COMM'] = "COMM";
	// 招行 
	$bankcode['CMB'] = "CMB";
	// 浦发 
	$bankcode['SPDB'] = "SPDB";
	// 兴业 
	$bankcode['CIB'] = "CIB";
	// 民生 
	$bankcode['CMBC'] = "CMBC";
	// 广发 
	$bankcode['GDB'] = "GDB";
	// 中信 
	$bankcode['CNCB'] = "CNCB";
	// 光大 
	$bankcode['CEB'] = "CEB";
	// 华夏 
	$bankcode['HXB'] = "HXB";
	// 邮储 
	$bankcode['PSBC'] = "PSBC";
	// 平安 
	$bankcode['PAB'] = "PAB";

	

?>
