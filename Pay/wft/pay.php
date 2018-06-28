<?php

$img = $_GET['img'];
$amt = $_GET['amt'];
$oid = $_GET['oid'];

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
qrcode.makeCode("<?php echo $img;?>");

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
                    <li>订单编号：<?php echo $oid;?></li>
                </ul>
                <p class="price">
                    金额&nbsp;&nbsp;<span><em>¥</em><?php echo $amt;?>元</span>
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
        <script>
          $(document).ready(function (e) {
                r = window.setInterval(function () {
                    $.ajax({
                        type: 'POST',
                        url: 'check.php',
                        data: "orderid=<?php echo $ddh;?>",
                        dataType: 'json',
                        success: function (str) {
                            if (str.status == "ok") {

                                window.location.href = str.callback;
                            }
                        }
                    });
                }, 2000);
            });
        </script>
        </body>
        </html>



