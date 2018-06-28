<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title><{$sitename}> - 登录</title>
    <link href="<{$siteurl}>Public/Front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<{$siteurl}>Public/Front/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link rel="stylesheet" src="<{$siteurl}>Public/Front/bootstrapvalidator/css/bootstrapValidator.min.css">
    <link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
    <link href="<{$siteurl}>Public/Front/css/style.css" rel="stylesheet">
    <link href="<{$siteurl}>Public/Front/css/login.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->
    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>
</head>
<body class="signin">
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-7">
            <div class="signin-info">
                <div class="logopanel m-b">
                    <h1>[ <{$sitename}> ]</h1>
                </div>
                <div class="m-b"></div>
                <h4>欢迎使用 <strong>商户管理面板</strong></h4>
                <ul class="m-b">
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 结算快</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 资金安全</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 多年经验</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 渠道稳定</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 大数据</li>
                </ul>
                <strong>还没有账号？ <a href="<{:U("reg")}>">立即注册&raquo;</a></strong></div>
        </div>
        <div class="col-sm-5">
            <form class="form-horizontal" id="formlogin" method="post" role="form" action="<{:U("login")}>">
                <h4 class="no-margins">登录：</h4>
                <p class="m-t-md">登录到商户管理面板</p>
                <input type="text" class="form-control uname" id="username" name="username" placeholder="用户名"
                       required="" minlength="2" aria-required="true"/>
                <input type="password" class="form-control pword m-b" id="password" name="password" placeholder="密码"
                       required="" aria-required="true"/>
                <input type="text" class="form-control uname m-b" id="verification" name="varification"
                       ajaxurl="<{:U("checkverify")}>" placeholder="验证码" required=""/>
                <p class="verify-code "><img class="verifyimg" alt="点击刷新验证码" src="<{:U('verifycode')}>"
                                             style="cursor:pointer;width:200px;"
                                             onclick='javascript:$(".verifyimg").attr("src","<{:U('verifycode')}>?a="+(Math.random()*100))'
                                             title="点击刷新验证码"></p>
                <a href="">忘记密码了？</a>
                <button class="btn btn-success btn-block">登录</button>
            </form>
        </div>
    </div>
    <div class="signup-footer">
        <div class="pull-left"> &copy; Copyright 2014 - 2017 Glacier,Inc. All Rights Reserved. 河南微云网络科技有限公司 版权所有.</div>
    </div>
</div>

<script src="<{$siteurl}>Public/Front/js/jquery.min.js?v=2.1.4"></script>
<script src="<{$siteurl}>Public/Front/js/bootstrap.min.js?v=3.3.6"></script>
<script src="<{$siteurl}>Public/Front/bootstrapvalidator/js/bootstrapValidator.min.js"></script>
<script src="<{$siteurl}>Public/Front/js/plugins/layer/layer.min.js"></script>
<script src="<{$siteurl}>Public/Front/js/login.js" type="text/javascript"></script>
<{:tongji(0)}>
</body>
</html>
