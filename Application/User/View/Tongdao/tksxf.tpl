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
<script src="<{$siteurl}>Public/js/jquery.js" /></script>
<script src="<{$siteurl}>Public/js/bootstrap.min.js" /></script>
<script src="<{$siteurl}>Public/User/js/tongdao.js" /></script>
</head>
 
 <body class="gray-bg">
<div class="wrapper wrapper-content">
  <div class="row animated fadeInRight">
    <div class="col-sm-12">
      <div class="ibox">
   <div class="ibox-content">
 <input type="hidden" id="tksxfajaxurl" value="<{:U("Tongdao/tksz")}>">
 <div class="row">
<volist name="tongdaolist" id="vo">
  <div class="col-sm-4">
<div class="Payaccessdiv" id="tikuanmoney">
<ul class="list-group">
  <li class="list-group-item text-center">【<span><{$vo["zh_payname"]}></span>】<strong>提款手续费</strong></li>
  <li class="list-group-item" style="text-align:center;">
     <form role="form" id="form<{$vo.id}>">
    
    <for start="0" end="2">
    
  	<div class="tikuandiv">
    <a class="list-group-item" style="font-size:13px;"><strong>T+<sapn style="color:#F00"><{$i}></span></strong>&nbsp;&nbsp;(<span>白天</span>)</a>
    <div class="input-group">
      <div class="input-group-addon"><{:huoqutktype()}></div>
      <input class="form-control" type="text" disabled="disabled" style="font-size:15px; font-weight:bold" onkeyup="clearNoNum(this)" id="t<{$i}>b" name="t<{$i}>b">
    </div>
    </div>
    
    <div class="tikuandiv">
    <a class="list-group-item" style="font-size:13px;"><strong>T+<sapn style="color:#F00"><{$i}></span></strong>&nbsp;&nbsp;(<span>晚间</span>)</a>
    <div class="input-group">
      <div class="input-group-addon"><{:huoqutktype()}></div>
      <input class="form-control" type="text" disabled="disabled" style="font-size:15px; font-weight:bold"  onkeyup="clearNoNum(this)" id="t<{$i}>w" name="t<{$i}>w">
    </div>
    </div>
    
    <div class="tikuandiv">
    <a class="list-group-item" style="font-size:13px;"><strong>T+<sapn style="color:#F00"><{$i}></span></strong>&nbsp;&nbsp;(<span>节假日</span>)</a>
    <div class="input-group">
      <div class="input-group-addon"><{:huoqutktype()}></div>
      <input class="form-control" type="text" disabled="disabled" style="font-size:15px; font-weight:bold"  onkeyup="clearNoNum(this)" id="t<{$i}>j" name="t<{$i}>j">
    </div>
    </div>
    
  </for>
   
     </form>
 
  </li>
</ul>
</div>
</div>
</volist>
</div>
</div>
</div>
</div>
</div>
</div>
<{:tongji(0)}>
</body>
</html>
