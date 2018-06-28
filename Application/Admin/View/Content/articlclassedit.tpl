<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title><{$sitename}></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<{$siteurl}>Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
<link href="<{$siteurl}>Public/css/jquery.alerts.css" rel="stylesheet">
<script type="text/javascript" src="<{$siteurl}>Public/js/jquery.js" /></script>
<script type="text/javascript" src="<{$siteurl}>Public/js/bootstrap.min.js" /></script>
<script type="text/javascript" src="<{$siteurl}>Public/js/jquery.alerts.js" /></script>
<script type="text/javascript">
$(document).ready(function(e){
  $("#fatherid").val(<{$find["fatherid"]}>);
  $("#type").val(<{$find["type"]}>);
  $("#status").val(<{$find["status"]}>);
});
	function check(){
		if(!$("#classname").val()){
			jAlert("栏目名称不能为空","提示信息");
			return false;
		}else{
			var $btn = $("#qrtj").button('loading');
			$.ajax({
			  		type:"POST",
			  		url:$("#Form1").attr("action"),
		data:"id="+$("#classid").val()+"&classname="+$("#classname").val()+"&fatherid="+$("#fatherid").val()+"&type="+$("#type").val()+"&status="+$("#status").val(),
			  		dataType:"text",
			  		success:function(str){
			  			if(str == "ok"){
			  				jAlert("栏目修改成功！","提示信息");
			  				$("#classname").val("");
			  			}else{
			  				jAlert("栏目修改失败，请稍后重试！","提示信息");
			  			}
			  			$btn.button('reset');
			  		},
			  		error:function(XMLHttpRequest, textStatus, errorThrown) {
			  			jAlert("系统错误，添加失败！","提示信息");
						$btn.button('reset');			
				    }	
			  		
			});
		}
		
		return false;
	}
</script>
 
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
  <div class="col-sm-12">
<form name="Form1" id="Form1" method="post" action="<{:U("Content/articleclasseditedit")}>" onsubmit="return check();">
<input type="hidden" name="classid" id="classid" value="<{$find["id"]}>">
<table class="table">
  <tr>
  	<td class="col-sm-1 col-xs-2">栏目名称：</td>
  	<td><input type="text" class="form-control" name="classname" id="classname" placeholder="请输入栏目名称" value="<{$find["classname"]}>"></td>
  </tr>
  <tr>
  	<td>上级栏目：</td>
  	<td>
  		<select name="fatherid" id="fatherid" class="form-control">
  			<option value="0">顶级栏目</option>
  			<{:articleclasslist(0)}>
  		</select>
  	</td>
  </tr>
  <tr>
  	<td>栏目类型：</td>
  	<td>
  		<select name="type" id="type" class="form-control">
  			<option value="0">列表</option>
  			<option value="1">内容</option>
  		</select>
  	</td>
  </tr>
  <tr>
  	<td>栏目状态：</td>
  	<td>
  		<select name="status" id="status" class="form-control">
  			<option value="0">正常</option>
  			<option value="1">禁用</option>
  		</select>
  	</td>
  </tr>
  <tr>
  	<td colspan="2">
  		 <button type="submit" data-loading-text="正在处理中..." id="qrtj" class="btn btn-primary">修改</button>&nbsp;&nbsp;&nbsp;&nbsp;
  		 <button type="button" class="btn btn-default" onclick="javascript:window.location.href='<{:U("Content/articleclasslist")}>'">返 回</button>
  	</td>
  </tr>
</table>
</form>
</div>
</div>
</div>
<include file="dealrecordlModal" />
<{:tongji(0)}>
</body>
</html>
