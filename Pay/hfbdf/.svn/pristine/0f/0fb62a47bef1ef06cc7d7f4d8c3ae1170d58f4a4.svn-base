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
  	<a class="navbar-brand"><strong>代付结果查询（<s>ie1-9</s>）</strong></a>
  </div>
</nav>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form role="form" action="queryhandler.php" method="post"  name="payForm" >
				<div class="form-group">
					<label for="oriTranDate">原交易日期</label>
					<input type="text" class="form-control" name="oriTranDate" required>	
				</div>
				<div class="form-group">
					<label for="oriTranFlow">原交易流水号</label>
					<input type="text" class="form-control" name="oriTranFlow"  max-length="100" required>	
				</div>
				<button type="submit" class="btn btn-primary">提交</button>
			</form>
		</div>
	</div>
</div>

		
</body>
</html>