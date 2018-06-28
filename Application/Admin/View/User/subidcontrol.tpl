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
        <h5>子商户管理</h5>
      </div>

<div class="table-responsive" style="=margin:0px auto; margin-top:10px;">
  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
        <td style="text-align:center; cursor:pointer;" id="qxqx"><span class="glyphicon glyphicon-ok"></span></td>
        <td><strong>子商户号</strong></td>
        <td><strong>跳转域名</strong></td>
        <td><strong>状态</strong></td>
        <td><strong>所属商户</strong></td>
        <td><strong>昨日成功率</strong></td>
        <td><strong>添加时间</strong></td>
        <td><strong>分配给</strong></td>
        <td><strong>分配给收款账号</strong></td>
        <td><strong>分配</strong></td>
        <td><strong>删除</strong></td>
      </tr>
    </thead>
    <tbody id="content">
      <volist name="list" id="vo">
        <tr>
          <td style="text-align:center;"><input type="checkbox" class="xzxz" name="xz" value="<{$vo.id}>"></td>
          <td style="text-align:center;"><input type="text" value="<{$vo.subid}>" id="subid<{$vo.id}>" disabled> </td>
          <td style="text-align:center;"><input type="text" value="<{$vo.jumpurl}>" id="jumpurl<{$vo.id}>" disabled> </td>
          <td style="text-align:center;"><{$vo.status}></td>
          <td style="text-align:center;"><{$vo.owner}></td>
          <td style="text-align:center;"><{$vo.yesterdaycgl}></td>
          <td style="text-align:center;"><{$vo.addtime}></td>
	  <td style="text-align:center;">
	  <select name="owner" id="owner<{$vo.id}>">
		<option value="">-</option>
	  <volist name="userlist" id="vouser">
	      <option value="<{$vouser.uid}>"><{$vouser.uid}></option>
          </volist>
	  </select>
	  </td>
	  <td style="text-align:center;">
	  <select name="skid" id="skid<{$vo.id}>">
		<option value="">-</option>
	  <volist name="skidlist" id="vosk">
	      <option value="<{$vosk.skid}>"><{$vosk.skid}></option>
          </volist>
	  </select>
	  </td>

          <td style="text-align:center;"> <a href="javascript:assignSubid('<{$vo.id}>')"><span class="glyphicon glyphicon-wrench"></span></a></td>
          <td style="text-align:center;"> <a href="javascript:delUser('<{$vo.id}>')"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
      </volist>
    </tbody>
      <tr>
        <td colspan="1" style="text-align:center; vertical-align:middle;"><a href="javascript:;" id="qxdel"><span class="glyphicon glyphicon-wrench"></span></a></td>
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

	 function assignSubid(id){
            var subid = $('#subid'+id).val();
            var jumpurl = $('#jumpurl'+id).val();
            var ownerid = $('#owner'+id).val();
            var skid = $('#skid'+id).val();

            $.ajax({
              type:'POST',
              url:"<{:U('Admin/User/assignsubid')}>",
              data:"subid="+subid+"&jumpurl="+jumpurl+"&ownerid="+ownerid+"&skid="+skid,
              dataType:'text',
              success:function(str){
                  if(str == "ok"){
                      $("#tscontent").text("操作成功！");
                  }else{
                      $("#tscontent").text("操作失败！");
                  }
                alert("操作成功")
                location.reload();
                  //$('#myModal').modal('show');
                  //$("#okdelbutton").hide();
              }
          });

        }

      //批量删除
      $('#qxdel').on('click', function() {
	var result = [];
        $('#content').children('tr').each(function() {
        var idstr = {};
            var $that = $(this);
            var $cbx = $that.children('td').eq(0).children('input[type=checkbox]')[0].checked;;
            if($cbx) {
                var n = $that.children('td').eq(1).children('input[type=text]').val();
		idstr['subid'] = n
		
                var n = $that.children('td').eq(2).children('input[type=text]').val();
		idstr['jumpurl'] = n
                var n = $that.children('td').eq(7).children('select').val();
		idstr['ownerid'] = n
                var n = $that.children('td').eq(8).children('select').val();
		idstr['skid'] = n
		result.push(idstr)
            }
        });
	$.ajax({
              type:'POST',
              url:"<{:U('Admin/User/assignsubidbatch')}>",
              data:{jsonstr:JSON.stringify(result)},
              dataType:'json',
              success:function(str){
                  if(str == "ok"){
                      $("#tscontent").text("操作成功！");
                  }else{
                      $("#tscontent").text("操作失败！");
                  }
                alert("操作成功")
                location.reload();
                  //$('#myModal').modal('show');
                  //$("#okdelbutton").hide();
              }
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
