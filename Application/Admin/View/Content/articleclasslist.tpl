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
<script type="text/javascript">
	function del(id){
		jConfirm("确认要删除此栏目吗？","提示信息",function(r){
			if(r){
				$.ajax({
				  		type:"POST",
				  		url:"<{:U("Content/articledel")}>",
				  		data:"id="+id,
				  		dataType:"text",
				  		success:function(str){
				  			if(str == "ok"){
				  				jAlert("删除成功！","提示信息");
				  				window.location.reload();
				  			}else{
				  				if(str == "nono"){
				  					jAlert("此栏目下面有子栏目，不能删除！","提示信息");
				  				}else{
				  					jAlert("删除失败，你稍后重试！","提示信息");
				  				}
				  				
				  			}
				  		},
				  		error:function(XMLHttpRequest, textStatus, errorThrown) {
											
					    }	
				  		
				});
			}
		});
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
		vertical-align: middle;
	}
	.table thead tr td{
		font-weight: bold;
	}
</style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
  <div class="col-sm-12">
<table class="table table-bordered  table-hover">
	<thead>
	<tr>
		<td>栏目名称</td>
		<td>上级栏目</td>
		<td>栏目类型</td>
		<td>栏目状态</td>
		<td>栏目编辑</td>
		<td>栏目内容</td>
		<td>删除</td>
	</tr>
	</thead>
	<volist name="list" id="vo">
		<tr>
	  	<td><{$vo.classname}></td>
		<td><{$vo["fatherid"]|getarticleclass=###}></td>
		<td>
			<if condition="$vo.type == 0">
			<span style="color: #3c67af; font-weight: bold;">列表</span>
			<else />
			<span style="color: #0c310d; font-weight: bold;">内容</span>
			</if>
		</td>
		<td>
			<if condition="$vo.status == 0">
			正常
			<else />
			<span style="color: #F32043;">禁用</span>
			</if>
		</td>
		<td>
			<if condition="$vo.delonoff == 0">
			<a href="<{:U("Content/articlclassedit","id=".$vo["id"])}>">栏目编辑</a>
			<else />
			-
			</if>
		</td>
		<td>
			<if condition="$vo.type == 1">
			<a href="<{:U("Content/ContentEdit","id=".$vo["id"])}>">内容编辑</a>
			<else />
			-
			</if>
		</td>
		<td>
			<if condition="$vo.delonoff == 0">
			<a href="javascript:del(<{$vo.id}>);">删除</a>
			<else />
			-
			</if>
			
		</td>
	 </tr>
	</volist>
	

</table>
</div>
</div>
</div>
<include file="dealrecordlModal" />
<{:tongji(0)}>
</body>
</html>
