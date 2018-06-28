<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<{$siteurl}>Public/Front/css/bootstrap.min.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/font-awesome.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/style.css" rel="stylesheet">
    <link href="/Public/Front/js/plugins/layui/css/layui.css" rel="stylesheet">
 <link href="<{$siteurl}>Public/css/jquery.alerts.css" rel="stylesheet">
 <script src="<{$siteurl}>Public/js/jquery.js"></script>
<script src="<{$siteurl}>Public/js/bootstrap.min.js"></script>
 <script src="<{$siteurl}>Public/js/jquery.alerts.js"></script>
<script src="<{$siteurl}>Public/laydate/laydate.js"></script>
<script src="<{$siteurl}>Public/js/zy.js"></script>
    <style>
        .form-inline .form-group { margin-bottom: 5px;}
        .laydate-icon, .laydate-icon-default, .laydate-icon-danlan, .laydate-icon-dahong, .laydate-icon-molv {padding-right:0px;}
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {padding:4px 2px;}
    </style>
</head>
 <body class="gray-bg">
<div class="wrapper wrapper-content">
  <div class="row animated fadeInRight">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>交易记录</h5>
            </div>
            <div class="ibox-content">
                <div class="margin-top:10px;">
 <form class="form-inline" role="form" method="get" autocomplete="off">
     <div class="form-group">
      <input type="text" style="width:150px;" class="form-control zy-searchstr" id="orderid" name="orderid" placeholder="请输入订单号" value="<{$Think.get.orderid}>">
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
        <option value="">全部银行</option>
        <volist name="banklist" id="vo">
        	<option value="<{$vo.bankname}>"><{$vo.bankname}></option>
        </volist>
      </select>
      <script type="text/javascript">
	   $("#bank").val('<{$Think.get.bank}>');
	  </script>
    </div>
    <div class="form-group">
      <select class="form-control zy-searchstr" id="status" name="status">
        <option value="">全部状态</option>
        <option value="0">未处理</option>
        <option value="1">成功，未返回</option>
        <option value="2">成功，已返回</option>
      </select>
      <script type="text/javascript">
	  $("#status").val('<{$Think.get.status}>');
	  </script>
    </div>
    <div class="form-group">
      <select class="form-control zy-searchstr" id="ddlx" name="ddlx">
        <option value="">所有订单类型</option>
        <option value="0">收款订单</option>
        <option value="1">充值订单</option>
      </select>
      <script type="text/javascript">
	  $("#ddlx").val('<{$Think.get.ddlx}>');
	  </script>
    </div>

    <div class="form-group">
      <input type="text"  id="tjdate_ks" name="tjdate_ks" placeholder="提交起始日"  class="form-control laydate-icon zy-searchstr" onclick="laydate()" style="height: 30px; width:120px;" value="<{$Think.get.tjdate_ks}>">
    </div>
    <div class="form-group">
     <input type="text"  id="tjdate_js" name="tjdate_js" placeholder="提交截止日"  class="form-control laydate-icon zy-searchstr" onclick="laydate()" style="height: 30px; width:120px;" value="<{$Think.get.tjdate_js}>">
    </div>
    <div class="form-group">
      <input type="text"  id="cgdate_ks" name="cgdate_ks" placeholder="成功起始日" class="form-control laydate-icon zy-searchstr" onclick="laydate()" style="height: 30px; width:120px;" value="<{$Think.get.cgdate_ks}>">
    </div>
    <div class="form-group">
     <input type="text"  id="cgdate_js" name="cgdate_js" placeholder="成功截止日" class="form-control laydate-icon zy-searchstr" onclick="laydate()" style="height: 30px; width:120px;" value="<{$Think.get.cgdate_js}>">
    </div>
      <div class="form-group">
        <button type="submit" class="layui-btn layui-btn-small"> <span class="glyphicon glyphicon-search"></span>搜索</button>
      </div>
  </form>
</div>
<div class="table-responsive" style="margin:0px auto; margin-top:10px;">
  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
        <td><strong>订单类型</strong></td>
        <td><strong>订单号</strong></td>
        <td><strong>商户编号</strong></td>
        <td><strong>交易金额</strong></td>
        <td><strong>手续费</strong></td>
        <td><strong>扣除流量</strong></td>
        <td><strong>实际金额</strong></td>
        <td><strong>提交时间</strong></td>
        <td><strong>成功时间</strong></td>
        <td><strong>通道</strong></td>
        <td><strong>银行</strong></td>
        <td><strong>来源地址</strong></td>
        <td><strong>状态</strong></td>
        <td><strong>查看</strong></td>
      </tr>
    </thead>
    <tbody style="background-color:#FFF">
      <volist name="list" id="vo">
        <tr>
         <td style="text-align: center; vertical-align: middle;">
            <if condition="$vo.ddlx == 1">
            <span style="color:#060">充值</span>
            <else />
            收款
            </if>
          </td>
          <td style="text-align:center; color:#090;"><{$vo.pay_orderid}></td>
          <td style="text-align:center;"><{$vo.pay_memberid}></td>
          <td style="text-align:center; color:#060"><{$vo.pay_amount}></td>
          <td style="text-align:center; color:#666"><{$vo.pay_poundage}></td>
          <td style="text-align:center; color:#666"><{$vo.pay_traffic}></td>
          <td style="text-align:center; color:#C00"><{$vo.pay_actualamount}></td>
          <td style="text-align:center;"><{$vo.pay_applydate|date='Y-m-d H:i:s',###}></td><td style="text-align:center;"><if condition="$vo[pay_successdate]"><{$vo.pay_successdate|date='Y-m-d H:i:s',###}><else/> --- </if></td>
          <td style="text-align:center;"><{$vo.pay_zh_tongdao}></td>
          <td style="text-align:center;"><{$vo.pay_bankname}></td>
          <td style="text-align:center;"><a href="<{$vo.pay_tjurl}>" target="_blank" title="<{$vo.pay_tjurl}>">来源</a></td>
          <td style="text-align:center; color:#369"><{$vo['pay_status']|status=###}></td>
          <td style="text-align:center;">
          	<div class="btn-group">
  <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
    操作 <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
     <li><a href="javascript:edit('<{$vo.id}>')">详细信息</a></li>
    <li class="divider"></li>
    <if condition="$vo.pay_status == 0">
    <li><a href="javascript:deldel('<{$vo.id}>','<{:U("Dealmanages/deldel")}>')">删除</a></li>
    <li class="divider"></li>
    </if>
  </ul>
</div>
     </td>
        </tr>
      </volist>
      <tr>
        <td colspan="14" style="text-align:center;"><div class="pagex"> <{$_page}></div></td>
      </tr>
    </tbody>
  </table>
</div>
<include file="dealrecordlModal" />
</div>
</div>
</div>
</div>
</div>
<script src="<{$siteurl}>Public/Front/js/user.js"></script>
<script src="<{$siteurl}>Public/Front/js/content.js"></script>
<{:tongji(0)}>
</body>
</html>
