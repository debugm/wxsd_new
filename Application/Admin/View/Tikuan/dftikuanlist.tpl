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
<js href="/Public/laydate/laydate.js" />
<js href="/Public/Admin/js/tklist.js" />
<js href="/Public/js/zy.js" />

</head>

<body>
<ol class="breadcrumb">
  <li class="active">管理后台</li>
  <li class="active">提款管理</li>
  <li class="active">委托提款记录</li>
</ol>
<div style="width:90%; margin:0px auto;">
  <form class="form-inline" role="form">
   <div class="form-group" style="display:none;">
     <div class="btn-group">
  <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" style="height:35px;">
    导出EXCEL <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
        <li><a href="#">导出【<span style="color:#003;">默认</span>】模板</a></li>
   		<li class="divider"></li>
   <volist name="tongdaolist" id="vo">
    	<li><a href="#">导出【<span style="color:#003;"><{$vo.zh_payname}></span>】模板</a></li>
   		<li class="divider"></li>
   </volist>
  </ul>
</div>
   </div>
    <div class="form-group">
      <input type="text" style="width:200px;" class="form-control zy-searchstr" id="memberid" name="memberid" placeholder="请输入商户号" value="<{$Think.get.memberid}>">
    </div>
    
    <div class="form-group" style="margin-left:20px;">
      <select class="form-control zy-searchstr" id="tongdao" name="tongdao">
        <option value="" style="font-weight:bold;">全部通道</option>
        <volist name="tongdaolist" id="vo">
        	<option value="<{$vo.id}>"><{$vo.zh_payname}></option>
        </volist>
      </select>
      <script type="text/javascript">
	  $("#tongdao").val('<{$Think.get.tongdao}>');
	  </script> 
    </div>
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
     <div class="form-group" style="margin-left:20px; display:none;">
      <select class="form-control zy-searchstr" id="T" name="T">
       <option value="">全部类型</option>
        <option value="0">T + 0</option>
        <option value="1">T + 1</option>
      </select>
      <script type="text/javascript">
	   $("#T").val('<{$Think.get.T}>');
	  </script> 
    </div>
    <div class="form-group" style="margin-left:20px; display:none;">
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
    
  </form>
</div>

<div style="width:90%; margin:0px auto; margin-top: 20px;">
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
    <button type="button" class="btn btn-default zy-searchbutton" style="color:#01a9ef; margin-left:20px;" id="ptshsearch"> <span class="glyphicon glyphicon-search"></span> <strong>搜索</strong> </button>&nbsp;&nbsp;
  </form>
</div>

<div class="table-responsive" style="width:90%; margin:0px auto; margin-top:10px;">
  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
        <td style="width:50px;"><strong><input type="checkbox" id="checkAll"></strong></td>
        <td><strong>类型</strong></td>
        <td><strong>通道</strong></td>
        <td><strong>商户编号</strong></td>
        <td><strong>结算金额</strong></td>
        <td><strong>手续费</strong></td>
        <td><strong>到账金额</strong></td>
        <td><strong>银行名称</strong></td>
        <td><strong>分行名称</strong></td>
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
    <tbody>
      <volist name="list" id="vo">
        <tr>
          <td style="text-align:center; color:#090;">
          	<input type="checkbox" name="subBox" value="<{$vo.id}>">
          </td>
          <td style="text-align: center; vertical-align: middle; font-weight:bold;">T+<{$vo.t}></td>
          <td style="text-align: center; ">
          <{:huoqutongdaoname($vo["payapiid"])}>
          </td>
          <td style="text-align:center;"><{$vo["userid"]+10000}></td>
          <td style="text-align:center; color:#060"><b><{:del0($vo["tkmoney"])}></b> 元</td>
          <td style="text-align:center; color:#666"><b><{:del0($vo["sxfmoney"])}></b> 元</td>
          <td style="text-align:center; color:#C00"><b><{:del0($vo["money"])}></b> 元</td>
          <td style="text-align:center;"><{$vo.bankname}></td>
          <td style="text-align:center;"><{$vo.bankfenname}></td>
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
        <td colspan="18" style="text-align:center;"><div class="pagex"> <{$_page}></div></td>
      </tr>
    </tbody>
  </table>
</div>
<include file="dealrecordlModal" />
<{:tongji(0)}>
</body>
</html>
