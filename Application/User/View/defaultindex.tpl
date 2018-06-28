<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>首页</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<{$siteurl}>Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/font-awesome.css?v=4.4.0" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
<div class="row">
  <div class="col-sm-12">
    <blockquote class="text-default" style="font-size:14px">
      <li> 用户名：<strong style="color:#036"><{$Think.session.username}></strong>&nbsp;&nbsp;&nbsp;&nbsp;商户ID：<strong style="color:#036"><{$Think.session.shid}></strong> 【
        <if condition="$rzstatus == 0"> <span style="color:#999"><a href="<{:U('User/Account/verifyinfo')}>">审核账号</a> </span>
          <else />
          <span style="color:#F30">认证用户</span> </if>
        】 </li>
      <if condition="$rzstatus">
        <li>API：http://mer.mevip.cn/Pay_Index.html </li>
        <li>APIKEY：<{$md5key}></li>
      </if>
    </blockquote>
  </div>
  <div class="col-sm-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>全部金额</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins"><{$SumMoney}></h1>
        <div class="stat-percent font-bold text-success">元 </div>
        <small>全部收入</small> </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>冻结</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins"><{$Sumfreezemoney}></h1>
        <div class="stat-percent font-bold text-info">元 </div>
        <small>冻结的资金</small> </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>钱包</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins"><{$wallet}></h1>
        <div class="stat-percent font-bold text-navy">元</div>
        <small>系统钱包</small> </div>
    </div>
  </div>
  <div class="col-md-12">
  <div class="row">
    <volist name="apimoneylist" id="moneylist">
      <div class="col-sm-2">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>通道：<strong class="text-danger"><{$moneylist.zh_payname}></strong></h5>
          </div>
          <div class="ibox-content">
            <h1 class="no-margins"><{$moneylist.money}></h1>
            <div class="stat-percent font-bold text-navy">元 </div>
            <small>渠道金额</small> </div>
        </div>
      </div>
    </volist>
  </div>
  </div>
</div>
 
<div class="row">
  <div class="col-sm-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>系统公告</h5>
      </div>
      <div class="ibox-content no-padding">
        <div class="panel-body">
          <div class="panel-group" id="version">
            <volist name="gglist" id="vo">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h5 class="panel-title">
                    <a data-toggle="collapse" data-parent="#version" href="#a<{$vo.id}>" aria-expanded="false" class="collapsed"><{$vo['id']|browserecord}> <{$vo.title}></a><code class="pull-right text-navy"><{$vo.datetime}></code>
                  </h5>
                </div>
                <div id="a<{$vo.id}>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                  <div class="panel-body">
                    <p><{$vo.content|htmlspecialchars_decode}></p>
                  </div>
                </div>
              </div>
            </volist>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>最近交易记录</h5>
            <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
          </div>
          <div class="ibox-content">
            <table class="table table-hover no-margins">
              <thead>
                <tr>
                  <th>时间</th>
                  <th>通道</th>
                  <th>明细</th>
                  <th>金额</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                <volist name="zjbdlist" id="vo">
                  <tr>
                    <td ><{$vo.datetime}></td>
                    <td><{$vo["tongdao"]|huoqutongdaoname=###}></td>
                    <td ><{$vo["lx"]|zjbdlx=###,$vo["orderid"]}></td>
                    <td ><{$vo["money"]|bdje=###}> </td>
                    <td><div class="btn-group">
                        <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown"> 详情 <span class="caret"></span> </button>
                        <ul class="dropdown-menu">
                          <li><a href="javascript:edit('<{$vo.orderid}>')">详细信息</a></li>
                          <li class="divider"></li>
                        </ul>
                      </div></td>
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
</div>
<include file="dealrecordlModal" />
<!-- 全局js -->
<script src="<{$siteurl}>Public/Front/js/jquery.min.js?v=2.1.4"></script>
<script src="<{$siteurl}>Public/Front/js/bootstrap.min.js?v=3.3.6"></script>
<!-- Flot -->
<script src="<{$siteurl}>Public/Front/js/plugins/flot/jquery.flot.js"></script>
<script src="<{$siteurl}>Public/Front/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<{$siteurl}>Public/Front/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="<{$siteurl}>Public/Front/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<{$siteurl}>Public/Front/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<{$siteurl}>Public/Front/js/plugins/flot/jquery.flot.symbol.js"></script>
<!-- Peity -->
<script src="<{$siteurl}>Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
<script src="<{$siteurl}>Public/Front/js/demo/peity-demo.js"></script>
<!-- 自定义js -->
<script src="<{$siteurl}>Public/Front/js/content.js?v=1.0.0"></script>
<!-- jQuery UI -->
<script src="<{$siteurl}>Public/Front/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Jvectormap -->
<script src="<{$siteurl}>Public/Front/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<{$siteurl}>Public/Front/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- EayPIE -->
<script src="<{$siteurl}>Public/Front/js/plugins/easypiechart/jquery.easypiechart.js"></script>
<!-- Sparkline -->
<script src="<{$siteurl}>Public/Front/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- Sparkline demo data  -->
<script src="<{$siteurl}>Public/Front/js/demo/sparkline-demo.js"></script>
<script src="<{$siteurl}>Public/Front/js/user.js"></script>
<{:tongji(0)}>
</body>
</html>
