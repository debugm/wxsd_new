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
  <link href="/Public/Front/js/plugins/layui/css/layui.css" rel="stylesheet">
  <script type="text/javascript" src="/Public/js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/Public/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="/Public/js/floatDiv.js"></script>
  <script type="text/javascript" src="/Public/Admin/js/user.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>邀请码管理</h5>
        </div>
        <div class="ibox-content">
          <blockquote class="layui-elem-quote">
            <form class="form-inline" role="form" action="" method="get" autocomplete="off" id="selectedform">
              <div class="form-group">
                <input type="text" class="form-control" style="width: 120px;" id="invitecodesearch" name="invitecodesearch" placeholder="邀请码" value="<{$Think.get.invitecodesearch}>">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" style="width: 120px;" id="fbusernamesearch" name="fbusernamesearch" placeholder="发布者用户名" style="width:150px;" value="<{$Think.get.fbusernamesearch}>">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" style="width: 120px;" id="syusernamesearch" name="syusernamesearch" placeholder="使用者用户名" style="width:150px;" value="<{$Think.get.syusernamesearch}>">
              </div>
              <div class="form-group">
                <select class="form-control" id="regtypesearch" name="regtypesearch">
                  <option value="">注册类型</option>
                  <option value="4">普通商户</option>
                  <option value="5">普通代理商</option>
                </select>
                <script type="text/javascript">
                    $("#regtypesearch").val('<{$Think.get.regtypesearch}>');
                </script>
              </div>
              <div class="form-group">
                <select class="form-control" id="ztsearch" name="ztsearch">
                  <option value="">所有状态</option>
                  <option value="1">未使用</option>
                  <option value="2">已使用</option>
                  <option value="0">禁用</option>
                </select>
                <script type="text/javascript">
                    $("#ztsearch").val('<{$Think.get.ztsearch}>');
                </script>
              </div>
              <button type="submit" class="layui-btn layui-btn-small"> <span class="glyphicon glyphicon-search"></span> 搜索 </button>
              <button type="button" class="layui-btn layui-btn-small" onClick="javascript:location.reload();"><span class="glyphicon glyphicon-refresh"></span> 刷新数据 </button>
              <button type="button" class="layui-btn layui-btn-small" id="yqmsz"><span class="glyphicon glyphicon-wrench"></span> 设 置 </button>
              <button type="button" class="layui-btn layui-btn-danger layui-btn-small" id="yqmtj" ajaxurl="<{:U("createinvite")}>"><span class="glyphicon glyphicon-plus"></span> 添加邀请码 </button>
            </form>
          </blockquote>

          <div class="table-responsive" style="margin:0px auto; margin-top:10px;">
            <table class="table table-bordered table-hover table-condensed table-responsive">
              <thead>
              <tr>
                <th>邀请码</th>
                <th>注册地址</th>
                <th>发布者</th>
                <th>使用者</th>
                <th>生成时间</th>
                <th>过期时间</th>
                <th>使用时间</th>
                <th>注册类型</th>
                <th>状态</th>
                <th>删除</th>
              </tr>
              </thead>
              <tbody>
              <volist name="list" id="vo">
                <tr>
                  <td class="success"><{$vo.invitecode}></td>
                  <td style="text-align:center;"><a href="#" onClick="javascript:window.open('http://<{:C("DOMAIN")}><{:U("Home/Index/reg","invitecode=".$vo["invitecode"])}>');">注册地址</a></td>
                  <td class="active"><{$vo["fmusernameid"]|getusername=###}></td>
                  <td class="active"><{$vo["syusernameid"]|getusername=###}></td>
                  <td class="active"><{:date('Y-m-d',$vo["fbdatetime"])}></td>
                  <td class="active"><{:date("Y-m-d",$vo["yxdatetime"])}></td>
                  <td class="active"><{$vo["sydatetime"]? date('Y-m-d',$vo["sydatetime"]):"-"}></td>
                  <td class="info">
                    <switch name="vo.regtype">
                      <case value="4">普通商户</case>
                      <case value="5">普通代理商</case>
                    </switch>
                  </td>
                  <td class="danger">
                    <{$vo['id']|getinviteconfigzt=###}>
                  </td>
                  <td class="active" style="text-align:center;">
                    <if condition="$vo.inviteconfigzt lt 2">
                      <a href="javascript:delinvitecode('<{$vo.id}>')"><span class="glyphicon glyphicon-trash"></span></a>
                      <else />
                      -
                    </if>
                  </td>
                </tr>
              </volist>
              <tr>
                <td colspan="11"><div class="pagex"><{$_page}> </div></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div></div>
  </div>
</div>
<include file="szyqm" />
<include file="addyqm" />
<include file="myModal" />
<{:tongji(0)}>
</body>
</html>
