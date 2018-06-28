<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title>通道账户管理</title>
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
<div class="wrapper wrapper-content animated">
<div class="row">
  <div class="col-sm-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
       <h5>通道账户管理</h5>
      <div class="ibox-content">
    <div class="table-responsive" style="=margin:0px auto; margin-top:10px;">
  <table class="table table-bordered table-hover table-condensed table-responsive">
    <thead>
      <tr class="titlezhong">
        <td style="text-align:center; cursor:pointer;" id="qxqx"><span class="glyphicon glyphicon-ok"></span></td>
        <td><strong>商户号</strong></td>
        <td><strong>银行代码</strong></td>
        <td><strong>子账户</strong></td>
        <td><strong>所属门店</strong></td>
        <td><strong>收款账户</strong></td>
        <td><strong>限额</strong></td>
        <td><strong>收款</strong></td>
        <td><strong>绑定域名</strong></td>
        <td><strong>状态</strong></td>
        <td><strong>游标</strong></td>
        <td><strong>操作</strong></td>
      </tr>
    </thead>
    <tbody id="content">
      <volist name="acclist" id="vo">
        <tr>
          <td style="text-align:center;"><input type="checkbox" class="xzxz" name="xz" value="<{$vo.id}>"></td>
          <td style="text-align:center;"><{$vo.userid}></td>
          <td style="text-align:center;"><{$vo.bankcode}></td>
          <td style="text-align:center;"><input type="text" value="<{$vo.accountid}>" id="accid<{$vo.id}>"  disabled ></td>
          <td style="text-align:center;"><input type="text" value="<{$vo.shname}>" id="shname<{$vo.id}>"  disabled ></td>
          <td style="text-align:center;"><input type="text" value="<{$vo.skid}>" id="skid<{$vo.id}>" disabled></td>
          <td style="text-align:center;"><input type="text" value="<{$vo.maxmoney}>" id="maxmoney<{$vo.id}>" size="8" disabled></td>
          <td style="text-align:center;"><input type="text" value="<{$vo.skamount}>" id="skamount<{$vo.id}>" size="8" disabled></td>
          <td style="text-align:center;"><input type="text" size="5" value="<{$vo.url}>" id="jurl<{$vo.id}>" disabled></td>
          <td style="text-align:center;"><input type="text" size="2" value="<{$vo.enable}>" id="enable<{$vo.id}>" disabled></td>
          <td style="text-align:center;"><input type="text" size="2" value="<{$vo.floating}>" id="floating<{$vo.id}>" disabled></td>
          <td style="text-align:center;"> <a href="javascript:editAcc('<{$vo.id}>')">编辑</a>
	<a href="javascript:delAcc('<{$vo.id}>',0)">删除</a>  
	<a href="javascript:updateAcc('<{$vo.id}>',1)">更新</a>  
            </td>
        </tr>
      </volist>
		 <tr>
          <!--<td style="text-align:center;"><input type="checkbox" class="xzxz" name="xz" value="<{$vo.id}>"></td>
          <td style="text-align:center;"><{$vo.userid}></td>
          <td style="text-align:center;"><{$vo.bankcode}></td>
          <td style="text-align:center;"><input type="text" value="" id="accid1997" size="10"></td>
          <td style="text-align:center;"><input type="text" value="" id="skid1997"></td>
          <td style="text-align:center;"><input type="text" value="" id="maxmoney1997" size="10"></td>
          <td style="text-align:center;"><input type="text" value="" id="jurl1997"></td>
          <td style="text-align:center;"><{$vo.enable}></td>
          <td style="text-align:center;"> <a href="javascript:addNew('1997')">确定</a>-->
          <td style="text-align:center;"> <button onclick="addAcc();">增加
            </td>
        </tr>

	    </tbody>
      <tr>
        <td colspan="14" style="text-align:center;"><div class="pagex"> <{$_page}></div></td>
      </tr>

  </table>
</div>
      </div>
    </div>
</div>
</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-describedby="tscontent" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" onclick="javascript:location.reload();">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-volume-up"></span></h4>
      </div>
      <div class="modal-body" id="tscontent" style="color:#000; font-family:'微软雅黑';">
    
      </div>
      <div class="modal-footer">
      <input type="hidden" id="delid" ajaxurl="<{:U("delAcc")}>">
      <button type="button" class="btn btn-primary" id="okdelbutton" style="display:none;">
        确认删除
        </button>
        <button type="button" class="btn btn-default" onclick="javascript:location.reload();">
        关闭
        </button>

      </div>
    </div>
  </div>
