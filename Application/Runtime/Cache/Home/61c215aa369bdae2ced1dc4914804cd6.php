<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo ($sitename); ?>---管理</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo ($siteurl); ?>Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="<?php echo ($siteurl); ?>Public/Front/css/font-awesome.css?v=4.4.0" rel="stylesheet">
<link href="<?php echo ($siteurl); ?>Public/Front/css/animate.css" rel="stylesheet">
<link href="<?php echo ($siteurl); ?>Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
<link href="<?php echo ($siteurl); ?>Public/css/jquery.alerts.css" rel="stylesheet">
  <link rel="stylesheet" src="<?php echo ($siteurl); ?>Public/Front/bootstrapvalidator/css/bootstrapValidator.min.css">

</head>
<body class="gray-bg" style="background:url('<?php echo ($siteurl); ?>Public/Front/img/spring.jpg') center repeat;">
<div class="middle-box text-center loginscreen  animated fadeInDown" style="margin-top:50px;">
  <div>
    <h3 style="color:#FFF;font-size:20px">知宇聚合支付系统</h3>
    <form class="m-t" role="form" method="post" action="<?php echo U('Admin/Index/logindl');?>" autocomplete="off">
	
      <div class="form-group">
        <input type="text" class="form-control" id="username" name="username" placeholder="用户名" required="">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="loginpassword" name="loginpassword" placeholder="密码" required="">
      </div>
      <div class="form-group">
        <input id="verification" name="verification" type="text" class="form-control"  placeholder="验证码" required="">
      </div>
	   <div class="form-group">
       <img class="verifyimg" alt="点击刷新验证码" src="<?php echo U('Index/verifycode');?>" style="cursor:pointer; width: 100%; height: 50px;"  onclick='javascript:$(".verifyimg").attr("src","<?php echo U('Index/verifycode');?>?a="+(Math.random()*100))' title="点击刷新验证码"> 
      </div>
      <button type="submit" class="btn btn-primary block full-width m-b" dlurl='<?php echo C("HOUTAINAME");?>.html' id="loginbutton" ajaxurl="<?php echo U("Admin/Index/logindl");?>">登 录</button>
    
    </form>
  </div>
</div>
<!-- 全局js -->
<script src="<?php echo ($siteurl); ?>Public/Front/js/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo ($siteurl); ?>Public/Front/js/bootstrap.min.js?v=3.3.6"></script>
<script src="<?php echo ($siteurl); ?>Public/Front/bootstrapvalidator/js/bootstrapValidator.min.js"></script>
<script src="<?php echo ($siteurl); ?>Public/Front/js/plugins/layer/layer.min.js"></script>

<script>
    $(document).ready(function() {
        $('form').bootstrapValidator({
            //container: '#messages',
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    message: '用户名验证失败',
                    validators: {
                        notEmpty: {
                            message: '用户名不能为空'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: '用户名由数字字母下划线和.组成'
                        }
                    }
                },
                loginpassword: {
                    message: '密码验证失败',
                    validators: {
                        notEmpty: {
                            message: '密码不能为空'
                        }
                    }
                },
                verification: {
                    message: '验证码验证失败',
                    validators: {
                        notEmpty: {
                            message: '邀请码不能为空'
                        },
                    }
                },
            }
        }).on('success.form.bv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function(res) {
                if(res.errorno){
                    layer.msg(res.msg, {
                        time: 3000, //3s后自动关闭
                        end:function(){
                            window.location.reload();
                        }
                    });
                }else{
                    window.location.href = "/admin.html";
                }
            }, 'json');
        });
    });
</script>
<?php echo tongji(0);?>
</body>
</html>