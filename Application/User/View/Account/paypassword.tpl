<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<link href="<{$siteurl}>Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/font-awesome.css?v=4.4.0" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/style.css?v=4.1.0" rel="stylesheet">


</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
 <div class="row">
    <div class="col-sm-12">
	  <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>密码信息</h5>
          <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
  <form role="form" id="loginpasswordform" class="form-horizontal m-t" method="post" action="<{:U("Account/editpaypassword")}>">
 
    <div class="form-group">
      <label for="yloginpassword">原支付密码：（<span style="color:#F00">默认支付密码：123456</span>）</label>
      <input type="password" style="color:#01a9ef; font-weight:bold;" class="form-control" id="yloginpassword" name="yloginpassword" placeholder="请输入支付密码">
    </div>
    
    <div class="form-group">
      <label for="loginpassword">新支付密码：</label>
      <input type="password" style="color:#000; font-weight:bold;" class="form-control" id="loginpassword" name="loginpassword" placeholder="请输入新支付密码">
    </div>
      
      <div class="form-group">
      <label for="okloginpassword">再次输入新支付密码：</label>
      <input type="password" style="color:#000; font-weight:bold;" class="form-control" id="okloginpassword" name="okloginpassword" placeholder="请再次输入新支付密码">
    </div>
      
    <button type="button" id="loading-example-btn" data-loading-text="正在处理..." class="btn btn-primary" data-target="#myModal" onclick="javascript:paypasswordsubmit(this)" ajaxurl="<{:U("Account/verifypaypassword")}>">确认修改</button>&nbsp;&nbsp;&nbsp;&nbsp;
  </form>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-describedby="tscontent">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-volume-up"></span></h4>
      </div>
      <div class="modal-body" id="tscontent" style="color:#000; font-family:'微软雅黑';"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> 关闭 </button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- 全局js -->
<script src="<{$siteurl}>Public/Front/js/jquery.min.js?v=2.1.4"></script>
<script src="<{$siteurl}>Public/Front/js/bootstrap.min.js?v=3.3.6"></script>
<!-- 自定义js -->
<script src="<{$siteurl}>Public/Front/js/content.js?v=1.0.0"></script>
<!-- jQuery Validation plugin javascript-->
<script src="<{$siteurl}>Public/Front/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<{$siteurl}>Public/Front/js/user.js"></script>
<{:tongji(0)}>
</body>
</html>
