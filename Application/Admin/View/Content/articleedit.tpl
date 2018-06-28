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
<script type="text/javascript" src="/Public/js/jquery.js" /></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js" /></script>
<script type="text/javascript" src="/Public/js/jquery.alerts.js" /></script>
<script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/ueditor/ueditor.all.js"></script>
<script type="text/javascript" src="/Public/Admin/js/articleadd.js"></script>
<style type="text/css">
 
	.table tr td{
		height: 50px;
		line-height: 50px;
		text-align: left;
	}
	.form-control{
		width: 200px;
	}
	.jsruserid{
		border: 1px solid #999;
		background-color: #EEE;
		margin-left: 10px;
	}
	#jsr button{
		margin-left: 30px;
	}
	.addjsf{
		display: none;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(e){
	   var s = "<{$find["jieshouuserlist"]}>";
	   if(s != "0|"){
	   	    $(".jsruserid").remove();
	   	    $(".addjsf").show();
	   		s = s.split("|");
	   		for(var i = 0; i < s.length; i++){
	   			if(s[i]){
	   				$('<button type="button" class="jsruserid" jsuserid="'+(s[i])+'">'+(parseInt(s[i])+10000)+'&nbsp;<span class="glyphicon glyphicon-remove"></span></button>').appendTo("#jsr");
	   			}
	   			
	   		}
	   }
	});
</script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
  <div class="col-sm-12">
<form name="Form1" id="Form1" method="post" action="<{:U("Content/articleeditedit")}>" onsubmit="return checkedit();">
	<input type="hidden" name="jieshouuserlist" id="jieshouuserlist" value="" />
	<input  type="hidden" id="id" name="id" value="<{$find["id"]}>">
<table class="table">
  <tr>
  	<td class="col-sm-1 col-xs-2">标题：</td>
  	<td><input type="text" class="form-control" name="title" id="title" placeholder="请输入标题" style="width: 400px;" value="<{$find["title"]}>"></td>
  </tr>
  <tr>
  	<td>所属栏目：</td>
  	<td>
  		<select name="articleclassid" id="articleclassid" class="form-control">
  			<option value="">顶级栏目</option>
  			<{:articleclasslist(0)}>
  		</select>
  		<script type="text/javascript">
  			$("#articleclassid").val("<{$find["articleclassid"]}>");
  		</script>
  	</td>
  </tr>
  <tr>
  	<td>状态：</td>
  	<td>
  		<select name="status" id="status" class="form-control">
  			<option value="0">正常</option>
  			<option value="1">隐藏</option>
  		</select>
  		<script type="text/javascript">
  			$("#status").val("<{$find["status"]}>");
  		</script>
  	</td>
  </tr>
   <tr>
  	<td>接收人：</td>
  	<td id="jsr">
  		
  		<input type="text" class="form-control addjsf" id="jsr_userid" placeholder="请输入商户编号" style="width: 120px; float: left;">
  		<button type="button" class="btn btn-info addjsf" id="tjjsf">添加接收人</button>
  		<button type="button" class="jsruserid" jsuserid="0">全部&nbsp;<span class="glyphicon glyphicon-remove"></span></button>
  	</td>
  </tr>
  <tr>
  	<td colspan="2" style="height: auto;">
    <!-- 加载编辑器的容器 -->
    <script id="container" name="content" type="text/plain" style="width:100%;height:300px;">
  <{$find["content"]|HTMLHTML=###}>
    </script>
  	</td>
  </tr>
  <tr>
  	<td colspan="2">
  		 <button type="submit" data-loading-text="正在处理中..." id="tjwz" class="btn btn-primary">确认修改</button>
  		 &nbsp;&nbsp;&nbsp;&nbsp;
  		 <button type="button" data-loading-text="正在处理中..." class="btn btn-default" onclick="javascript:window.location.href='<{:U("Content/articlelist")}>'">返 回</button>
  	</td>
  </tr>
</table>
</form>
</div>
</div>
</div>
    <{:tongji(0)}>
</body>
</html>
