<?php
header("Content-type: text/html; charset=utf-8");
$orderid = date("YmdHis").rand(100000,999999);
$amount = 0.01;
require_once 'func.php';

if(isMobile()){
?>
    <!--mobile-->
    <!DOCTYPE html>

<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
 

<meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
<meta content="no-cache" http-equiv="pragma">
<meta content="0" http-equiv="expires">
<meta content="telephone=no, address=no" name="format-detection">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes"> 
<!-- apple devices fullscreen -->

<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <head>
        <meta charset=UTF-8>
        <link href="css/m_cashier.css" rel="stylesheet">
    </head>
    <body>

    <div class="totalSum">
        <h2>订单金额</h2>
        <span style="font-size:30px;">¥1</span> </div>
        <form action="pay.php" method="post" autocomplete="off">
        商户号：<input type="text" name="userid" value="10051" ><br>
        密  钥：<input type="text" name="key" value="g2qaa5oqts63e6g3slxpjteon2edgu" size="40"><br>
        <input type="hidden" name="orderid" value="<?php echo $orderid;?>">
        测试金额：<input type="text" name="amount" value="">
    <div class="payqdList">

	支付方式：<select name="channel">

		<option value="Hmh5">微信wap</option>
		<option value="Paqqh5">QQwap</option>
		<option value="Pawxsm">微信扫码</option>
		<option value="Wxgrm">微信个人码</option>
		<option value="Pawy">网银支付</option>
		<option value="Hmtest">测试子商户</option>
	</select>



    </div>
    <div class="up_s" style="margin-top:10px"> <a href="javascript:void(0)" onclick="okpay()">立即付款</a></div>
    </form>
    <script src="https://cdn.bootcss.com/jquery/1.10.0/jquery.min.js"></script>
    <script>
        function okpay(){
            $('form').submit();
        }
    </script>
    </body>
    </html>

<?php
    }else{
?>
    <!---PC---->
    <!DOCTYPE html>
    <html lang=zh>
    <head>
        <meta charset=UTF-8>
        <link href="css/cashier.css" rel="stylesheet">
         <script src="https://cdn.bootcss.com/jquery/1.10.0/jquery.min.js"></script>
        <script type="text/javascript">
            
        function show(){


            var radio = document.getElementsByName("channel");
            for (i=0; i<radio.length; i++) {  
                if (radio[i].checked) {  
                if(radio[i].value == "Hfbwy")
                {
                    $('.bank-label').css('visibility','visible')
                }
                else
                    $('.bank-label').css('visibility','hidden')
            }  
           
        }
    }


        </script>


    </head>
    <body>
    <div class="tastesdk-box">
        <div class="header clearfix">
                    </div>
        <div class="main">
            <div class="typedemo">
                <div class="demo-pc">
                    <div class="pay-jd">
                        <form action="pay.php" method="post" autocomplete="off">


			    <!--商户号：<input type="text" name="userid" value="10051" ><br>
			    密  钥：<input type="text" size="30" name="key" value="g2qaa5oqts63e6g3slxpjteon2edgu" ><br>-->
			    会员账号：<input type="text" size="20" name="remark" placeholder="请输入充值会员名"><br>
                            <input type="hidden" name="orderid" value="<?php echo $orderid;?>">
        		    充值金额：<input type="text" name="amount" value="">
                            <div class="two-step">
				支付方式:
                                 <select name="channel">

                		<!--<option value="Hmh5">微信wap</option>
				<option value="Wxgrm">微信个人码</option>
                		<option value="Paqqh5">QQwap</option>-->
                		<option value="Pawxsm">微信扫码</option>
                		<!--<option value="Pawy">网银支付</option>
                		<option value="Hmtest">测试子商户</option>-->
			        </select>


                                <div class="btns"> <button type="submit" class="pcdemo-btn sbpay-btn" >立即支付</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
    }
?>
