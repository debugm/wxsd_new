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
    <title>支付系统商户接口范例-委托代付</title>
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
                            委托代付：
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <form method="post" action="EntrustedPay.php" target="_blank">
                            <table>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;商户订单号
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
									<td align="left" width="30%">
										&nbsp;&nbsp;银行卡户名
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="bankAccName" id="bankAccName" value="测试" />
									</td>
								</tr>
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;银行卡开户行名称
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="bankName" id="bankName" value="工商银行成都高新支行" />
									</td>
								</tr>
								
								
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;银行卡归属银行
									</td>
									<td align="left" width="30%">
										&nbsp;&nbsp;
										<select style="WIDTH:330px" type="text"  name= "bankcode" id="bankcode">
										 <option value ="ICBC">工商银行</option>
										  <option value ="ABC">农业银行</option>
										  <option value="CCB">建设银行</option>
										  <option value="BOC">中国银行</option>
										  <option value="PSBC">中国邮政储蓄银行</option>
										  <option value="CEB">光大银行</option>
										  <option value="CIB">兴业银行</option>
										  <option value="GDB">广州发展银行</option>
										  <option value="CMBC">民生银行</option>
										  <option value="CMB">招商银行</option>
										  <option value="COMM">交通银行</option>
										  <option value="SPDB">浦发银行</option>
								          <option value="CNCB">中信银行</option>
								          <option value="HXB">华夏银行</option>
										  <option value="PAB">平安银行</option>
								          <option value="BOBJ">北京银行</option>
								          <option value="BEA">东亚银行</option>
										  <option value="CZSB">浙商银行</option>
										  <option value="BOSH">上海银行</option>
								          <option value="BOHF">恒丰银行</option>
								          <option value="BOCD">成都银行</option>
										  <option value="JZTLYH">浙江泰隆商业银行</option>
								          <option value="CBHB">渤海银行</option>
                                          <option value="CCBANK">城市商业银行</option>
								          <option value="CRBANK">农村商业银行</option>
								          <option value="OBANK">其他银行</option>
											</select> 
									</td>
								</tr>
								
							
								<tr>
									<td align="left" width="30%">
										&nbsp;&nbsp;银行卡号
									</td>
									<td align="left">
										&nbsp;&nbsp;<input size="50" type="text" name="bankAccNo" id="bankAccNo" value="6226123400009999888" />
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

