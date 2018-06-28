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
  <link href="/Public/Front/js/plugins/layui/css/layui.css" rel="stylesheet">
<script type="text/javascript" src="/Public/js/jquery.js" /></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js" /></script>
<script type="text/javascript" src="/Public/js/jquery.alerts.js" /></script>
<script type="text/javascript" src="/Public/Front/js/plugins/layui/layui.js" /></script>
<script type="text/javascript" src="/Public/js/tupian.js" /></script>
<script type="text/javascript" src="/Public/Admin/js/usercontrol.js" /></script>
  <script type="text/javascript" src="/Public/laydate/laydate.js" /></script>
<script type="text/javascript" src="/Public/js/zy.js" /></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
  <div class="col-sm-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>分时成功率</h5>
      </div>
      <div class="ibox-content">
    <blockquote class="layui-elem-quote">
  <form class="form-inline" role="form" action="" method="get" autocomplete="off" id="selectedform">
    <div class="form-group">
      <input type="text" class="form-control" style="width: 130px;" id="usernameidsearch" name="usernameidsearch" placeholder="商户号或用户名" value="<{$Think.get.usernameidsearch}>">
    </div>
    <div class="form-group">
	<input type="text" class="form-control" style="width: 130px;" id="sub_mchid" name="sub_mchid" placeholder="子商户号" value="<{$Think.get.sub_mchid
}>">
    </div>
    <!--<div class="form-group">
      <input type="text"  id="starttime" name="starttime"  class="form-control laydate-icon zy-searchstr" style="height: 30px;width: 120px;" onclick="laydate({ele:this,max: laydate.now(+1),istoday: true})" value="<{$Think.get.tjdate_ks}>" placeholder="开始日期">
      <input type="text"  id="endtime" name="endtime"  class="form-control laydate-icon zy-searchstr" style="height: 30px;width: 120px;" onclick="laydate({ele:this,max: laydate.now(+1),istoday: true})" value="<{$Think.get.tjdate_js}>" placeholder="结束日期">
    </div>-->

    <div class="form-group">
        <select name="sjd">
		<option>
		<option value="0">0~1
		<option value="1">1~2
		<option value="2">2~3
		<option value="3">3~4
		<option value="4">4~5
		<option value="5">5~6
		<option value="6">6~7
		<option value="7">7~8
		<option value="8">8~9
		<option value="9">9~10
		<option value="10">10~11
		<option value="11">11~12
		<option value="12">12~13
		<option value="13">13~14
		<option value="14">14~15
		<option value="15">15~16
		<option value="16">16~17
		<option value="17">17~18
		<option value="18">18~19
		<option value="19">19~20
		<option value="20">20~21
		<option value="21">21~22
		<option value="22">22~23
		<option value="23">23~24
	</select>
    </div>

    <button type="submit" class="layui-btn layui-btn-small"> <span class="glyphicon glyphicon-search"></span> 查询</button>
  </form>
    </blockquote>
<!--<blockquote class="layui-elem-quote layui-quote-nm" style="font-size:14px;padding;8px;">成功交易总金额：<span class="label label-info"><{$money}>元</span>  平台流量收入：<span class="label label-info"><{$traffic}>元</span> 总交易笔数：<span class="label label-info"><{$zsum}>笔</span> 成功笔数：<span class="label label-info"><{$num}>笔</span></blockquote>-->
<div class="table-responsive" style="=margin:0px auto; margin-top:10px;">

  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
        <td><strong>子商户</strong></td>
        <td><strong>所属商户</strong></td>
        <td><strong>提交总数</strong></td>
        <td><strong>成功数</strong></td>
        <td><strong>成功金额</strong></td>
      </tr>
    </thead>
    <tbody id="content">
      <volist name="res" id="vo">
        <tr>
          <td style="text-align:center;"><{$vo.subid}></td>
          <td style="text-align:center;"><{$vo.userid}></td>
          <td style="text-align:center;"><{$vo.sum}></td>
          <td style="text-align:center;"><{$vo.cgsum}></td>
          <td style="text-align:center;"><{$vo.cgamt}></td>
        </tr>
      </volist>
    </tbody>

  </table>
</div>
      </div>
    </div>
</div>
</div>
</div>
</body>
</html>
