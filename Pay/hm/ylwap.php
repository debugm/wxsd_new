<?php

$oid = $_GET['oid'];
$amt = $_GET['amt'];
$nurl = $_GET['url'];
$ip = $_GET['ip'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>支付</title>

<link rel="stylesheet" type="text/css" href="css/link.css">
<link rel="stylesheet" type="text/css" href="css/layui.css">

</head>
<body>

<div class="rebinding-box">
	<div class="onebox-form" id="twoform">
		<form class="twoform" action="ylwappay.php" method="get">
			<div class="oneform-box">
				<div class="newtel">
					<label class="oneform-label">银行卡号</label>
				   <div class="oneform-input">
					 <input type="hidden"  name="oid" value="<?php echo $oid;?>">
					 <input type="hidden"  name="amt" value="<?php echo $amt;?>">
					 <input type="hidden"  name="nurl" value="<?php echo $nurl;?>">
					 <input type="hidden"  name="ip" value="<?php echo $ip;?>">
					 <input type="text" id="ntel"  name="cardno" placeholder="请输入银行卡号">
					 <input type="submit" class="twobtn" value="提交">
				  </div>
				</div>
			</div>
		</form>
	</div>
</div>

</body>
</html>
