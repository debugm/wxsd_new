<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<{$siteurl}>Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/font-awesome.css?v=4.4.0" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
<link href="<{$siteurl}>Public/css/jquery.alerts.css" rel="stylesheet"/>
  <script src="<{$siteurl}>Public/Front/js/jquery.min.js"></script>
</head>
 
<body class="gray-bg">
<div class="wrapper wrapper-content">
  <div class="row animated fadeInRight">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>资金变动记录</h5>
        </div>
        <div class="ibox-content">
  <form class="form-inline" role="form" method="get" autocomplete="off" id="form">
     <div class="form-group">
      <input type="text" style="width:180px;" class="form-control zy-searchstr" id="orderid" name="orderid" placeholder="请输入订单号" value="<{$Think.get.orderid}>">
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
        <option value="">全部类型</option>
        <option value="1">付款</option>
        <option value="3">手动增加</option>
        <option value="4">手动减少</option>
        <option value="6">结算</option>
        <option value="7">冻结</option>
        <option value="8">解冻</option>
        <option value="9">提成</option>
      </select>
      <script type="text/javascript">
	   $("#bank").val('<{$Think.get.bank}>');
	  </script> 
    </div>
   
   	<div class="form-group">
     变动时间：
    </div>
    <div class="form-group">
      <input type="text"  id="tjdate_ks" name="tjdate_ks"  class="form-control laydate-icon zy-searchstr" onclick="laydate()" style="height: 30px; width:120px;" value="<{$Think.get.tjdate_ks}>">
    </div>
    <div class="form-group">
     至
    </div>
    <div class="form-group">
     <input type="text"  id="tjdate_js" name="tjdate_js"  class="form-control laydate-icon zy-searchstr" onclick="laydate()" style="height: 30px; width:120px;" value="<{$Think.get.tjdate_js}>">
    </div>
    <div class="form-group">
    <button type="button" class="btn btn-primary zy-searchbutton" id="ptshsearch"> <span class="glyphicon glyphicon-search"></span> 搜索 </button>
    </div>
    
  </form>

<div class="table-responsive" style="margin-top:10px;">
  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
        <td><strong>用户名</strong></td>
        <td><strong>类型</strong></td>
        <td><strong>提成用户名</strong></td>
        <td><strong>提成级别</strong></td>
        <td><strong>原金额</strong></td>
        <td><strong>变动金额</strong></td>
        <td><strong>变动后金额</strong></td>
        <td><strong>变动时间</strong></td>
        <td><strong>通道</strong></td>
        <td><strong>订单号</strong></td>
        <td><strong>备注</strong></td>
      </tr>
    </thead>
    <tbody style="background-color: #fff;">
      <volist name="list" id="vo">
        <tr>
          <td style="text-align:center; color:#090;">
          <{:sjusername($vo["userid"],1)}>
          </td>
          <td style="text-align:center;">
          <switch name="vo.lx">
          		<case value="1">付款</case>
                <case value="3">手动增加</case>
                <case value="4">手动减少</case>
                <case value="6">结算</case>
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
          <td style="text-align:center;"><{$vo.transid}></td>
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
<include file="dealrecordlModal" />
</div>
</div>
    </div>
</div>
</div>
<!-- 全局js -->
<script src="<{$siteurl}>Public/Front/js/bootstrap.min.js"></script>
<script src="<{$siteurl}>Public/js/jquery.alerts.js"></script>
<script src="<{$siteurl}>Public/laydate/laydate.js"></script>
<script src="<{$siteurl}>Public/Admin/js/dealrecord.js"></script>
<script src="<{$siteurl}>Public/js/zy.js"></script>
<{:tongji(0)}>
</body>
</html>
