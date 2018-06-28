<?php
/* *
 * 功能：一般支付调试入口页面
 * 版本：1.0
 * 日期：2015-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */
 	require_once("Mobaopay.Config.php");
	$time		= time();
	$orderNo	= date("YmdHis",$time);
	$tradeDate	= date("Ymd",$time); 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>支付系统商户接口范例-支付</title>
    <!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link href="Styles/mobaopay.css" type="text/css" rel="stylesheet" />
	-->
</head>
<body runat="server">
    <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" style="border: solid 1px #107929">
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
                 
                    <tr>
                        <td height="30" colspan="2" bgcolor="#6BBE18">
                            <span style="color: #FFFFFF"><a href="index.php">感谢您使用支付系统平台</a></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" bgcolor="#CEE7BD">
                            网关支付：
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <form method="post" action="pay.php" target="_blank">
                            <table>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;订单号
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="orderNo" id="orderNo" 
										value='<?php echo $orderNo; ?>' />
									</td>
								</tr>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;交易日期
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="tradeDate" id="tradeDate" 
										value='<?php echo $tradeDate; ?>' />
									</td>
								</tr>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;交易金额
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="amt" id="amt" value="0.5" />
									</td>
								</tr>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;支付方式
									</td>
									<td align="left" width="30%">
										&nbsp;&nbsp;
										<select style="WIDTH:330px" type="text"  name= "bankcode" id="bankcode">
										  <option value ="">不选择，进入收银台</option>
										  <option value="weixin">微信扫码</option>
										  <option value="wangyin">网银支付</option>
										  <option value ="ICBC">工商银行</option>
										  <option value ="ABC">农业银行</option>
										  <option value="CCB">建设银行</option>
										  <option value="BOC">中国银行</option>
										  <option value ="COMM">交通银行</option>
										  <option value="PSBC">中国邮政储蓄银行</option>
										  <option value="CEB">光大银行</option>
										  <option value="CIB">兴业银行</option>
										  <option value="CMBC">民生银行</option>
										  <option value ="CMB">招商银行</option>
										  <option value="SPDB">浦发银行</option>
										  <option value="GDB">广发银行</option>
										  <option value="CNCB">中信银行</option>
										  <option value="HXB">华夏银行</option>
										  <option value="PAB">平安银行</option>
									
											</select> 
									</td>
								</tr>
								<tr>
									<td align="left" width="30%">
									
										&nbsp;&nbsp;商户参数
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="merchParam" id="merchParam" value="abcd" />
									</td>
								</tr>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;交易摘要
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="tradeSummary" id="tradeSummary" value="支付测试" />
									</td>
								</tr>
                                <tr>
                                    <td align="left">
                                        &nbsp;
                                    </td>
                                    <td align="left">
                                        &nbsp;&nbsp;<input type="submit" value="马上支付" />
                                    </td>
                                </tr>
                            </table>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td height="5" bgcolor="#6BBE18" colspan="2">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
