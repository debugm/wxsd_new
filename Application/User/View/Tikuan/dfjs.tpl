<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<{$siteurl}>Public/css/bootstrap.min.css">
<css href="<{$siteurl}>Public/css/datepicker.css" />
<link href="<{$siteurl}>Public/__MODULE__/css/css.css" rel="stylesheet" type="text/css" />
<link href="<{$siteurl}>Public/__MODULE__/css/skgl.css" rel="stylesheet" type="text/css" />
<css href="<{$siteurl}>Public/css/jquery.alerts.css" />
<js href="<{$siteurl}>Public/js/jquery.js" />
<js href="<{$siteurl}>Public/js/bootstrap.min.js" />
<js href="<{$siteurl}>Public/js/jquery.alerts.js" />
<js href="<{$siteurl}>Public/User/js/wtjs.js" />
</head>

<body>
<ol class="breadcrumb">
  <li class="active">管理后台</li>
  <li class="active">结算管理</li>
  <li class="active">代付结算</li>
</ol>
<div id="chongzhicontent">
<br />
<div class="panel panel-default" style="width:90%; margin:0px auto;">
  <div class="panel-body" style="text-align:center;">
    <h2>代付结算</h2>
  </div>
</div>
  <div class="form-group" style="width:90%; font-size:20px; margin:0px auto; margin-top:20px; margin-bottom:20px;"> 
    <form onsubmit="return check();" action="<{:U("Tikuan/dfjsupload")}>" enctype="multipart/form-data" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">请选择结算通道</label>
    <select class="form-control" style="font-weight:bold; color:#003;" name="selecttongdao" id="selecttongdao">
                      <option value="">请选择结算通道</option>
                        <volist name="apilist" id="vo">
                        <option value="<{$vo.id}>"><{$vo.zh_payname}></option>
                        </volist>
                      </select>
  </div>
  <div class="form-group" style="display:none;">
    <label for="exampleInputEmail1">请选择结算类型</label>
    <select class="form-control" style="font-weight:bold; color:#003;" name="selectlx" id="selectlx">
                 
                        
                        <option value="0">T+0</option>
                      
                      </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">支付密码</label>
    <input type="password" class="form-control" name="paypassword" id="paypassword" >
                     
  </div>
  <div class="form-group">
    <label for="exampleInputFile">上传代付结算Excel文件&nbsp;&nbsp;&nbsp;&nbsp;<a href="/Uploads/dfmodel.xls" target="_blank">下载模板</a></label>
    <input type="file" id="fieldsname" name="fieldsname">
    <p class="help-block" style="font-size:15px; color:#F00">上传格式为 xls</p>
  </div>
  
  <button type="submit" class="btn btn-primary">提 交</button>
</form>
  </div>
</div>
<{:tongji(0)}>
</body>
</html>
