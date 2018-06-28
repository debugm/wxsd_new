<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo C("WEB_TITLE");?></title>
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/Homecss.css" />
<script type="text/javascript" src="/Public/Home/js/js.js"></script>
</head>

<body>
<div id="dldiv" style="background-image:none; width:800px;">
 <div style="width:90%; margin:0px auto; margin-top:60px;">
   <div style="width:80%; margin:0px auto; margin-top:60px;">
    <?php if($t == 'ok'): ?><span class="glyphicon glyphicon-ok" style="font-size:80px; color:#F60"></span>
    <?php else: ?>
    <span class="glyphicon glyphicon-remove" style="font-size:80px; color:#F60"></span><?php endif; ?>
 	
    <span style="font-size:40px; color:#0C0;"><?php echo ($strtitle); ?></span>
   </div>
   <hr>
   <div style="width:100%; color:#CCC; font-size:20px; font-family:'微软雅黑'; margin-top:30px;">
   <?php echo ($strcontent); ?>
   </div>
  
   <div style="width:100%; color:#CCC; font-size:20px; font-family:'微软雅黑'; text-align:center; margin-top:30px;">
    <button type="button" class="btn btn-success btn-lg" style="font-family:'微软雅黑'; width:150px; font-size:20px" onclick="javascript:window.location.href='<?php echo U('/');?>'"><span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;登 录</button>
  
   </div>
 </div>
 
 
</div>
<?php echo tongji(0);?>
</body>
</html>