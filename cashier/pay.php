<?php

require_once 'func.php';


//var_dump($_POST);exit();


$pay_orderid = date('YmdHis')."_".$_POST['remark'];
$pay_amount = $_POST['amount'];
$chanel = $_POST['channel'];
$bank  = $_POST['bank'];


if(isset($_POST)) {
    switch ($chanel) {


	case 'Hmh5':
		$bankcode = 'WXH5';
	break;

	case 'Pawxsm':
		$bankcode = 'WXPAY';
	break;

	case 'Paqqh5': 
		$bankcode = 'QQH5';
	break;

	case 'Pawy': 
		$bankcode = 'WYPAY';
	break;

	case 'Hmtest': 
		$bankcode = 'QQPAY';
	break;

	case 'Wxgrm': 
		$bankcode = 'WXGRM';
	break;

   }
    //$pay_memberid = $_POST['userid'];   //商户ID
    $pay_memberid = 10051;   //商户ID
    //$pay_amount = "0.01";    //交易金额
    $pay_applydate = date("Y-m-d H:i:s");  //订单时间

    $pay_notifyurl = "http://nanhe111.cn/cashier/server.php";   //服务端返回地址
    $pay_callbackurl = "http://nanhe111.cn/cashier/page.php";  //页面跳转返回地址
    //$Md5key = $_POST['key'];
    $Md5key = 'g2qaa5oqts63e6g3slxpjteon2edgu';
    $gateway = "http://nanhe111.cn/Pay_Index.html";   //提交地址


    $jsapi = array(
        "pay_memberid" => $pay_memberid,
        "pay_orderid" => $pay_orderid,
        "pay_amount" => $pay_amount,
        "pay_applydate" => $pay_applydate,
        "pay_bankcode" => $bankcode,
        "pay_notifyurl" => $pay_notifyurl,
        "pay_callbackurl" => $pay_callbackurl,
    );
    ksort($jsapi);
    $md5str = "";
    foreach ($jsapi as $key => $val) {
        $md5str = $md5str . $key . "=" . $val . "&";
    }
    $str = $md5str."key=".$Md5key;
    $sign = strtoupper(md5($str));
    $jsapi["pay_md5sign"] = $sign;
    $jsapi["pay_tongdao"] = $chanel; //通道
    $jsapi["pay_tradetype"] = $tradetype; //支付类型
    $jsapi["pay_productname"] = '测试应用-支付功能体验(非商品消费)'; //商品名称
	//var_dump($jsapi);exit();
}
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>支付Demo</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style> 
.tabPages{
margin-top:150px;text-align:center;display:block; border:3px solid #d9d9de; padding:30px; font-size:14px;
}
</style>
<body onLoad="document.dinpayForm.submit();">
<div id="Content">
  <div class="tabPages">我们正在为您连接支付，请稍等......</div>
</div>
<div class="container">
    <div class="row" style="margin:15px;0;">
        <div class="col-md-12">

            <form class="form-inline" name="dinpayForm" method="post" action="<?php echo $gateway; ?>">
                <?php
                foreach ($jsapi as $key => $val) {
                    echo '<input type="hidden" name="' . $key . '" value="' . $val . '">';
                }
                ?>
            </form>
        </div>
    </div>

</div>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>



       
