<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title><{:C("WEB_TITLE")}></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="/Public/Front/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/Front/css/font-awesome.min.css" rel="stylesheet">
<link href="/Public/Front/css/style.css" rel="stylesheet">
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
        <h5>交易管理</h5>
      </div>
      <div class="ibox-content">
  <form class="form-inline" role="form" action="" method="get" autocomplete="off" id="orderform">
    <div class="form-group">
      <input type="text" class="form-control zy-searchstr" id="memberid" name="memberid" placeholder="请输入商户号" value="<{$Think.get.memberid}>">
    </div>
     <div class="form-group">
      <input type="text" class="form-control zy-searchstr" id="orderid" name="orderid" placeholder="请输入订单号" value="<{$Think.get.orderid}>">
    </div>
    <div class="form-group">
      <select class="form-control zy-searchstr" id="tongdao" name="tongdao">
        <option value="" style="font-weight:bold;">全部通道</option>
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
    <div class="form-group"s>
      <select class="form-control zy-searchstr" id="ddlx" name="ddlx">
        <option value="">订单类型</option>
        <option value="0">收款订单</option>
        <option value="1">充值订单</option>
      </select>
      <script type="text/javascript">
	  $("#ddlx").val('<{$Think.get.ddlx}>');
	  </script> 
    </div>
    <div class="form-group">
      <input type="text"  id="tjdateks" name="tjdateks"  class="form-control laydate-icon zy-searchstr" style="height: 30px;" onclick="laydate({ele:this,min: laydate.now(-30), max: laydate.now(+1),istime: true,
      istoday: true,format: 'YYYY-MM-DD hh:mm:ss'})" value="<{$Think.get.tjdate_ks}>" placeholder="提交起始日">
     <input type="text"  id="tjdatejs" name="tjdatejs"  class="form-control laydate-icon zy-searchstr" style="height: 30px;" onclick="laydate({ele:this,min: laydate.now(-30), max: laydate.now(+1),istime: true,
     istoday: true,format: 'YYYY-MM-DD hh:mm:ss'})" value="<{$Think.get.tjdate_js}>" placeholder="提交截止日">
    </div>
    <div class="form-group">
      <input type="text"  id="cgdateks" name="cgdateks"  class="form-control laydate-icon zy-searchstr" style="height: 30px;" onclick="laydate({ele:this,min: laydate.now(-30), max: laydate.now(+1),istime: true,
      istoday: true,format: 'YYYY-MM-DD hh:mm:ss'})" value="<{$Think.get.cgdate_ks}>" placeholder="成功起始日">
     <input type="text"  id="cgdatejs" name="cgdatejs"  class="form-control laydate-icon zy-searchstr" onclick="laydate({ele:this,min: laydate.now(-30), max: laydate.now(+1),istime: true,
     istoday: true,format: 'YYYY-MM-DD hh:mm:ss'})" style="height: 30px;" value="<{$Think.get.cgdate_js}>"  placeholder="成功截止日">
    </div>
    <div class="form-group">
      <button type="submit" class="layui-btn layui-btn-small" id="ptshsearch"> <span class="glyphicon glyphicon-search"></span> 搜索 </button>
      <a href="javascript:;" id="export" class="layui-btn layui-btn-danger layui-btn-small"><span class="glyphicon glyphicon-export"></span> 导出数据</a>
    </div>
  </form>

    <blockquote class="layui-elem-quote layui-quote-nm" style="font-size:14px;padding;8px;">成功交易总金额：<span class="label label-info"><{$stamount}>元</span> 平台手续费收入：<span class="label label-info"><{$strate}>元</span> 平台流量扣除：<span class="label label-info"><{$traffic}>元</span> 支付金额：<span class="label label-info"><{$strealmoney}>元</span></blockquote>
    <div class="table-responsive">
  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
      	<th>&nbsp;</th>
        <th>订单类型</th>
        <th>订单号</th>
        <th>商户编号</th>
        <th>交易金额</th>
        <th>手续费</th>
        <th>扣除流量</th>
        <th>实际金额</th>
        <th>提交时间</th>
        <th>成功时间</th>
        <th>通道</th>
        <th>银行</th>
        <th>来源地址</th>
        <th>状态</th>
        <th>查看</th>
      </tr>
    </thead>
    <tbody>
      <volist name="list" id="vo">
        <tr>
          <td style="text-align: center; vertical-align: middle;"><{$key+1}></td>
          <td style="text-align: center; vertical-align: middle;">
            <if condition="$vo.ddlx == 1">
            <span style="color:#060">充值</span>
            <else />
            收款
            </if>
          </td>
          <td style="text-align:center; color:#090;"><{$vo.pay_orderid}>
          	<if condition="$vo.del == 1">
          		<span style="color: #f00;">×</span>
          	</if>
          	
          </td>
          <td style="text-align:center;"><{$vo.pay_memberid}></td>
          <td style="text-align:center; color:#060"><{$vo.pay_amount}></td>
          <td style="text-align:center; color:#666"><{$vo.pay_poundage}></td>
          <td style="text-align:center; color:#666"><{$vo.pay_traffic}></td>
          <td style="text-align:center; color:#C00"><{$vo.pay_actualamount}></td>
          <td style="text-align:center;"><{$vo.pay_applydate|date='Y-m-d H:i:s',###}></td>
          <td style="text-align:center;"><if condition="$vo[pay_successdate]"><{$vo.pay_successdate|date='Y-m-d H:i:s',###}><else/> --- </if></td>
          <td style="text-align:center;"><{$vo.pay_zh_tongdao}></td>
          <td style="text-align:center;"><{$vo.pay_bankname}></td>
          <td style="text-align:center;"><a href="<{$vo.pay_tjurl}>" target="_blank" title="<{$vo.pay_tjurl}>">来源</a></td>
          <td style="text-align:center; color:#369"><{$vo['pay_status']|status=###}></td>
          <td style="text-align:center;"><a href="javascript:edit('<{$vo.id}>')">查看</a></td>
        </tr>
      </volist>
      <tr>
        <td colspan="15" style="text-align:center;"><div class="pagex"> <{$_page}></div></td>
      </tr>
    </tbody>
  </table>
</div>
  </div></div>
</div>
</div>
</div>
<include file="dealrecordlModal" />
<script>
    $('#export').on('click',function(){
        $('#orderform').attr('action',"<{:U('Admin/Dealmanages/exportorder')}>");
        $('#orderform').submit();
    });
</script>
<{:tongji(0)}>
</body>
</html>
