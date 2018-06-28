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
            <h5>基本设置</h5>
        </div>
        <div class="ibox-content">
            <form role="form" id="form1" method="post" action="<{:U("System/jbszedit")}>">
                    <input type="hidden" name="id" id="id" value="<{$vo.id}>">
                    <div class="form-group">
                        <label for="websitename">网站名称</label>
                        <input type="text" style="color:#01a9ef; font-weight:bold;" class="form-control" id="websitename" name="websitename" value="<{$vo.websitename}>" placeholder="例如：雀付支付">
                    </div>
                    <div class="form-group">
                        <label for="domain">域名</label>
                        <input type="text" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="domain" name="domain" value="<{$vo.domain}>"  placeholder="例如：www.quefu.cn">
                    </div>
                    <div class="form-group">
                        <label for="email">电子邮箱</label>
                        <input type="text" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="email" name="email" value="<{$vo.email}>"  placeholder="例如：zhifu@quefu.cn">
                    </div>
                    <div class="form-group">
                        <label for="tel">网站客服电话</label>
                        <input type="text" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="tel" name="tel" value="<{$vo.tel}>"  placeholder="例如：400 0000 000 ">
                    </div>
                    <div class="form-group">
                        <label for="qq">网站客服QQ</label>
                        <input type="text" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="qq" name="qq" value="<{$vo.qq}>"  placeholder="多个QQ号用 | 分隔">
                    </div>
                    <div class="form-group">
                        <label for="directory">管理后台目录</label>
                        <input type="text" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="directory" name="directory" value="<{$vo.directory}>"  placeholder="默认为Admin，留空为默认">
                    </div>
                    <div class="form-group">
                        <label for="directory">管理后台登录地址名称</label>
                        <input type="text" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="login" name="login" value="<{$vo.login}>"  placeholder="默认为Login，留空为默认">
                    </div>
                    <div class="form-group">
                        <label for="icp">网站备案号</label>
                        <input type="text" style="color:#01a9ef; font-weight:bold;"  class="form-control" id="icp" name="icp" value="<{$vo.icp}>"  placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="tongji">网站统计代码</label>
                        <textarea style="color:#01a9ef; font-weight:bold;"  class="form-control" rows="3" id="tongji" name="tongji"><{$vo.tongji}></textarea>
                    </div>
                <button type="button" id="loading-example-btn" data-loading-text="正在处理..." class="btn btn-primary btn-sm" data-target="#myModal" >确认修改</button>
                <button type="reset" class="btn btn-warning btn-sm" id="reset-btn">重 置</button>
            </form>
        </div>
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
