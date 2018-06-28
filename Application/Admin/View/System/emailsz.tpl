<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title><{:C("WEB_TITLE")}></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="/Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="/Public/Front/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
<link href="/Public/Front/css/animate.css" rel="stylesheet">
<link href="/Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/<{$Public}>/js/js.js"></script>
<script type="text/javascript" src="/Public/<{$Public}>/js/systemjs.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
  <div class="col-sm-12">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>邮箱设置</h5>
          </div>
          <div class="ibox-content">
              <form role="form" id="form1" method="post" action="<{:U("System/emailszedit")}>">
                  <input type="hidden" name="id" id="id" value="<{$vo.id}>">
                  <div class="form-group">
                      <label for="smtp_host">smtp服务器</label>
                      <input type="text" style="color:#01a9ef; font-weight:bold;" class="form-control" id="smtp_host" name="smtp_host" value="<{$vo.smtp_host}>" placeholder="例如：smtp.qq.com">
                  </div>
                  <div class="form-group">
                      <label for="smtp_port">smtp服务器端口</label>
                      <input type="text" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="smtp_port" name="smtp_port" value="<{$vo.smtp_port}>"  placeholder="例如：456, 如果是QQ邮箱的话可以为空">
                  </div>
                  <div class="form-group">
                      <label for="smtp_user">smtp服务器用户名</label>
                      <input type="email" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="smtp_user" name="smtp_user" value="<{$vo.smtp_user}>"  placeholder="例如：zhifu@quefu.cn">
                  </div>
                  <div class="form-group">
                      <label for="smtp_pass">smtp服务器密码</label>
                      <input type="password" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="smtp_pass" name="smtp_pass" value="<{$vo.smtp_pass}>"  placeholder="QQ邮箱，请填写授权码">
                  </div>
                  <div class="form-group">
                      <label for="smtp_email">发件人Email账号</label>
                      <input type="email" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="smtp_email" name="smtp_email" value="<{$vo.smtp_email}>"  placeholder="例如：info@zhiyu.cc">
                  </div>
                  <div class="form-group">
                      <label for="smtp_name">发件人姓名</label>
                      <input type="text" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="smtp_name" name="smtp_name" value="<{$vo.smtp_name}>"  placeholder="例如：知宇支付平台">
                  </div>

                  <button type="button" id="loading-example-btn" data-loading-text="正在处理..." class="btn btn-primary btn-sm" data-target="#myModal" >确认修改</button>
                  <button type="reset" class="btn btn-warning btn-sm" id="reset-btn">重 置</button>
              </form>
              <div class="form-group" style="height:30px;"></div>
              <div class="form-group">
                  <label for="cs_email">测试收件邮箱地址</label>
                  <input type="email" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="cs_text" name="cs_text" value=""  placeholder="例如：info@zhiyu.cc" url="<{:U("System/csfamail")}>">
              </div>
              <button type="button" id="csfsyj" data-loading-text="正在处理..." class="btn btn-primary btn-sm">测试发送邮件</button>
          </div>
      </div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-describedby="tscontent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-volume-up"></span></h4>
            </div>
            <div class="modal-body" id="tscontent" style="color:#000; font-family:'微软雅黑';">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    关闭
                </button>

            </div>
        </div>
    </div>
</div>
<script src="/Public/Front/js/content.js?v=1.0.0"></script>
<{:tongji(0)}>
</body>
</html>
