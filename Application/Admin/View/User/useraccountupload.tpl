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
<link href="/Public/css/jquery.alerts.css" rel="stylesheet">
  <link href="/Public/Front/js/plugins/layui/css/layui.css" rel="stylesheet">
<script type="text/javascript" src="/Public/js/jquery.js" /></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js" /></script>
<script type="text/javascript" src="/Public/js/jquery.alerts.js" /></script>
<script type="text/javascript" src="/Public/Front/js/plugins/layui/layui.js" /></script>
<script type="text/javascript" src="/Public/js/tupian.js" /></script>
<script type="text/javascript" src="/Public/Admin/js/usercontrol.js" /></script>
  <script type="text/javascript" src="/Public/laydate/laydate.js" /></script>
<script type="text/javascript" src="/Public/js/zy.js" /></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
  <div class="col-sm-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>用户通道账户上传</h5>
      </div>
      <div class="ibox-content">
	<form action="<{:U("User/upload")}>" enctype="multipart/form-data" method="post" >
	<div class="caption">
              <input type="hidden" name="fieldsname" value="uploadsfzzm">
              <label for="uploadsfzzm">上传用户通道列表</label>
              <input type="file" id="uploadsfzzm" name="uploadsfzzm" style="width:100%;">
              <br>
              <input type="submit" class="btn btn-primary" value="上 传" />
          </div>
	</form>
             <a href="http://mer.jiandundingzhi.com/data/template.csv" class="btn btn-primary" value="下载模版">下载模版</a>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
