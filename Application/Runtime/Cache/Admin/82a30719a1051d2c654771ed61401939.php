<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title><?php echo C("WEB_TITLE");?></title>
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
      <input type="text" class="form-control zy-searchstr" id="memberid" name="memberid" placeholder="请输入商户号" value="<?php echo ($_GET['memberid']); ?>">
    </div>
     <div class="form-group">
      <input type="text" class="form-control zy-searchstr" id="orderid" name="orderid" placeholder="请输入订单号" value="<?php echo ($_GET['orderid']); ?>">
    </div>
    <div class="form-group">
      <select class="form-control zy-searchstr" id="tongdao" name="tongdao">
        <option value="" style="font-weight:bold;">全部通道</option>
        <?php if(is_array($tongdaolist)): $i = 0; $__LIST__ = $tongdaolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["en_payname"]); ?>"><?php echo ($vo["zh_payname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
      <script type="text/javascript">
	  $("#tongdao").val('<?php echo ($_GET['tongdao']); ?>');
	  </script> 
    </div>
    <div class="form-group">
      <select class="form-control zy-searchstr" id="bank" name="bank">
        <option value="">全部银行</option>
        <?php if(is_array($banklist)): $i = 0; $__LIST__ = $banklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["bankname"]); ?>"><?php echo ($vo["bankname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
      <script type="text/javascript">
	   $("#bank").val('<?php echo ($_GET['bank']); ?>');
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
	  $("#status").val('<?php echo ($_GET['status']); ?>');
	  </script> 
    </div>
    <div class="form-group"s>
      <select class="form-control zy-searchstr" id="ddlx" name="ddlx">
        <option value="">订单类型</option>
        <option value="0">收款订单</option>
        <option value="1">充值订单</option>
      </select>
      <script type="text/javascript">
	  $("#ddlx").val('<?php echo ($_GET['ddlx']); ?>');
	  </script> 
    </div>
    <div class="form-group">
      <input type="text"  id="tjdateks" name="tjdateks"  class="form-control laydate-icon zy-searchstr" style="height: 30px;" onclick="laydate({ele:this,min: laydate.now(-30), max: laydate.now(+1),istime: true,
      istoday: true,format: 'YYYY-MM-DD hh:mm:ss'})" value="<?php echo ($_GET['tjdate_ks']); ?>" placeholder="提交起始日">
     <input type="text"  id="tjdatejs" name="tjdatejs"  class="form-control laydate-icon zy-searchstr" style="height: 30px;" onclick="laydate({ele:this,min: laydate.now(-30), max: laydate.now(+1),istime: true,
     istoday: true,format: 'YYYY-MM-DD hh:mm:ss'})" value="<?php echo ($_GET['tjdate_js']); ?>" placeholder="提交截止日">
    </div>
    <div class="form-group">
      <input type="text"  id="cgdateks" name="cgdateks"  class="form-control laydate-icon zy-searchstr" style="height: 30px;" onclick="laydate({ele:this,min: laydate.now(-30), max: laydate.now(+1),istime: true,
      istoday: true,format: 'YYYY-MM-DD hh:mm:ss'})" value="<?php echo ($_GET['cgdate_ks']); ?>" placeholder="成功起始日">
     <input type="text"  id="cgdatejs" name="cgdatejs"  class="form-control laydate-icon zy-searchstr" onclick="laydate({ele:this,min: laydate.now(-30), max: laydate.now(+1),istime: true,
     istoday: true,format: 'YYYY-MM-DD hh:mm:ss'})" style="height: 30px;" value="<?php echo ($_GET['cgdate_js']); ?>"  placeholder="成功截止日">
    </div>
    <div class="form-group">
      <button type="submit" class="layui-btn layui-btn-small" id="ptshsearch"> <span class="glyphicon glyphicon-search"></span> 搜索 </button>
      <a href="javascript:;" id="export" class="layui-btn layui-btn-danger layui-btn-small"><span class="glyphicon glyphicon-export"></span> 导出数据</a>
    </div>
  </form>

    <blockquote class="layui-elem-quote layui-quote-nm" style="font-size:14px;padding;8px;">成功交易总金额：<span class="label label-info"><?php echo ($stamount); ?>元</span> 平台手续费收入：<span class="label label-info"><?php echo ($strate); ?>元</span> 平台流量扣除：<span class="label label-info"><?php echo ($traffic); ?>元</span> 支付金额：<span class="label label-info"><?php echo ($strealmoney); ?>元</span></blockquote>
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
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td style="text-align: center; vertical-align: middle;"><?php echo ($key+1); ?></td>
          <td style="text-align: center; vertical-align: middle;">
            <?php if($vo["ddlx"] == 1): ?><span style="color:#060">充值</span>
            <?php else: ?>
            收款<?php endif; ?>
          </td>
          <td style="text-align:center; color:#090;"><?php echo ($vo["pay_orderid"]); ?>
          	<?php if($vo["del"] == 1): ?><span style="color: #f00;">×</span><?php endif; ?>
          	
          </td>
          <td style="text-align:center;"><?php echo ($vo["pay_memberid"]); ?></td>
          <td style="text-align:center; color:#060"><?php echo ($vo["pay_amount"]); ?></td>
          <td style="text-align:center; color:#666"><?php echo ($vo["pay_poundage"]); ?></td>
          <td style="text-align:center; color:#666"><?php echo ($vo["pay_traffic"]); ?></td>
          <td style="text-align:center; color:#C00"><?php echo ($vo["pay_actualamount"]); ?></td>
          <td style="text-align:center;"><?php echo (date('Y-m-d H:i:s',$vo["pay_applydate"])); ?></td>
          <td style="text-align:center;"><?php if($vo[pay_successdate]): echo (date('Y-m-d H:i:s',$vo["pay_successdate"])); else: ?> ---<?php endif; ?></td>
          <td style="text-align:center;"><?php echo ($vo["pay_zh_tongdao"]); ?></td>
          <td style="text-align:center;"><?php echo ($vo["pay_bankname"]); ?></td>
          <td style="text-align:center;"><a href="<?php echo ($vo["pay_tjurl"]); ?>" target="_blank" title="<?php echo ($vo["pay_tjurl"]); ?>">来源</a></td>
          <td style="text-align:center; color:#369"><?php echo (status($vo['pay_status'])); ?></td>
          <td style="text-align:center;"><a href="javascript:edit('<?php echo ($vo["id"]); ?>')">查看</a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <tr>
        <td colspan="15" style="text-align:center;"><div class="pagex"> <?php echo ($_page); ?></div></td>
      </tr>
    </tbody>
  </table>
