<html>
<head>
<title>在线充值</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<style>
*{ font-family:Arial, Helvetica, sans-serif;
font-size:12px}
.STYLE1 {font-size: 12px}
</style>
</head>
<body>
<html>
<head>
<title>网银充值</title>
<style>
*{ font-family:Arial, Helvetica, sans-serif;
font-size:12px}
.STYLE1 {font-size: 12px}
</style>
</head>
<body>
<div style="text-align:center">
  <h2>请选择网上银行</h2>
</div>

<form name="form1" action="pay.php" method="post" target="_blank">
  <table width="445" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#99CC00 solid 2px">
    <tr>
      <td  colspan="2" align="center" bordercolor="#00CCFF">

<table width="68%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td width="20%" height="25" align="left" bgcolor="#FFFFFF"><input type="radio" name="Bankco" value="Qtwx"  />微信支付</td>
          <td width="20%" align="left" bgcolor="#FFFFFF"><input type="radio" name="Bankco" value="Qtzfb" />支付宝支付</td>
		  <td width="20%" align="left" bgcolor="#FFFFFF"><input type="radio" name="Bankco" value="Tfbbank" />网银支付</td>
      <td width="20%" align="left" bgcolor="#FFFFFF"><input type="radio" name="Bankco" value="IntQQ" />Intqq扫码</td>
       <td width="20%" align="left" bgcolor="#FFFFFF"><input type="radio" name="Bankco" value="Qtqq" />qq扫码</td>
          </tr>
	<tr>
      <td width="20%" align="left" bgcolor="#FFFFFF"><input type="radio" name="Bankco" value="IntWx" />IntWx扫码</td>
      <td width="20%" align="left" bgcolor="#FFFFFF"><input type="radio" name="Bankco" value="IntKj" />IntKj扫码</td>
      <td width="20%" align="left" bgcolor="#FFFFFF"><input type="radio" name="Bankco" value="IntJd" />IntJd扫码</td>
          </tr>

        </table>充值金额：<input type="text" name="Moneys" value="1" />
</td>
    </tr>
    <tr>
      <td height="36" colspan="2" align="center"><input type="submit" name="submit2" value="确认付款" onclick="return checkMoney()" /></td>
    </tr>
  </table>
</form>
</body>
</html>
