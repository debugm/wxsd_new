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
        <h5>用户管理</h5>
      </div>
      <div class="ibox-content">
    <blockquote class="layui-elem-quote">
  <form class="form-inline" role="form" action="" method="get" autocomplete="off" id="selectedform">
    <div class="form-group">
      <input type="text" class="form-control" style="width: 130px;" id="usernameidsearch" name="usernameidsearch" placeholder="商户号或用户名" value="<{$Think.get.usernameidsearch}>">
    </div>
    <div class="form-group">
      <select class="form-control" id="statussearch" name="statussearch">
        <option value="">状态</option>
        <option value="1">已激活</option>
        <option value="0">未激活</option>
        <option value="2">禁用</option>
      </select>
      <script type="text/javascript">
	  $("#statussearch").val('<{$Think.get.statussearch}>');
	  </script>
    </div>
    <div class="form-group">
      <select class="form-control" id="rzsearch" name="rzsearch">
        <option value="">认证</option>
        <option value="0">未认证</option>
        <option value="2">等待审核</option>
        <option value="1">认证用户</option>
      </select>
      <script type="text/javascript">
	  $("#rzsearch").val('<{$Think.get.rzsearch}>');
	  </script>
    </div>
    <div class="form-group">
      <select class="form-control" id="usertype" name="usertype">
        <option value="">用户类型</option>
        <option value="4">普通商户</option>
        <option value="5">普通代理商</option>
      </select>
      <script type="text/javascript">
	  $("#usertype").val('<{$Think.get.usertype}>');
	  </script>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" style="width: 150px;" id="sjusernamesearch" name="sjusernamesearch" placeholder="上级用户名或商户号" value="<{$Think.get.sjusernamesearch}>">
    </div>
    <div class="form-group">
      <input type="text"  id="starttime" name="starttime"  class="form-control laydate-icon zy-searchstr" style="height: 30px;width: 120px;" onclick="laydate({ele:this,max: laydate.now(+1),istoday: true})" value="<{$Think.get.tjdate_ks}>" placeholder="开始日期">
      <input type="text"  id="endtime" name="endtime"  class="form-control laydate-icon zy-searchstr" style="height: 30px;width: 120px;" onclick="laydate({ele:this,max: laydate.now(+1),istoday: true})" value="<{$Think.get.tjdate_js}>" placeholder="结束日期">
    </div>
    <button type="submit" class="layui-btn layui-btn-small"> <span class="glyphicon glyphicon-search"></span> 搜索</button>
    <a href="javascript:;" id="export" class="layui-btn layui-btn-danger layui-btn-small"><span class="glyphicon glyphicon-export"></span> 导出数据</a>
  </form>
    </blockquote>

