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
<script src="<{$siteurl}>Public/laydate/laydate.js" /></script>
<script src="<{$siteurl}>Public/Admin/js/tklist.js" /></script>
<script src="<{$siteurl}>Public/User/js/js.js" /></script>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">
  <div class="row animated fadeInRight">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>委托结算记录</h5>
        </div>
        <div class="ibox-content">
<div style="margin:0px auto;">
  <form class="form-inline" role="form">
   
    <div class="form-group" style="margin-left:20px;">
      <select class="form-control zy-searchstr" id="bank" name="bank">
        <option value="">全部银行</option>
        <volist name="banklist" id="vo">
        	<option value="<{$vo.bankname}>"><{$vo.bankname}></option>
        </volist>
      </select>
      <script type="text/javascript">
	   $("#bank").val('<{$Think.get.bank}>');
	  </script> 
    </div>
     <div class="form-group" style="margin-left:20px;">
      <select class="form-control zy-searchstr" id="T" name="T">
       <option value="">全部类型</option>
        <option value="0">T + 0</option>
        <option value="1">T + 1</option>
      </select>
      <script type="text/javascript">
	   $("#T").val('<{$Think.get.T}>');
	  </script> 
    </div>
    <div class="form-group" style="margin-left:20px;">
      <select class="form-control zy-searchstr" id="status" name="status">
        <option value="">全部状态</option>
        <option value="0">未处理</option>
        <option value="1">处理中</option>
        <option value="2">已打款</option>
      </select>
      <script type="text/javascript">
	  $("#status").val('<{$Think.get.status}>');
	  </script> 
    </div>
  </form>
</div>
<div style=" margin:0px auto; margin-top: 20px;">
  <form class="form-inline" role="form">
  	<div class="form-group" style="margin-left:20px;">
     申请时间：
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
    <div class="form-group" style="margin-left:40px;">
     打款时间：
    </div>
    <div class="form-group">
      <input type="text"  id="cgdate_ks" name="cgdate_ks"  class="laydate-icon zy-searchstr" onclick="laydate()" style="font-size: 25px; height: 30px; width:160px;" value="<{$Think.get.cgdate_ks}>">
    </div>
    <div class="form-group" style="margin-left:20px;">
     至
    </div>
    <div class="form-group" style="margin-left:20px;">
     <input type="text"  id="cgdate_js" name="cgdate_js"  class="laydate-icon zy-searchstr" onclick="laydate()" style="font-size: 25px; height: 30px; width:160px;" value="<{$Think.get.cgdate_js}>">
    </div>
    <button type="button" class="btn btn-primary zy-searchbutton" style="margin-left:20px;" id="ptshsearch"> <span class="glyphicon glyphicon-search"></span> <strong>搜索</strong> </button>&nbsp;&nbsp;
  </form>
</div>

<div class="table-responsive" style="margin:0px auto; margin-top:10px;">
  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
        
        <td><strong>类型</strong></td>
        <td><strong>通道</strong></td>
        <td><strong>结算金额</strong></td>
        <td><strong>手续费</strong></td>
        <td><strong>到账金额</strong></td>
        <td><strong>银行名称</strong></td>
        <td><strong>支行名称</strong></td>
        <td><strong>银行卡号</strong></td>
        <td><strong>开户名</strong></td>
        <td><strong>开户省</strong></td>
        <td><strong>开户市</strong></td>
        <td><strong>申请时间</strong></td>
        <td><strong>处理时间</strong></td>
        <td><strong>状态</strong></td>
      </tr>
    </thead>
    <tbody style="background-color:#FFF">
    <volist name="list" id="vo">
        <tr>
         
          <td style="text-align: center; vertical-align: middle; font-weight:bold;">T+<{$vo.t}></td>
          <td style="text-align: center; ">
          <{:huoqutongdaoname($vo["payapiid"])}>
          </td>
          <td style="text-align:center; color:#060"><b><{:del0($vo["tkmoney"])}></b> 元</td>
          <td style="text-align:center; color:#666"><b><{:del0($vo["sxfmoney"])}></b> 元</td>
          <td style="text-align:center; color:#C00"><b><{:del0($vo["money"])}></b> 元</td>
          <td style="text-align:center;"><{$vo.bankname}></td>
          <td style="text-align:center;"><{$vo.bankzhiname}></td>
          <td style="text-align:center;"><{$vo.banknumber}></td>
          <td style="text-align:center;"><{$vo.bankfullname}></td>
          <td style="text-align:center;"><{$vo.sheng}></td>
          <td style="text-align:center; "><{$vo.shi}></td>
          <td style="text-align:center;"><{$vo.sqdatetime}></td>
          <td style="text-align:center;"><{$vo.cldatetime}></td>
          <td style="text-align:center;">
          <switch name="vo.status">
            <case value="0"><span style="color:#F00;">未处理</span></case>
            <case value="1"><span style="color:#06F;">处理中</span></case>
            <case value="2"><span style="color:#060;">已打款</span></case>
            <default />
          </switch>
          </td>
        </tr>
      </volist>
      <tr>
        <td colspan="17" style="text-align:center;"><div class="pagex"> <{$_page}></div></td>
      </tr>
    </tbody>
  </table>
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
