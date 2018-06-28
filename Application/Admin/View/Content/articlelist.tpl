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
<script type="text/javascript" src="/Public/laydate/laydate.js" /></script>
<script type="text/javascript" src="/Public/Admin/js/dealrecord.js" /></script>
<script type="text/javascript" src="/Public/js/zy.js" /></script>
<script type="text/javascript">
	$(document).ready(function(e){
	   $("#ptshsearch").click(function(e){
	   	  memberid = $("#memberid").val();
	   	  articleclassid = $("#articleclassid").val();
	   	  tjdate_ks = $("#tjdate_ks").val();
	   	  tjdate_js = $("#tjdate_js").val();
	   	  r = $("#r").val();
	   	  window.location.href = "?memberid="+memberid+"&articleclassid="+articleclassid+"&tjdate_ks="+tjdate_ks+"&tjdate_js="+tjdate_js+"&r="+r;
	   });
	});
</script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
  <div class="col-sm-12">
<div style="margin:0px auto;">
  <form class="form-inline" role="form">
  	<div class="form-group">
      <input type="text" style="width:200px;" class="form-control zy-searchstr" id="memberid" name="memberid" placeholder="请输入标题" value="<{$Think.get.memberid}>">
    </div>
  	<div class="form-group" style="margin-left:20px;">
  		<select name="articleclassid" id="articleclassid" class="form-control">
  			<option value="">所有栏目</option>
  			<{:articleclasslist(0)}>
  		</select>
  	</div>
  	<div class="form-group" style="margin-left:20px;">
     提交时间：
    </div>
    <div class="form-group">
      <input type="text"  id="tjdate_ks" name="tjdate_ks"  class="laydate-icon zy-searchstr" onclick="laydate()" style="font-size: 25px; height: 30px; width:160px;" value="<{$Think.get.tjdate_ks}>">
    </div>
    <div class="form-group" style="margin-left:20px;">
     至
    </div>
    <div class="form-group" style="margin-left:20px;">
     <input type="text"  id="tjdate_js" name="tjdate_js"  class="laydate-icon zy-searchstr" onclick="laydate()" style="font-size: 25px; height: 30px; width:160px;" value="<{$Think.get.tjdate_js}>">
    </div>
    <div class="form-group" style="margin-left:20px;">
      <select class="form-control zy-searchstr" id="r" name="r">
        <option value="15">每页15条信息</option>
        <option value="20">每页20条信息</option>
        <option value="25">每页25条信息</option>
        <option value="30">每页30条信息</option>
        <option value="35">每页35条信息</option>
        <option value="40">每页40条信息</option>
        <option value="45">每页45条信息</option>
        <option value="50">每页50条信息</option>
      </select>
      <script type="text/javascript">
	  $("#r").val('<{$Think.get.r}>');
	  </script> 
    </div>
    <button type="button" class="btn btn-primary zy-searchbutton" style="margin-left:20px;" id="ptshsearch"> <span class="glyphicon glyphicon-search"></span> <strong>搜索</strong> </button>
  </form>
</div>

<div class="table-responsive" style="margin:0px auto; margin-top:10px;">
  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
      	<td>&nbsp;</td>
        <td><strong>所属栏目</strong></td>
        <td><strong>标题</strong></td>
        <td><strong>发布人</strong></td>
        <td><strong>发布时间</strong></td>
        <td><strong>状态</strong></td>
        <td><strong>接收人</strong></td>
        <td><strong>浏览量</strong></td>
        <td><strong>编辑</strong></td>
        <td><strong>删除</strong></td>
        <td><strong>查看</strong></td>
      </tr>
    </thead>
    <tbody>
      <volist name="list" id="vo">
        <tr>
          <td style="text-align: center; vertical-align: middle;"><{$key+1}></td>
          <td style="text-align:center;"><{$vo["articleclassid"]|Getarticleclass=###}></td>
          <td style="text-align:center;"><{$vo.title}></td>
          <td style="text-align:center;"><{$vo["userid"]|getusername=###}></td>
          <td style="text-align:center;"><{$vo.datetime}></td>
          <td style="text-align:center;">
          	<if condition="$vo.status == 0">
          		正常
          		<else />
          		隐藏
          	</if>
          </td>
          <td style="text-align:center;"><{$vo["jieshouuserlist"]|jieshouuserlist=###}></td>
          <td style="text-align:center;"><a href="javascript:browsenum(<{$vo["id"]}>)"><{$vo["id"]|browsenum=###}></a></td> 
          <td style="text-align:center;"><a href="<{:U("Content/articleedit","id=".$vo["id"])}>">编辑</a></td>
          <td style="text-align:center;"><a href="javascript:deldel(<{$vo["id"]}>,'<{:U("Content/delaritcle")}>')">删除</a></td>
          <td style="text-align:center;"><a href="javascript:editshow(<{$vo["id"]}>)">查看</a></td>
          
        </tr>
      </volist>
      <tr>
        <td colspan="14" style="text-align:center;"><div class="pagex"> <{$_page}></div></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</div>
</div>
<include file="dealrecordlModal" />
<{:tongji(0)}>
</body>
</html>
