<?php
header ( 'Content-type:text/html;charset=utf-8' );
include_once '../func/HFBConfig.php';
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head> 
<meta http-equiv="Content-Type"	content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if lt IE 10]>
<script>alert("为了更好的体验，不支持IE10以下的浏览器。请选择google chrome 或者 firefox 浏览器。"); location.href="http://www.hefupal.com";</script>
<![endif]-->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<title>合付宝支付-商户demo</title> 
<style type="text/css">
	body { padding-top: 70px; }
</style>

</head> 
<body> 
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
  	<a class="navbar-brand" href="index.html"><strong>首页</strong></a>
  	<a class="navbar-brand"><strong>退款（<s>ie1-9</s>）</strong></a>
  </div>
</nav>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form role="form" action="refundhandler.php" method="post"  name="payForm" >
				
				<div class="form-group">
			        <label for="merchantNo">商户号</label>
			        <input type="text" class="form-control" name="merchantNo" id="merchantNo"  value="<?php echo MERCHANTNO ?>" required>
		        </div>
                      <div class="form-group">
			        <label for="version">版本号</label>
			        <input type="text" class="form-control" name="version" id="version"  value="<?php echo VERSION ?>" required>
		        </div>
                      <div class="form-group">
			        <label for="channelNo">渠道号</label>
			        <input type="text" class="form-control" name="channelNo" id="channelNo" value="<?php echo CHANNELNO ?>" required>
		        </div>
				        
				<div class="form-group">
					<label for="tranSerialNum">原交易流水号</label>
					<input type="text" class="form-control" name="tranSerialNum" id="tranSerialNum"  required>
				</div>

				<div class="form-group">
					<label for="amount">退款金额	</label>
					<input type="number" class="form-control" name="amount" id="amount"  required>
				</div>
				
				<div class="form-group">
					<label for="refundReason">退款说明	</label>
					<input type="text" class="form-control" name="refundReason" id="refundReason"  required>
				</div>
				
				<div class="form-group">
					<label for="paySerialNo">原支付交易流水号</label>
					<input type="text" class="form-control" name="paySerialNo" id="paySerialNo"  required>
				</div>
				
				<div class="form-group">
			        <label for="tranTime">退款交易时间</label>
			        <input type="text" class="form-control" name="tranTime" id="tranTime"  required>
		        </div>
				<div class="form-group">
			        <label for="notifyUrl">通知地址</label>
			        <input type="text" class="form-control" name="notifyUrl" id="notifyUrl"  required>
		        </div>
		        
		        <div class="form-group">
			        <label for="currency">币种</label>
			        <input type="text" class="form-control" name="currency" id="currency"  value="CNY" required>
		        </div>
				<div class="form-group">
					<label for="remark">备注字段</label>
					<input type="text" class="form-control" name="remark" >
				</div>
					
				<div class="form-group">
					<label for="YUL1">预留字段1</label>
					<input type="text" class="form-control" name="YUL1" >
				</div>
					
				<button type="submit" class="btn btn-primary">退款</button>
			</form>
		</div>
	</div>
</div>

		
</body>

</html>