</div>
  </div></div>
</div>
</div>
</div>
<!-- Modal -->
<style>
  .table > thead > tr > th,
  .table > tbody > tr > th,
  .table > tfoot > tr > th,
  .table > thead > tr > td,
  .table > tbody > tr > td,
  .table > tfoot > tr > td { text-align: left;}
</style>
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-describedby="tscontent" data-backdrop="static" ajaxurl="<?php echo U("Dealmanages/dealload");?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close modalgb" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"> <span>订单号：</span> <span id="orderidModal"></span> </h4>
      </div>
      <div class="modal-body" id="dealcontent">
        <!--------------------------------------------------------------------------------------------------->
        <table class="table table-condensed">
          <tr>
            <td>商户编号：<span></span></td>
          </tr>
          <tr>
            <td>商户用户名：<span></span></td>
          </tr>
          <tr>
            <td>商户姓名：<span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
           <tr>
            <td>订单号：<span style="color:#090;"></span></td>
          </tr>
          <tr>
            <td>交易金额：<span style="color:#060; font-weight:bold;"></span> 元</td>
          </tr>
          <tr>
            <td>手续费：<span style="color:#666; font-weight:bold;"></span> 元</td>
          </tr>
          <tr>
            <td>实际金额：<span style="color:#C00; font-weight:bold;"></span> 元</td>
          </tr>
          <tr>
            <td>提交时间：<span style="color:#F00;"></span></td>
          </tr>
          <tr>
            <td>成功时间：<span style="color:#F00;"></span></td>
          </tr>
           <tr>
            <td>交易通道：<span></span></td>
          </tr>
           <tr>
            <td>实际通道：<span></span></td>
          </tr>
           <tr>
            <td>交易银行：<span></span></td>
          </tr>
          <tr>
            <td>提交地址：<span></span></td>
          </tr>
          <tr>
            <td>页面通知返回地址：<span></span></td>
          </tr>
           <tr>
            <td>服务器点对点返回地址：<span></span></td>
          </tr>
           <tr>
            <td>状态：<span>成功，未返回</span><span></span></td>
          </tr>
          <tr>
            <td></td>
          </tr>
        </table>
        <!---------------------------------------------------------------------------------------------------> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default modalgb" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#export').on('click',function(){
        $('#orderform').attr('action',"<?php echo U('Admin/Dealmanages/exportorder');?>");
        $('#orderform').submit();
    });
</script>
<?php echo tongji(0);?>
</body>
</html>