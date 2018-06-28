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
<script src="<{$siteurl}>Public/Front/js/jquery.js" /></script>
<script src="<{$siteurl}>Public/js/bootstrap.min.js" /></script>
<script src="<{$siteurl}>Public/js/bootstrap-datepicker.js" /></script>
<script src="<{$siteurl}>Public/js/floatDiv.js" /></script>
<script src="<{$siteurl}>Public/User/js/daili.js" /></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">

    <div class="col-sm-12">
   
 
 
<div style=" margin:0px auto;">
  <form class="form-inline" role="form">
    <div class="form-group">
      <label style="color:#01a9ef;">邀请码：</label>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="invitecodesearch" placeholder="请输入邀请码" value="<{$Think.get.invitecodesearch}>" style="width:300px;">
    </div>
    <div class="form-group" style="margin-left:20px;">
      <label style="color:#01a9ef;">使用者：</label>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="syusernamesearch" placeholder="请输入使用者用户名" style="width:150px;" value="<{$Think.get.syusernamesearch}>">
    </div>

    <div class="form-group" style="margin-left:20px;">
      <select class="form-control" id="ztsearch">
        <option value="">所有状态</option>
        <option value="1">未使用</option>
        <option value="2">已使用</option>
        <option value="0">禁用</option>
      </select>
       <script type="text/javascript">
	  $("#ztsearch").val('<{$Think.get.ztsearch}>');
	  </script>
    </div>
    <button type="button" class="btn btn-primary" style="margin-left:20px;" id="search_search"> <span class="glyphicon glyphicon-search"></span> <strong>搜索</strong> </button>
  </form>
</div>
<div style="margin:0px auto; margin-top:10px;">
  <form class="form-inline" role="form">
  <button type="button" class="btn btn-primary" style="onclick="javascript:location.reload();"><span class="glyphicon glyphicon-refresh"></span> <strong>刷新数据</strong> </button>
   
    <button type="button" class="btn btn-primary" style="margin-left:20px;" data-loading-text=" <span class='glyphicon glyphicon-plus'></span> <strong>添加邀请码</strong> " id="yqmtj" ajaxurl="<{:U("createinvite")}>"> <span class="glyphicon glyphicon-plus"></span> <strong>添加邀请码</strong> </button>

    <div class="form-group" style="margin-left:20px;">
      <select class="form-control" id="selectpage">
        <option value="__ACTION___r_15.<{:C("URL_HTML_SUFFIX")}>">每页15条信息</option>
        <option value="__ACTION___r_20.<{:C("URL_HTML_SUFFIX")}>">每页20条信息</option>
        <option value="__ACTION___r_25.<{:C("URL_HTML_SUFFIX")}>">每页25条信息</option>
        <option value="__ACTION___r_30.<{:C("URL_HTML_SUFFIX")}>">每页30条信息</option>
        <option value="__ACTION___r_35.<{:C("URL_HTML_SUFFIX")}>">每页35条信息</option>
        <option value="__ACTION___r_40.<{:C("URL_HTML_SUFFIX")}>">每页40条信息</option>
        <option value="__ACTION___r_45.<{:C("URL_HTML_SUFFIX")}>">每页45条信息</option>
        <option value="__ACTION___r_50.<{:C("URL_HTML_SUFFIX")}>">每页50条信息</option>
      </select>
      <script type="text/javascript">
	  $("#selectpage").val('__ACTION___r_<{$Think.get.r}>.<{:C("URL_HTML_SUFFIX")}>');
	  </script> 
    </div>
    
  </form>
</div>
<div class="table-responsive" style="margin:0px auto; margin-top:10px;">
  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
      
        <td><strong>邀请码</strong></td>
        <td><strong>发布者</strong></td>
        <td><strong>使用者</strong></td>
        <td><strong>生成时间</strong></td>
        <td><strong>过期时间</strong></td>
        <td><strong>使用时间</strong></td>
        <td><strong>注册类型</strong></td>
        <td><strong>状态</strong></td>
        <td><strong>删除</strong></td>
      </tr>
    </thead>
    <tbody>
      <volist name="list" id="vo">
        <tr>
   
          <td class="success"><{$vo.invitecode}></td>
          <td class="warning"><{$vo["fmusernameid"]|getusername=###}></td>
          <td class="warning"><{$vo["syusernameid"]|getusername=###}></td>
          <td class="active"><{$vo["fbdatetime"]|date='Y-m-d',###}></td>
          <td class="active"><{$vo["yxdatetime"]|date="Y-m-d",###}></td>
          <td class="active"><{$vo["sydatetime"]?date('Y-m-d',$vo["sydatetime"]):"-"}></td>
          <td class="warning"><switch name="vo.regtype">
              <case value="1">系统子管理员</case>
              <case value="2">分站管理员</case>
              <case value="3">分站子管理员</case>
              <case value="4">普通商户</case>
              <case value="5">普通代理商</case>
              <case value="6">独立代理商</case>
            </switch></td>
          <td class="warning">
          	<{$vo['id']|getinviteconfigzt=###}>
          </td>
          
          <td class="active" style="text-align:center;">
          <if condition="$vo.inviteconfigzt lt 2">
          <a href="javascript:delinvitecode('<{$vo.id}>')"><span class="glyphicon glyphicon-trash"></span></a>
          <else />
          -
          </if>
          </td>
        </tr>
      </volist>
      <tr>
      
        <td colspan="11" style="text-align:center;"><div class="pagex"> <{$_page}> </div></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</div>

 
 
<include file="szyqm" />
<include file="addyqm" />
<include file="myModal" />
  <{:tongji(0)}>
</body>
</html>