</div>
  <script>
	

	$("#okdelbutton").click(function(e) {
        //alert("sdggsad");
        datastr = "delid="+$("#delid").val();
        ajaxurl = $("#delid").attr("ajaxurl");
        /////////////////////////////////////////////////////////
        $.ajax({
            type:'POST',
            url:ajaxurl,
            data:datastr,
            dataType:'text',
            success:function(str){
                ///////////////////////////////////
                if(str == "ok"){
                    $("#tscontent").text("删除成功！");

                }else{
                    $("#tscontent").text("删除成功！");
                }
                $('#myModal').modal('show');
                $("#okdelbutton").hide();
            }
        });
    });

	function addNew(id){
	    var userid = $('#userid'+id).val();
	    var bc = $('#bc'+id).val();
	    var accid = $('#accid'+id).val();
	    var skid = $('#skid'+id).val();
	    var mm = $('#mm'+id).val();
	    var jurl = $('#jurl'+id).val();
	
	    $.ajax({
              type:'POST',
              url:"<{:U('Admin/User/addNew')}>",
              data:"userid="+userid+"&accid="+accid+"&skid="+skid+"&mm="+mm+"&bc="+bc+"&jurl="+jurl,
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

	function addAcc(){
		
		var link = document.createElement('tr');
		var tm = new Date().getTime();
		link.innerHTML = "<td style='text-align:center;'><input type='checkbox' class='xzxz' name='xz' value=''></td>\
          <td style='text-align:center;'><input type='text' value=''  size='8' id='userid" + tm +"'"+ "></td>\
          <td style='text-align:center;'><input type='text' value=''  size='8' id='bc" +tm + "'" +"></td>\
          <td style='text-align:center;'><input type='text' value=''   id='accid" +tm+"'" +"></td>\
          <td style='text-align:center;'><input type='text' value=''   id='shname" +tm+"'" +"></td>\
          <td style='text-align:center;'><input type='text' value=''  id='skid"+tm+"'"+"></td>\
          <td style='text-align:center;'><input type='text' value='' size='8' id='mm"+tm+"'"+"></td>\
          <td style='text-align:center;'><input type='text' size='5' value=''  id='jurl"+tm+"'"+"></td>\
          <td style='text-align:center;'><input type='text' value='0' size='2' id='enable"+tm+"'"+"></td>\
          <td style='text-align:center;'><input type='text' value='0' size='2' id='floating"+tm+"'"+"></td>\
          <td style='text-align:center;'> <a href='javascript:addNew("+tm+")'>确定</a>\
            </td>";
		var main = document.getElementById('content'); 
		main.appendChild(link);   
	
	}


       function updateAcc(id,status){
	  var url = $('#jurl'+id).val()
	  var accid = $('#accid'+id).val()
	  var skid = $('#skid'+id).val()
	  var mm = $('#maxmoney'+id).val()
	  var floating = $('#floating'+id).val()
	  var enable = $('#enable'+id).val()
	  var shname = $('#shname'+id).val()
	  var skamount = $('#skamount'+id).val()
	  var floating = $('#floating'+id).val()
          $.ajax({
              type:'POST',
              url:"<{:U('Admin/User/updateAcc')}>",
              data:"id="+id+"&accid="+accid+"&skid="+skid+"&mm="+mm+"&jurl="+url+"&floating="+floating+"&enable="+enable+"&shname="+shname+"&skamount="+skamount+"&float="+floating,
              dataType:'text',
              success:function(str){
                  if(str == "ok"){
                      $("#tscontent").text("操作成功！");
                  }else{
                      $("#tscontent").text("删除成功！");
                  }
		alert("操作成功")
                  //$('#myModal').modal('show');
                  //$("#okdelbutton").hide();
		location.reload();
              }
          });
      }

      function editAcc(id){
	 
		$("#accid"+id).removeAttr("disabled");
		$("#skid"+id).removeAttr("disabled");
		$("#jurl"+id).removeAttr("disabled");
		$("#maxmoney"+id).removeAttr("disabled");
		$("#floating"+id).removeAttr("disabled");
		$("#enable"+id).removeAttr("disabled");
		$("#shname"+id).removeAttr("disabled");
		$("#skamount"+id).removeAttr("disabled");
		$("#floating"+id).removeAttr("disabled");
	}
      function delAcc(id,status){
	$("#tscontent").text("您确认要删除吗？");
    $('#myModal').modal('show');
    $('#okdelbutton').show();
    $("#delid").val(id);
	  /*
	  if(status == 0)
          var state = confirm("确定要禁用嘛？");
	  else
          var state = confirm("确定要启用嘛？");
          if(!state){
              return false;
          }
          $.ajax({
              type:'POST',
              url:"<{:U('Admin/User/delacc')}>",
              data:"id="+id+"&status="+status,
              dataType:'text',
              success:function(str){
                  if(str == "ok"){
                      $("#tscontent").text("操作成功！");
                  }else{
                      $("#tscontent").text("删除成功！");
                  }
                  $('#myModal').modal('show');
                  $("#okdelbutton").hide();
              }
          });*/
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
</body>
</html>
