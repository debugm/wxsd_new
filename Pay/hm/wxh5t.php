<?php
require 'ApiClient.php';
//var_dump($_GET);exit();
function getIP() { 
	if (isset($_SERVER)) { 
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
	$realip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
	} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) { 
	$realip = $_SERVER['HTTP_CLIENT_IP']; 
	} else { 
	$realip = $_SERVER['REMOTE_ADDR']; 
	} 
	} else { 
	if (getenv("HTTP_X_FORWARDED_FOR")) { 
	$realip = getenv( "HTTP_X_FORWARDED_FOR"); 
	} elseif (getenv("HTTP_CLIENT_IP")) { 
	$realip = getenv("HTTP_CLIENT_IP"); 
	} else { 
	$realip = getenv("REMOTE_ADDR"); 
	} 
	} 
	return $realip; 
}
$oid = time();
$nurl = $_GET['url'];
$amt = $_GET['amt'];
$subid = $_GET['subid'];
$jurl = $_GET['jumpurl'];

$client = new ApiClient();
$client->appId = '2018011683012435';
$client->secret = 'DzN0EHc9nRosvPwqSd2kgehCMa7BXtQV';
$ip = getIP();
$response = $client->call('weixin.h5_pay',array(
    'merchant_no' => '20180116223458028645',
    'out_trade_no' => $oid,

    'goods_tag' => '123123123',     //商品标记
    'order_name' => '微信H5交易',
    'total_amount' => $amt,
    'spbill_create_ip' => $ip,
    'notify_url' => $nurl,

    'sceneInfo' => json_encode(array(
        'h5_info' => array( 
            'type' => 'Wap',
            'wap_url' => 'http://www.baidu.com',
            'wap_name' => 'BAIDU'
       ) 
    )),
    'sub_mch_id' => $subid 
));

//var_dump($response);exit();
//$response = json_decode($response,true);
$pay_url = $response['pay_url'];

$url = "http://".$jurl."/Pay/hm/jump1.php?url=".urlencode($pay_url);

//header("Location:".$url);

?>


<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8"/>
            <link href="style.css" rel="stylesheet">

            <script type="text/javascript" src="qrcode.js"></script>
<script type="text/javascript">

function onload(){


var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 200,//设置宽高
        height : 200
          });
qrcode.makeCode("<?php echo $url;?>");

}
</script>
            <title>支付页</title>
        </head>
        <body onload="onload()">
       <div class="header clearfix">
            <div class="title">
                         <div class="right">
                    <div class="clearfix">
                        <ul class="clearfix">
                   
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="table">
                <ul class="clearfix">
                    <li>商品名称：充值</li>
                    <li>订单编号：<?php echo $ddh;?></li>
                </ul>
                <p class="price">
                    金额&nbsp;&nbsp;<span><em>¥</em><?php echo $money;?>元</span>
                </p>
            </div>
            <div class="ybox clearfix">
                <div class="clearfix"></div>
            </div>
            <div class="qrc_Pay">
                <div class="weixin_l">
                    <p class="title_d fontYaHei">
                        <span class="wx"></span>
                    </p>
                </div>
                <p class="title aligncenter fontYaHei"><?php echo $msg?></p>
                <div class="clearfix">
                    <div id="qrcode" class="qrcode wx" style="margin:0 auto;">
                        
                    </div>
              	
                </div>
                <div class="ybox clearfix">
                    <div class="clearfix"></div>
                </div>
             
            </div>
        </div>
        <script src="https://cdn.bootcss.com/jquery/1.10.0/jquery.min.js"></script>
                </body>
        </html>



