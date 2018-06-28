<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理</title>
<css href="/Public/css/bootstrap.min.css" />
<css href="/Public/Admin/css/css.css" />
<css href="/Public/css/jquery.alerts.css" />
<js href="/Public/js/jquery.js" />
<js href="/Public/js/bootstrap.min.js" />
<js href="/Public/js/jquery.alerts.js" />
<script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/ueditor/ueditor.all.js"></script>
<script type="text/javascript">
$(document).ready(function(e){
   var ue = UE.getEditor('container',{
   		autoHeight: true
   });
});
	function check(){
		content = UE.getEditor("container").getContent();
		$.ajax({
		  		type:"POST",
		  		url:$("#Form1").attr("action"),
		  		data:"id="+$("#id").val()+"&content="+content,
		  		dataType:"text",
		  		success:function(str){
		  			if(str=="ok"){
		  				jAlert("修改成功！","提示信息");
		  			}else{
		  				jAlert("修改失败，请稍后重试！","提示信息");
		  			}
		  		},
		  		error:function(XMLHttpRequest, textStatus, errorThrown) {
									
			    }	
		  		
		});
		return false;
	}
</script>
<style type="text/css">
    .table{
    	margin-top: 50px;
    }
	.table tr td{
		height: 50px;
		line-height: 50px;
		text-align:center;
	}
	
</style>
</head>

<body>
<ol class="breadcrumb">
  <li class="active">管理后台</li>
  <li class="active">内容管理</li>
  <li class="active">编辑内容页</li>
</ol>
<form name="Form1" id="Form1" method="post" action="<{:U("Content/ContentEditEdit")}>" onsubmit="return check();">
	<input type="hidden" id="id" value="<{$find["id"]}>">
<table class="table">
 
 
  
   <tr>
  	<td><b><{$find["classname"]}></b></td>
  </tr>
  <tr>
  	<td style="height: auto;">
    <!-- 加载编辑器的容器 -->
    <script id="container" name="content" type="text/plain" style="width:100%;height:400px;">
		<{$find["content"]|HTMLHTML=###}>
    </script>
  	</td>
  </tr>
  <tr>
  	<td colspan="2">
  		 <button type="submit" data-loading-text="正在处理中..." id="tjwz" class="btn btn-primary">修 改</button>&nbsp;&nbsp;&nbsp;&nbsp;
  		 <button type="button" class="btn btn-default" onclick="javascript:window.location.href='<{:U("Content/articleclasslist")}>'">返 回</button>
  	</td>
  </tr>
</table>
</form>
<include file="dealrecordlModal" />
        <{:tongji(0)}>
</body>
</html>
