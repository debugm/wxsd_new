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
<link href="/Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
<link href="/Public/css/jquery.alerts.css" rel="stylesheet">
  <link href="/Public/Front/js/plugins/layui/css/layui.css" rel="stylesheet">
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/Public/laydate/laydate.js"></script>
<script type="text/javascript" src="/Public/Admin/js/dealrecord.js"></script>
<script type="text/javascript" src="/Public/js/zy.js"></script>
  <style>
    .form-inline .form-group { margin-bottom: 5px;}
    .laydate-icon, .laydate-icon-default, .laydate-icon-danlan, .laydate-icon-dahong, .laydate-icon-molv {padding-right:0px;}
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {padding:4px 2px;}
  </style>
</head>
 <body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
  <div class="col-sm-12">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>资金变动管理</h5>
          </div>
          <div class="ibox-content">
<div style="margin:0px auto;">
  <form class="form-inline" role="form" action="" method="get" autocomplete="off">
    <div class="form-group">
      <input type="text" class="form-control zy-searchstr" id="memberid" style="width: 128px;" name="memberid" placeholder="商户号或用户名" value="<{$Think.get.memberid}>">
    </div>
     <div class="form-group">
      <input type="text" class="form-control zy-searchstr" id="orderid" name="orderid" placeholder="订单号" value="<{$Think.get.orderid}>">
    </div>
    <div class="form-group">
      <select class="form-control zy-searchstr" id="tongdao" name="tongdao">
        <option value="">全部通道</option>
        <volist name="tongdaolist" id="vo">
        	<option value="<{$vo.en_payname}>"><{$vo.zh_payname}></option>
        </volist>
      </select>
      <script type="text/javascript">
	  $("#tongdao").val('<{$Think.get.tongdao}>');
	  </script> 
    </div>
   <div class="form-group">
      <select class="form-control zy-searchstr" id="bank" name="bank">
        <option value="">全部类型</option>
        <option value="1">付款</option>
        <option value="3">手动增加</option>
        <option value="4">手动减少</option>
        <option value="6">结算</option>
        <option value="10">委托结算</option>
        <option value="7">冻结</option>
        <option value="8">解冻</option>
        <option value="9">提成</option>
      </select>
      <script type="text/javascript">
	   $("#bank").val('<{$Think.get.bank}>');
	  </script> 
    </div>
  	<div class="form-group">

    </div>
    <div class="form-group">
      <input type="text"  id="tjdateks" name="tjdateks"  class="form-control laydate-icon zy-searchstr" onclick="laydate({ele:this,min: laydate.now(-30), max: laydate.now(+1),istime: true,
      istoday: true,format: 'YYYY-MM-DD hh:mm:ss'})" style="height: 30px;" placeholder="起始时间" value="<{$Think.get.tjdate_ks}>">
    </div>
    <div class="form-group">
     <input type="text"  id="tjdatejs" name="tjdatejs" placeholder="截止时间" class="form-control laydate-icon zy-searchstr" onclick="laydate({ele:this,min: laydate.now(-30), max: laydate.now(+1),istime: true,
     istoday: true,format: 'YYYY-MM-DD hh:mm:ss'})" style="height: 30px;" value="<{$Think.get.tjdate_js}>">
    </div>
   <div class="form-group">
     <button type="submit" class="layui-btn layui-btn-small" id="ptshsearch"> <span class="glyphicon glyphicon-search"></span> <strong>搜索</strong> </button>
     <button type="button" class="layui-btn layui-btn-danger layui-btn-small" id="zjbdjldownload" url="<{:U("Dealmanages/exceldownload")}>"> <span class="glyphicon glyphicon-export"></span> 导出数据 </button>
   </div>

  </form>
</div>

<div class="table-responsive" style="margin:0px auto; margin-top:10px;">
  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
        <td><strong>订单号</strong></td>
        <td><strong>用户名</strong></td>
        <td><strong>类型</strong></td>
        <td><strong>提成用户名</strong></td>
        <td><strong>提成级别</strong></td>
        <td><strong>原金额</strong></td>
        <td><strong>变动金额</strong></td>
        <td><strong>变动后金额</strong></td>
        <td><strong>变动时间</strong></td>
        <td><strong>通道</strong></td>
        <td><strong>备注</strong></td>
      </tr>
    </thead>
    <tbody>
      <volist name="list" id="vo">
        <tr>
          <td style="text-align:center;"><{$vo.transid}></td>
          <td style="text-align:center; color:#090;">
          <{:sjusername($vo["userid"],1)}>
          </td>
          <td style="text-align:center;">
          <switch name="vo.lx">
          		<case value="1">付款</case>
                <case value="3">手动增加</case>
                <case value="4">手动减少</case>
                <case value="6">结算</case>
                <case value="10">委托结算</case>
                <case value="7">冻结</case>
                <case value="8">解冻</case>
                <case value="9">提成</case>
                <default />未知
          </switch>
          </td>
          <td style="text-align:center; color:#060">
          <{:sjusername($vo["tcuserid"],1)}>
          </td>
          <td style="text-align:center; color:#666"><{$vo.tcdengji}>&nbsp;</td>
          <td style="text-align:center; color:#030"><{$vo.ymoney}></td>
          <td style="text-align:center;">
          
          <if condition="$vo.money lt 0">
          <span style="color:#F00">
          <else />
          <span style="color:#030">
          </if>
          <{$vo.money}>
          </span>
          </td>
          <td style="text-align:center; font-weight:bold; color:#060;"><{$vo.gmoney}></td>
          <td style="text-align:center;"><{$vo.datetime}></td>
          <td style="text-align:center;"><{:huoqutongdaoname($vo["tongdao"])}></td>
          <td style="text-align:center;">
          <if condition="$vo.lx == 1 or $vo.lx == 9">
          <{:huoquddlx($vo.transid)}>
          <else />
          <{$vo['contentstr']}>
          </if>
          
          </td
        ></tr>
      </volist>
      <tr>
        <td colspan="14" style="text-align:center;"><div class="pagex"> <{$_page}></div></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</div></div>
</div>
</div>
<include file="dealrecordlModal" />
<{:tongji(0)}>
</body>
</html>
