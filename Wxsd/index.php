
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>微信支付</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="app.png">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/iconfont.css">
<script type="text/javascript" src="js/flexible.js"></script>
    <script src="js/jquery-1.8.js"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">当前浏览器版本太低,建议升级道最新版本</p>
<![endif]-->
    <form method="post" action="pay.php" id="myform">			

<div id="container">
	<!--<p class="title">快速充值</p>
	<ul class="ulList">
		<li><a href="#" money="50">50元</a></li>
		<li class="on"><a href="#" money="100">100元</a></li>
		<li><a href="#" money="500">500元</a></li>
		<li><a href="#" money="1000">1000元</a></li>
		<li><a href="#" money="5000">5000元</a></li>
		<li><a href="#" money="50000">50000元</a></li>
	</ul>-->
	<p class="title">会员账号</p>
	<div class="info">
		<input type="text" value="" placeholder="请准确填写充值的会员账号，充值错误会导致充值失败" id="username" name="username" >
	</div>
	<p class="title">充值金额</p>
	<div class="info">
		<input type="text" value="" placeholder="请输入充值的金额，最小10元，最大2000元"  id="coin" name="coin">
	</div>
	<div class="link"><a href="javascript:void(0)" onclick="payCheck()">微信支付</a></div>
	
</div>
                    <div class="pop pop1" style="display: none;">
            <p class="error">
                <br />
            </p>
        </div>

                <input type="hidden" id="rusername" name="rusername">
                <input type="hidden" id="radzhif_code" name="radzhif_code" value="70">
        </form>
    <script type="text/javascript">



        //提示窗口
        function errShow(content) {
            $('.error').html(content);
            $('.pop1').show();
            setTimeout("errHide()", 2000);
        }

        //隐藏错误提示
        function errHide() {
            $('.pop1').hide();
            $('.error').text('');
            $("#error").html('');
            ;
        }

        //登陆提示
        function loginShow(content) {
            $('.error').html(content);
            $('.pop1').show();
        }

        //点击关闭错误提示
        $('.pop1').live('click', function () {
            errHide();
        })

        //点击关闭错误提示
        $('.pop').live('click', function () {
            errHide();
        })

        //浏览器记住密码时，jquery取不到输入框中的值，所以直接用js取值
        function checkcardno() {
            var cardno = document.getElementById("username").value;
            if (cardno == "") {
                errShow("请填写会员账号");
                return false;
            }
            return true;
        }

        function checkcardpwd() {
            var cardpwd = document.getElementById("coin").value;
            if (cardpwd == "") {
                errShow("请输入充值金额");
                return false;
            }
            return true;
        }

        //登陆校验
        function login() {
            if (!loginCheck()) {
                return;
            }
        }

        function payCheck() {
            if (checkcardno() && checkcardpwd()) {
                $("#rusername").val($("#username").val());
                $("#myform").submit();
            }
            return false;
        }
        $(function () {
            $(".ulList li a").click(function () {
                $(".ulList li").removeClass("on");
                $(this).parent().addClass("on");
                $("#coin").val($(this).attr("money"))
            });
        })
</script>

</body>
</html>

