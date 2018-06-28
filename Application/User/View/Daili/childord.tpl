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
    <link href="<{$siteurl}>Public/Front/css/style.css" rel="stylesheet">
    <script src="<{$siteurl}>Public/Front/js/jquery.js"></script>
    <script src="<{$siteurl}>Public/js/bootstrap.min.js"></script>
    <script src="<{$siteurl}>Public/js/bootstrap-datepicker.js"></script>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content" style="padding:0 20px;">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>他的订单列表</h5>
            </div>
            <div class="ibox-content">
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-condensed table-responsive">
            <thead>
            <th>订单号</th>
            <th>交易金额</th>
            <th>手续费</th>
            <th>扣除流量</th>
            <th>实际金额</th>
            <th>提交时间</th>
            <th>成功时间</th>
            <th>通道</th>
            <th>状态</th>
            </thead>
            <tbody>
            <if condition="$list">
            <volist name="list" id="vo">
                <tr>
                    <td><{$vo.pay_orderid}></td>
                    <td><{$vo.pay_amount}></td>
                    <td><{$vo.pay_poundage}></td>
                    <td><{$vo.pay_traffic}></td>
                    <td><{$vo.pay_actualamount}></td>
                    <td><{$vo.pay_applydate|date='Y-m-d H:i:s',###}></td>
                    <td><{$vo.pay_successdate|date='Y-m-d H:i:s',###}></td>
                    <td><{$vo.pay_yzh_tongdao}></td>
                    <td><{$vo['pay_status']|status=###}></td>
                </tr>
            </volist>
            <else/>
                <tr><td colspan="8">没有找到任何数据.</td></tr>
            </if>
            </tbody>
        </table>
        </div>
    </div>
        </div>
    </div>
</div>
<div class="Page pagination"><{$page}></div>
</div>
</body>
</html>
