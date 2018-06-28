<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>首页</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="/Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="/Public/Front/css/font-awesome.css?v=4.4.0" rel="stylesheet">
<!-- Morris --><link href="/Public/Front/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
<!-- Gritter -->
<link href="/Public/Front/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
<link href="/Public/Front/css/animate.css" rel="stylesheet">
<link href="/Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
<div class="row">
  <div class="col-sm-12">
    <blockquote class="text-warning" style="font-size:14px;background: #FFF;" >
      <li style="list-style: none;"> 用户名：<strong style="color:#036"><{$Think.session.admin_username}></strong>&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" data-toggle="modal" data-target="#myModal">修改密码</a> |
				【
          <span style="color:#F30">	<switch name="Think.session.admin_usertype">
				    <case value="0">总管理员</case>
				</switch></span>  
        】</li>
    </blockquote>
  </div>
 
</div>
 
<div class="row">

  <div class="col-md-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title"><h5>今日交易统计</h5></div>
      <div class="ibox-content no-padding">
        <div class="panel-body">
          <div id="dday" style="height: 180px;"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title"><h5>7天交易统计</h5></div>
      <div class="ibox-content no-padding">
        <div class="panel-body">
          <div id="dweek" style="height: 180px;"></div></div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title"><h5>月度交易统计</h5></div>
      <div class="ibox-content no-padding">
        <div class="panel-body">
          <div class="panel-group" id="version">
            <div class="col-lg-12"><div id="dmonth" style="height:280px;"></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
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

  <div class="col-md-12">
    <div class="row">
      <div class="col-sm-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>最近成功交易记录</h5>
            <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> </div>
          </div>
          <div class="ibox-content">
            <table class="table table-hover no-margins">
              <thead>
                <tr>
                  <th>订单号</th>
                  <th>成功时间</th>
                  <th>通道</th>
                  <th>订单类型</th>
                  <th>手续费</th>
                  <th>金额</th>
                  <th>状态</th>
                </tr>
              </thead>
              <tbody>
                <volist name="zjbdlist" id="vo">
                  <tr>
                    <td><{$vo.pay_orderid}></td>
                    <td ><{$vo.pay_successdate|date='Y-m-d H:i:s',###}></td>
                    <td><{$vo.pay_yzh_tongdao}></td>
                    <td ><if condition="$vo.ddlx == 1">
                        <span style="color:#060">充值订单</span>
                        <else />
                        收款订单
                      </if></td>
                    <td><{$vo.pay_poundage}></td>
                    <td ><{$vo["pay_actualamount"]|bdje=###}> </td>
                    <td style="text-align:center; color:#369"><{$vo['pay_status']|status=###}></td>
                  </tr>
                </volist>
              </tbody>
            </table>
            <div class="pagination"><{$page}></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">修改密码</h4>
      </div>
      <div class="modal-body">
        <!--------------------------------------------------------------------------------->
        <form>
          <div class="form-group">
            <label for="ypassword">原密码</label>
            <input type="password" class="form-control" id="ypassword" placeholder="请输入原密码">
          </div>
          <div class="form-group">
            <label for="newpassword">新密码</label>
            <input type="password" class="form-control" id="newpassword" placeholder="请输入新密码">
          </div>
           <div class="form-group">
            <label for="newpasswordok">确认新密码</label>
            <input type="password" class="form-control" id="newpasswordok" placeholder="请再次输入新密码">
          </div>
        
          <button type="button" class="btn btn-primary btn-lg btn-block" id="xgpasswordbutton" ajaxurl="<{:U("System/Editpassword")}>">修改密码</button>
        </form>
        <!--------------------------------------------------------------------------------->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关 闭</button>
        
      </div>
    </div>
  </div>
</div>
<include file="dealrecordlModal" />
<!-- 全局js -->
<script src="/Public/Front/js/jquery.min.js"></script>
<script src="/Public/Front/js/bootstrap.min.js"></script>
<script src="/Public/Front/js/plugins/flot/jquery.flot.js"></script>
<script src="/Public/Front/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="/Public/Front/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="/Public/Front/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="/Public/Front/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="/Public/Front/js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="/Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/Public/Front/js/demo/peity-demo.js"></script>
<script src="/Public/Front/js/content.js"></script>
<script src="/Public/Front/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/Public/Front/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/Public/Front/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/Public/Front/js/plugins/easypiechart/jquery.easypiechart.js"></script>
<script src="/Public/Front/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="/Public/Front/js/demo/sparkline-demo.js"></script>
<script src="/Public/Admin/js/user.js"></script>
<script src="/Public/Front/js/echarts.common.min.js"></script>
<script>
    var myChartday = echarts.init(document.getElementById('dday'));
    var myChartweek = echarts.init(document.getElementById('dweek'));
    var myChartmonth = echarts.init(document.getElementById('dmonth'));
    // 使用刚指定的配置项和数据显示图表。
    myChartday.setOption({
        title:{
            text:'实时统计(共<{$ddata.num}>笔)',
            x:'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            data:['今日交易金额','今日收入金额','今日支持金额']
        },
        series: [
            {
                name:'交易统计',
                type:'pie',
                radius: ['50%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '14',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data:[
                    {value:"<{$ddata.amount}>", name:'今日交易金额'},
                    {value:"<{$ddata.rate}>", name:'今日收入金额'},
                    {value:"<{$ddata.total}>", name:'今日支出金额'},
                ]
            }
        ]
    });
    myChartweek.setOption({
        title:{
            text:'7天统计(共<{$wdata.num}>笔)',
            x:'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            data:['7日交易金额','7日收入金额','7日支持金额']
        },
        series: [
            {
                name:'交易统计',
                type:'pie',
                radius: ['50%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '14',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data:[
                    {value:<{$wdata.amount}>, name:'7日交易金额'},
                    {value:<{$wdata.rate}>, name:'7日收入金额'},
                    {value:<{$wdata.total}>, name:'7日支出金额'}
                ]
            }
        ]
    });
    myChartmonth.setOption({
        tooltip : {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#6a7985'
                }
            }
        },
        legend: {
            data:['交易金额','收入金额','支出金额']
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : [<{$mdata.mdate|implode=","}>]
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'交易金额',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[<{$mdata.amount|implode=","}>]
            },
            {
                name:'收入金额',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[<{$mdata.rate|implode=","}>]
            },
            {
                name:'支出金额',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[<{$mdata.total|implode=","}>]
            },
        ]
    });
</script>
<{:tongji(0)}>
</body>
</html>
