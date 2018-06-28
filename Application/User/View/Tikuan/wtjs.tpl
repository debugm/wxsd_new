<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<{$siteurl}>Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/font-awesome.css?v=4.4.0" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
 <link href="<{$siteurl}>Public/css/jquery.alerts.css" rel="stylesheet">
 
<script src="<{$siteurl}>Public/js/jquery.js" /></script>
<script src="<{$siteurl}>Public/js/bootstrap.min.js" /></script>
<script src="<{$siteurl}>Public/js/jquery.alerts.js" /></script>
<script src="<{$siteurl}>Public/User/js/wtjs.js" /></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
  <div class="row animated fadeInRight">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>委托结算</h5>
        </div>
        <div class="ibox-content">
<div id="chongzhicontent">
  <div class="form-group"> 
    <form onsubmit="return check();" action="<{:U("Tikuan/wtjsupload")}>" enctype="multipart/form-data" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">请选择结算通道</label>
    <select class="form-control"  name="selecttongdao" id="selecttongdao">
                      <option value="">请选择结算通道</option>
                        <volist name="apilist" id="vo">
                        <option value="<{$vo.id}>"><{$vo.zh_payname}></option>
                        </volist>
                      </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">请选择结算类型</label>
    <select class="form-control" name="selectlx" id="selectlx">
                      <option value="">请选择结算类型</option>
                        
                        <option value="0">T+0</option>
                        <option value="1">T+1</option>
                      </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">支付密码</label>
    <input type="password" class="form-control" name="paypassword" id="paypassword" >
                     
  </div>
  <div class="form-group">
    <label for="exampleInputFile">上传委托结算Excel文件&nbsp;&nbsp;&nbsp;&nbsp;<a href="/Uploads/model.xls" target="_blank">下载模板</a></label>
    <input type="file" id="fieldsname" name="fieldsname">
    <p class="help-block" >上传格式为 xls</p>
  </div>
  
  <button type="submit" class="btn btn-primary">提 交</button>
</form>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
<script src="<{$siteurl}>Public/Front/js/content.js?v=1.0.0"></script>
<{:tongji(0)}>
</body>
</html>