<div class="table-responsive" style="=margin:0px auto; margin-top:10px;">
  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
        <td style="text-align:center; cursor:pointer;" id="qxqx"><span class="glyphicon glyphicon-ok"></span></td>
        <td><strong>用户名</strong></td>
        <td><strong>商户号</strong></td>
        <td><strong>用户类型</strong></td>
        <td><strong>上级用户名</strong></td>
        <td><strong>状态</strong></td>
        <td><strong>认证</strong></td>
        <td><strong>账户剩余流量</strong></td>
        <td><strong>余额</strong></td>
        <td><strong>提款设置</strong></td>
        <td><strong>通道</strong></td>
        <td><strong>费率</strong></td>
        <td><strong>注册时间</strong></td>
        <td><strong>编辑</strong></td>
        <td><strong>通道列表</strong></td>
        <td><strong>删除</strong></td>
      </tr>
    </thead>
    <tbody id="content">
      <volist name="list" id="vo">
        <tr>
          <td style="text-align:center;"><input type="checkbox" class="xzxz" name="xz" value="<{$vo.id}>"></td>
          <td style="text-align:center;"><{$vo.username}></td>
          <td style="text-align:center;"><a href="<{:U('User/changeuser',array('userid'=>$vo['id']))}>" target="_blank"><{$vo['id']|shanghubianhao=###}></a></td>
          <td style="text-align:center"><{$vo['usertype']|usertype=###}></td>
          <td style="text-align:center;"><{$vo['superioruserid']|sjusername=###}></td>
          <td style="text-align:center;"><a href="javascript:edit('<{$vo.username}>','<{$vo.id}>',1)"><{$vo["status"]|zhuangtai=###}></a></td>
          <td style="text-align:center;"><a href="javascript:edit('<{$vo.username}>','<{$vo.id}>',2)"><{$vo['id']|renzheng=###}></a></td>
          <td style="text-align:center;"><a href="<{:U("User/usermoney","userid=".$vo["id"])}>" style="color:#090;"><{$vo['id']|liuliangzongyue=###}></a></td>
          <td style="text-align:center;"><a href="<{:U("User/usermoney","userid=".$vo["id"])}>" style="color:#090;"><{$vo['id']|zhanghuzongyue=###}></a></td>
          <td style="text-align:center;"><a href="javascript:edit('<{$vo.username}>','<{$vo.id}>',5)">提款设置</a></td>
          <td style="text-align:center;"><a href="javascript:edit('<{$vo.username}>','<{$vo.id}>',7)">通道</a></td>
          <td style="text-align:center;"><a href="javascript:edit('<{$vo.username}>','<{$vo.id}>',6)">费率</a></td>
          <td style="text-align:center; color:#369"><strong><{$vo.regdatetime||date="Y-m-d",###}></strong></td>
          <td style="text-align:center;"><a href="javascript:edit('<{$vo.username}>','<{$vo.id}>',0)">编辑</a></td>
          <td style="text-align:center;"><a href="<{:U('User/acclist',array('userid'=>$vo['id']))}>">通道列表</a></td>
          <td style="text-align:center;"><if condition="$vo.inviteconfigzt lt 2"> <a href="javascript:delUser('<{$vo.id}>')"><span class="glyphicon glyphicon-trash"></span></a>
              <else />
              - </if></td>
        </tr>
      </volist>
    </tbody>
      <tr>
        <td colspan="1" style="text-align:center; vertical-align:middle;"><a href="javascript:;" id="qxdel"><span class="glyphicon glyphicon-trash"></span></a></td>
        <td colspan="14" style="text-align:center;"><div class="pagex"> <{$_page}></div></td>
      </tr>

  </table>
</div>
      </div>
    </div>
</div>
</div>
</div>
<include file="usercontrolModal" />
  <script>
      function delUser(id){
          var state = confirm("确定要删除嘛？");
          if(!state){
              return false;
          }
          $.ajax({
              type:'POST',
              url:"<{:U('Admin/User/deluser')}>",
              data:"id="+id,
              dataType:'text',
              success:function(str){
                  if(str == "ok"){
                      $("#tscontent").text("删除成功！");
                  }else{
                      $("#tscontent").text("删除成功！");
                  }
                  $('#myModal').modal('show');
                  $("#okdelbutton").hide();
              }
          });
      }


      //批量删除
      $('#qxdel').on('click', function() {
        var idstr = '';
        $('#content').children('tr').each(function() {
            var $that = $(this);
            var $cbx = $that.children('td').eq(0).children('input[type=checkbox]')[0].checked;;
            if($cbx) {
                var n = $that.children('td').eq(0).children('input[type=checkbox]:checked').val();
                idstr += n + ',';
            }
        });
          $.post("<{:U('Admin/User/batchdel')}>",'ids='+idstr,function(str){
              if(str=='ok'){
                  alert('批量删除成功!');
              }else{
                  alert('批量删除失败！');
              }
              location.reload();
          });
    });
    $('#export').on('click',function(){
        $('#selectedform').attr('action',"<{:U('Admin/User/exportuser')}>");
        $('#selectedform').submit();
    });
  </script>
  <{:tongji(0)}>
</body>
</html>
