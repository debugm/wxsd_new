<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title><?php echo C("WEB_TITLE");?></title>
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
      <input type="text" class="form-control" style="width: 130px;" id="usernameidsearch" name="usernameidsearch" placeholder="商户号或用户名" value="<?php echo ($_GET['usernameidsearch']); ?>">
    </div>
    <div class="form-group">
      <select class="form-control" id="statussearch" name="statussearch">
        <option value="">状态</option>
        <option value="1">已激活</option>
        <option value="0">未激活</option>
        <option value="2">禁用</option>
      </select>
      <script type="text/javascript">
	  $("#statussearch").val('<?php echo ($_GET['statussearch']); ?>');
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
	  $("#rzsearch").val('<?php echo ($_GET['rzsearch']); ?>');
	  </script>
    </div>
    <div class="form-group">
      <select class="form-control" id="usertype" name="usertype">
        <option value="">用户类型</option>
        <option value="4">普通商户</option>
        <option value="5">普通代理商</option>
      </select>
      <script type="text/javascript">
	  $("#usertype").val('<?php echo ($_GET['usertype']); ?>');
	  </script>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" style="width: 150px;" id="sjusernamesearch" name="sjusernamesearch" placeholder="上级用户名或商户号" value="<?php echo ($_GET['sjusernamesearch']); ?>">
    </div>
    <div class="form-group">
      <input type="text"  id="starttime" name="starttime"  class="form-control laydate-icon zy-searchstr" style="height: 30px;width: 120px;" onclick="laydate({ele:this,max: laydate.now(+1),istoday: true})" value="<?php echo ($_GET['tjdate_ks']); ?>" placeholder="开始日期">
      <input type="text"  id="endtime" name="endtime"  class="form-control laydate-icon zy-searchstr" style="height: 30px;width: 120px;" onclick="laydate({ele:this,max: laydate.now(+1),istoday: true})" value="<?php echo ($_GET['tjdate_js']); ?>" placeholder="结束日期">
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
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td style="text-align:center;"><input type="checkbox" class="xzxz" name="xz" value="<?php echo ($vo["id"]); ?>"></td>
          <td style="text-align:center;"><?php echo ($vo["username"]); ?></td>
          <td style="text-align:center;"><a href="<?php echo U('User/changeuser',array('userid'=>$vo['id']));?>" target="_blank"><?php echo (shanghubianhao($vo['id'])); ?></a></td>
          <td style="text-align:center"><?php echo (usertype($vo['usertype'])); ?></td>
          <td style="text-align:center;"><?php echo (sjusername($vo['superioruserid'])); ?></td>
          <td style="text-align:center;"><a href="javascript:edit('<?php echo ($vo["username"]); ?>','<?php echo ($vo["id"]); ?>',1)"><?php echo (zhuangtai($vo["status"])); ?></a></td>
          <td style="text-align:center;"><a href="javascript:edit('<?php echo ($vo["username"]); ?>','<?php echo ($vo["id"]); ?>',2)"><?php echo (renzheng($vo['id'])); ?></a></td>
          <td style="text-align:center;"><a href="<?php echo U("User/usermoney","userid=".$vo["id"]);?>" style="color:#090;"><?php echo (liuliangzongyue($vo['id'])); ?></a></td>
          <td style="text-align:center;"><a href="<?php echo U("User/usermoney","userid=".$vo["id"]);?>" style="color:#090;"><?php echo (zhanghuzongyue($vo['id'])); ?></a></td>
          <td style="text-align:center;"><a href="javascript:edit('<?php echo ($vo["username"]); ?>','<?php echo ($vo["id"]); ?>',5)">提款设置</a></td>
          <td style="text-align:center;"><a href="javascript:edit('<?php echo ($vo["username"]); ?>','<?php echo ($vo["id"]); ?>',7)">通道</a></td>
          <td style="text-align:center;"><a href="javascript:edit('<?php echo ($vo["username"]); ?>','<?php echo ($vo["id"]); ?>',6)">费率</a></td>
          <td style="text-align:center; color:#369"><strong><?php echo (date("Y-m-d",$vo["regdatetime"])); ?></strong></td>
          <td style="text-align:center;"><a href="javascript:edit('<?php echo ($vo["username"]); ?>','<?php echo ($vo["id"]); ?>',0)">编辑</a></td>
          <td style="text-align:center;"><a href="<?php echo U('User/acclist',array('userid'=>$vo['id']));?>">通道列表</a></td>
          <td style="text-align:center;"><?php if($vo["inviteconfigzt"] < 2): ?><a href="javascript:delUser('<?php echo ($vo["id"]); ?>')"><span class="glyphicon glyphicon-trash"></span></a>
              <?php else: ?>
              -<?php endif; ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
      <tr>
        <td colspan="1" style="text-align:center; vertical-align:middle;"><a href="javascript:;" id="qxdel"><span class="glyphicon glyphicon-trash"></span></a></td>
        <td colspan="14" style="text-align:center;"><div class="pagex"> <?php echo ($_page); ?></div></td>
      </tr>

  </table>
</div>
      </div>
    </div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-describedby="tscontent" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close modalgb" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">
        	<span class="glyphicon glyphicon-user glyphicon"></span> <span id="usernamemodal"></span>
        </h4>
      </div>
      <div class="modal-body" id="tscontent" style="color:#000; font-family:'微软雅黑';">
  <!--------------------------------------------------------------------------------------------------->
  <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="edituserlist">
  <li class="active"><a href="#jbxx" role="tab" data-toggle="tab" ajaxurl="<?php echo U("User/jbxx");?>">基本信息</a></li>
  <li><a href="#zhuangtai" role="tab" data-toggle="tab" ajaxurl="<?php echo U("User/zhuangtai");?>">状态</a></li>
  <li><a href="#rzxx" role="tab" data-toggle="tab" ajaxurl="<?php echo U("User/renzheng");?>">认证</a></li>
  <li><a href="#mima" role="tab" data-toggle="tab" ajaxurl="<?php echo U("User/password");?>">密码</a></li>
  <li><a href="#yinhangka" role="tab" data-toggle="tab" ajaxurl="<?php echo U("User/bankcard");?>">银行卡</a></li>
  <li><a href="#tksz" role="tab" data-toggle="tab" ajaxurl="<?php echo U("User/tksz");?>">提款设置</a></li>
  <li><a href="#feilv" role="tab" data-toggle="tab" ajaxurl="<?php echo U("User/feilv");?>">费率</a></li>
  <li><a href="#tongdao" role="tab" data-toggle="tab" ajaxurl="<?php echo U("User/tongdao");?>">通道</a></li>
  <li><a href="#accountlist" role="tab" data-toggle="tab" ajaxurl="<?php echo U("User/acclist");?>">通道账户列表</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="jbxx">
     <!-----------------------------基本信息----------------------------->
  <br>
  <form role="form">
  	 <div class="form-group loadingclass" style="color: #F32043; text-align: center;">正在努力加载中...... </div>
  <div class="form-group">
    <label for="exampleInputEmail1">姓名</label>
    <input type="text" style="color:#01a9ef;" class="form-control" id="fullname" name="fullname"  placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">身份证号</label>
    <input type="text" style="color:#01a9ef;"  class="form-control" id="sfznumber" name="sfznumber"  placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">性别</label>
    <div style="clear: left;"></div>
    <select class="form-control" id="sex" name="sex" style="width:100px;">
        <option value="1">男</option>
        <option value="0">女</option>
      </select>
  </div>
<div class="form-group">
      <label for="email">生日</label>
      <div class="input-group">
        <input type="text"  id="birthday" name="birthday"  class="form-control laydate-icon zy-searchstr" onclick="laydate()" style="height: 30px;">
      </div>
    </div>
  
  <div class="form-group">
      <label for="qq">手机号</label>
      <input type="text" style="color:#01a9ef;"  class="form-control" id="phonenumber" name="phonenumber">
    </div>
    <div class="form-group">
      <label for="directory">qq号码</label>
      <input type="text" style="color:#01a9ef;"  class="form-control" id="qqnumber" name="qqnumber">
    </div>
    <div class="form-group">
          <label for="icp">联系地址</label>
          <input type="text" style="color:#01a9ef;"  class="form-control" id="address" name="address">
      </div>
      <div class="form-group">
          <label for="usertype">用户级别：</label>
          <div style="clear: left;"></div>
          <select class="form-control" id="usermodel" name="usertype" style="width:150px;">
              <option value="">选择类型</option>
              <option value="4">普通商户</option>
              <option value="5">普通代理商</option>
              <!--<option value="6">独立代理商</option>-->
          </select>
      </div>
    <input type="hidden" name="jbxxid" id="jbxxid" value="">
      <input type="hidden" name="userid" id="userid" value="">
    <div class="form-group">
  <button type="button" class="btn btn-info" onclick="javascript:editjbxx('<?php echo U("User/editjbxx");?>');"><span class="glyphicon glyphicon-ok"></span> 保存</button>
  </div>
</form>
  <!-----------------------------基本信息----------------------------->
  </div>
  <div class="tab-pane" id="zhuangtai" style="text-align: center;">
  	 <br>
<h1>当前状态：<span id="dqzt"></span></h1>
<br>
<input type="hidden" id="zhuangtaiid">
<a href="javascript:xgzhuangtai('<?php echo U("User/xgzhuangtai");?>',1);" class="btn btn-success btn-lg active" role="button" id="jihuo" style="display: none;">激活</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:xgzhuangtai('<?php echo U("User/xgzhuangtai");?>',2);" class="btn btn-danger btn-lg active" role="button" id="jinyong" style="display: none;">禁用</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:xgzhuangtai('<?php echo U("User/xgzhuangtai");?>',1);" class="btn btn-info btn-lg active" role="button" id="zhengchang" style="display: none;">恢复正常</a>
  </div>
  <div class="tab-pane" id="rzxx" style="text-align: center;">
  	<style>
#renzhengtupian img {
    float: left;
    width: 150px;
    height: 150px;
    margin:10px;
}
</style>
<h1 id="weirenzheng" style="display: none;"><br><span style="color: #C0C0C0;">未认证</span>
<a href="javascript:renzhengedit('<?php echo U("User/renzhengedit");?>',1);" class="btn btn-success btn-lg active" role="button">审核通过</a>
</h1>

<h1 id="yirenzheng" style="display: none;"><br><span style="color: #090;">已认证</span></h1>
<input type="hidden" id="renzhengid">
 <div class="form-group" id="renzhengtupian" style="display: none;">
 	<br>
<a href="/Public/images/default.gif" target="_blank"><img style="col-md-3 col-xs-12" src="/Public/images/default.gif" class="img-responsive"></a>
<a href="/Public/images/default.gif" target="_blank"><img style="col-md-3 col-xs-12" src="/Public/images/default.gif" class="img-responsive"></a>
<a href="/Public/images/default.gif" target="_blank"><img style="col-md-3 col-xs-12" src="/Public/images/default.gif" class="img-responsive"></a><br />
<a href="/Public/images/default.gif" target="_blank"><img style="col-md-3 col-xs-12" src="/Public/images/default.gif" class="img-responsive"></a>
<a href="/Public/images/default.gif" target="_blank"><img style="col-md-3 col-xs-12" src="/Public/images/default.gif" class="img-responsive"></a>
<a href="/Public/images/default.gif" target="_blank"><img style="col-md-3 col-xs-12" src="/Public/images/default.gif" class="img-responsive"></a>
</div>
<a href="javascript:renzhengedit('<?php echo U("User/renzhengedit");?>',0);" class="btn btn-danger btn-lg active" role="button" style="display: none;" id="shenhebutongguo">审核不通过</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:renzhengedit('<?php echo U("User/renzhengedit");?>',1);" class="btn btn-success btn-lg active" style="display: none;" role="button" id="shenhetongguo">审核通过</a>

<div class="form-group domainmd5key" style="display: none;">
    <label for="exampleInputEmail1" style="color: #F32043;"><span style="color:#0044CC;">绑定域名</span>(如果多个域名请用  “|” 分隔,不需要加http://)</label>
    <input type="text" style="color:#01a9ef;" class="form-control" id="domain" name="domain"  placeholder="如：www.baidu.com">
  </div>
    <div class="form-group domainmd5key" style="display: none;">
  <button type="button" class="btn btn-primary btn-lg btn-block" onclick="javascript:renzhengeditdomain('<?php echo U("User/renzhengeditdomain");?>');">绑定域名</button>
  </div>
  <div class="form-group domainmd5key" style="display: none;">
    <label for="exampleInputEmail1"><span style="color:#0044CC;">商户密钥</span>&nbsp;&nbsp;<button type="button" class="btn btn-warning" id="cxsc" data-loading-text="正在处理中..." ajaxurl="<?php echo U("createinvite");?>">随机生成</button></label>
    <input type="text" style="color:#5cb85c; font-weight: bold;" class="form-control" id="md5key" name="md5key"  placeholder="">
  </div>
    <div class="form-group domainmd5key" style="display: none;">
  <button type="button" class="btn btn-success btn-lg btn-block" onclick="javascript:renzhengeditmd5key('<?php echo U("User/renzhengeditmd5key");?>');">修改商户密钥</button>
  </div>

  </div>
  <div class="tab-pane" id="mima">
  	  <br>
  <input type="hidden" id="passwordid">
  <form role="form">
  <div class="form-group">
    <label for="exampleInputEmail1">请输入新的登录密码</label>
    <input type="password" style="color:#01a9ef;" class="form-control" id="loginpassword" name="loginpassword"  placeholder="">
  </div>
    <div class="form-group">
  <button type="button" class="btn btn-info btn-lg btn-block" onclick="javascript:editpassword('<?php echo U("User/editpassword");?>',0);">修改登录密码</button>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">请输入新的支付密码</label>
    <input type="password" style="color:#01a9ef;" class="form-control" id="paypassword" name="paypassword"  placeholder="">
  </div>
    <div class="form-group">
  <button type="button" class="btn btn-success btn-lg btn-block" onclick="javascript:editpassword('<?php echo U("User/editpassword");?>',1);">修改支付密码</button>
  </div>
</form>
  </div>
  <div class="tab-pane" id="yinhangka">
  	<div class="form-group loadingclass" style="color: #F32043; text-align: center;">正在努力加载中......</div>
<div class="form-group" style="font-family:'微软雅黑'; color:#000;">
    上次修改时间：<span style="color:#F30;" id="kdatetime"></span><br/>
    上次修改时IP地址：<span style="color:#033;" id="ip"></span><br/>
    上次修改时所在地：<span style="color:#033;" id="ipaddress"></span><br/>
    可修改开始时间：<span style="color:#F30;" id="jdatetime"></span>
</div>
<div class="form-group">
    <label for="websitename">银行名称</label>
    <select class="form-control" id="bankname" name="bankname">
        <?php if(is_array($banklist)): $i = 0; $__LIST__ = $banklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vobank): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vobank["bankname"]); ?>"><?php echo ($vobank["bankname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
</div>
<div class="form-group">
    <label for="tel">支行名称</label>
    <input type="text" class="form-control" id="bankzhiname" name="bankzhiname" placeholder="请输入支行的名称">
</div>

<div class="form-group">
    <label for="tel">银行账号</label>
    <input type="text" class="form-control" id="banknumber" name="banknumber" placeholder="请输入银行账号">
</div>
<div class="form-group">
    <label for="email">开户人姓名</label>
    <input type="text" class="form-control" id="bankfullname" name="bankfullname" placeholder="请输入开户人姓名">
</div>
<div class="form-group">
    <label for="email">开户行所在省</label>
    <input type="text" class="form-control" id="sheng" name="sheng" placeholder="开户行所在省">
</div>
<div class="form-group">
    <label for="email">开户行所在市</label>
    <input type="text" class="form-control" id="shi" name="shi" placeholder="开户行所在市">
</div>
<div class="form-group">
    <button type="button" class="btn btn-info" onclick="javascript:editbankcard('<?php echo U("User/editbankcard");?>')"><span
                class="glyphicon glyphicon-ok"></span> 保存
    </button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-success"
                                             onclick="javascript:suoding('<?php echo U("User/suoding");?>',0)">解除锁定
    </button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger"
                                             onclick="javascript:suoding('<?php echo U("User/suoding");?>',1)">锁定修改
    </button>
</div>
<input type="hidden" id="bankcardid">
<input type="hidden" id="bankcarduserid">
  </div>
  <div class="tab-pane" id="tksz">
     <br>
  <!-------------------------------------------------------------------------------------------------->
  <form  role="form" id="tikuanconfigform" action="<?php echo U("Tikuan/Tikuanconfigedit");?>">
   <input type="hidden" id="tkconfigid" value="<?php echo ($tikuanconfiglist['id']); ?>">
   <input type="hidden" id="tkuserid" name="userid" value="<?php echo ($_REQUEST['userid']); ?>">
    <div class="form-group">
  <label>提款规则设置：</label>
       <select class="form-control" name="systemxz" id="systemxz" style="font-weight:bold; color:#F00;">
           <option <?php if($tikuanconfiglist['systemxz'] == 0): ?>selected<?php endif; ?> value="0">应用系统规则</option>
            <option <?php if($tikuanconfiglist['systemxz'] == 1): ?>selected<?php endif; ?> value="1">设置个人规则</option>
       </select>
      
  </div>
  <div class="form-group tkconfigdiv">
  <label>单笔提款最小金额：</label>
    <div class="input-group">
      <div class="input-group-addon">¥</div>
      <input class="form-control" type="text" name="tkzxmoney" id="tkzxmoney" value="<?php echo ($tikuanconfiglist["tkzxmoney"]); ?>" placeholder="单笔提现最小金额">
    </div>
  </div>
  <div class="form-group tkconfigdiv">
  <label>单笔提款最大金额：</label>
    <div class="input-group">
      <div class="input-group-addon">¥</div>
      <input class="form-control" type="text" name="tkzdmoney" id="tkzdmoney" value="<?php echo ($tikuanconfiglist["tkzdmoney"]); ?>" placeholder="单笔提现最大金额">
    </div>
  </div>
  <div class="form-group tkconfigdiv">
  <label>当日提款最大总金额：</label>
    <div class="input-group">
      <div class="input-group-addon">¥</div>
      <input class="form-control" type="text" name="dayzdmoney" id="dayzdmoney" value="<?php echo ($tikuanconfiglist["dayzdmoney"]); ?>" placeholder="当日提款最大总金额">
    </div>
  </div>
   <div class="form-group tkconfigdiv">
      <label>当日提款最大次数：</label>
      <input class="form-control" type="text" name="dayzdnum" id="dayzdnum" value="<?php echo ($tikuanconfiglist["dayzdnum"]); ?>" placeholder="当日提款最大次数">
  </div>
  <div class="form-group tkconfigdiv">
      <label>是否开通T+1：</label>
       <select class="form-control" name="t1zt" id="t1zt">
       		<option value="1">开通T+1</option>
            <option value="0">关闭T+1</option>
       </select>
     
  </div>
   <div class="form-group tkconfigdiv">
      <label>是否开通T+0：</label>
       <select class="form-control" name="t0zt" id="t0zt">
       		<option value="1">开通T+0</option>
            <option value="0">关闭T+0</option>
       </select>
      
  </div>
   <div class="form-group tkconfigdiv">
  <label>购买T+0金额：</label>
    <div class="input-group">
      <div class="input-group-addon">¥</div>
      <input class="form-control" type="text" name="gmt0" id="gmt0" value="<?php echo ($tikuanconfiglist["gmt0"]); ?>"  placeholder="购买T+0金额">
    </div>
  </div>
  <div class="form-group tkconfigdiv">
      <label>提款手续费类型：</label>
      <select class="form-control" name="tktype" id="tktype">
          <option value="0">按比例计算</option>
          <option value="1">按单笔计算</option>
      </select>
      <script>
          $("#tktype").val('<?php echo ($tikuanconfiglist["tktype"]); ?>');
      </script>
  </div>
  <div class="form-group tkconfigdiv">
      <label>单笔提款比例：</label>
      <div class="input-group">
          <div class="input-group-addon">%</div>
          <input class="form-control" type="text" name="sxfrate" id="sxfrate" value="<?php echo ($tikuanconfiglist["sxfrate"]); ?>"  placeholder="单笔提款比例">
      </div>
  </div>
  <div class="form-group tkconfigdiv">
      <label>单笔提款收取：</label>
      <div class="input-group">
          <div class="input-group-addon">¥</div>
          <input class="form-control" type="text" name="sxffixed" id="sxffixed" value="<?php echo ($tikuanconfiglist["sxffixed"]); ?>"  placeholder="单笔提款收取">
      </div>
  </div>
  <div class="form-group tkconfigdiv">
      <label>提款状态：</label>
       <select class="form-control" name="tkzt" id="tkzt">
       		<option value="1">开启提款</option>
            <option value="0">关闭提款</option>
       </select>
      
  </div>
   <div class="form-group" style="text-align:center;">
  <button type="button" id="tkconfigbutton" class="btn btn-primary">确认修改</button>
  </div>
</form>
  <!-------------------------------------------------------------------------------------------------->
<?php if(is_array($tongdaolist)): $i = 0; $__LIST__ = $tongdaolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!---------------------------------------------------------------------------------------------------------------------->
<div class="Payaccessdiv" style="width:100%; margin-top:10px;" id="tikuanmoney">
<ul class="list-group">
  <li class="list-group-item" style="text-align:center; background-color:#f5f5f5; font-size:13px;">【<span style="color:#39F"><?php echo ($vo["zh_payname"]); ?></span>】<strong>提款手续费设置</strong></li>
  <li class="list-group-item" style="text-align:center;">
     <form role="form" id="form<?php echo ($vo["id"]); ?>" action="<?php echo U("User/Edittikuanmoney");?>">
     <input type="hidden" name="tikuanpayapiid">
     <input type="hidden" name="userid">
    <?php $__FOR_START_612962872__=0;$__FOR_END_612962872__=2;for($i=$__FOR_START_612962872__;$i < $__FOR_END_612962872__;$i+=1){ ?><div class="tikuandiv">
    <a class="list-group-item" style="font-size:13px;"><strong>T+<sapn style="color:#F00"><?php echo ($i); ?></span></strong>&nbsp;&nbsp;(<span>白天</span>)</a>
    <div class="input-group">
      <div class="input-group-addon"><?php echo huoqutktype();?></div>
      <input class="form-control" type="text" onkeyup="clearNoNum(this)" id="t<?php echo ($i); ?>b" name="t<?php echo ($i); ?>b">
    </div>
    </div>

    <div class="tikuandiv">
    <a class="list-group-item" style="font-size:13px;"><strong>T+<sapn style="color:#F00"><?php echo ($i); ?></span></strong>&nbsp;&nbsp;(<span>晚间</span>)</a>
    <div class="input-group">
      <div class="input-group-addon"><?php echo huoqutktype();?></div>
      <input class="form-control" type="text" onkeyup="clearNoNum(this)" id="t<?php echo ($i); ?>w" name="t<?php echo ($i); ?>w">
    </div>
    </div>

    <div class="tikuandiv">
    <a class="list-group-item" style="font-size:13px;"><strong>T+<sapn style="color:#F00"><?php echo ($i); ?></span></strong>&nbsp;&nbsp;(<span>节假日</span>)</a>
    <div class="input-group">
      <div class="input-group-addon"><?php echo huoqutktype();?></div>
      <input class="form-control" type="text" onkeyup="clearNoNum(this)" id="t<?php echo ($i); ?>j" name="t<?php echo ($i); ?>j">
    </div>
    </div><?php } ?>

     </form>
   <div style="clear:left;"></div>
  </li>
  <li class="list-group-item" style="text-align:center;">
  <button type="button" class="btn btn-info tikuan-btn" data-loading-text="正在处理中..." tjname="form<?php echo ($vo["id"]); ?>">修 改</button>
  </li>
</ul>
</div>
<!----------------------------------------------------------------------------------------------------------------------><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
  <div class="tab-pane" id="feilv">
	<div style="width: 100%;">
	<div style="width: 20%; float: left; height: 30px; line-height: 60px; text-align: center;">充值费率</div>
	<div style="width: 20%; float: left; height: 30px; line-height: 60px; text-align: center;">封顶手续费</div>
	<div style="width: 20%; float: left; height: 30px; line-height: 60px; text-align: center;">流量费率</div>
	<div style="width: 40%; float: left;"></div>
</div>
<div style="clear: left;"></div>
<div class="feilvright" style="width: 20%; float: left;">
	<?php if(is_array($tongdaolist)): $i = 0; $__LIST__ = $tongdaolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="text" class="form-control"  style="margin-top: 12px; width: 95%; height: 43.5px; color: #f00;"  placeholder="充值费率" id="feilv<?php echo ($vo["en_payname"]); echo ($vo["id"]); ?>"  onkeyup="clearNoNum(this)"><?php endforeach; endif; else: echo "" ;endif; ?>
</div>

<div class="feilvright" style="width: 20%; float: left;">
	<?php if(is_array($tongdaolist)): $i = 0; $__LIST__ = $tongdaolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="text" class="form-control"  style="margin-top: 12px; width: 95%; height: 43.5px; color:#0044CC;"  placeholder="封顶手续费" id="fengding<?php echo ($vo["en_payname"]); echo ($vo["id"]); ?>"  onkeyup="clearNoNum(this)"><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="feilvright" style="width: 20%; float: left;">
	<?php if(is_array($tongdaolist)): $i = 0; $__LIST__ = $tongdaolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="text" class="form-control"  style="margin-top: 12px; width: 95%; height: 43.5px; color:#0044CC;"  placeholder="流量费率" id="traffic<?php echo ($vo["en_payname"]); echo ($vo["id"]); ?>"  onkeyup="clearNoNum(this)"><?php endforeach; endif; else: echo "" ;endif; ?>
</div>


<div class="feilvleft" style="width: 40%; float: left;">
<?php if(is_array($tongdaolist)): $i = 0; $__LIST__ = $tongdaolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><button type="button" class="btn btn-primary btn-lg" style="margin-left: 10px; margin-top: 10px; width: 90%;" id="feilvbuttton<?php echo ($vo["en_payname"]); echo ($vo["id"]); ?>" ajaxurl="<?php echo U("User/editfeilv");?>" inputid="feilv<?php echo ($vo["en_payname"]); echo ($vo["id"]); ?>"  fengdingid="fengding<?php echo ($vo["en_payname"]); echo ($vo["id"]); ?>" trafficid="traffic<?php echo ($vo["en_payname"]); echo ($vo["id"]); ?>" payapiid="<?php echo ($vo["id"]); ?>">[<?php echo ($vo["en_payname"]); ?>确认修改]
	</button><?php endforeach; endif; else: echo "" ;endif; ?>
</div>

<div style="clear: left;"></div>
<input type="hidden" id="feilvuserid" ajaxurl="<?php echo U("User/edittongdao");?>">

  </div>
  <div class="tab-pane" id="tongdao" style="text-align: center;">
  	<div class="tongdaoleft" style="width: 40%; float: left;">
<?php if(is_array($tongdaolist)): $i = 0; $__LIST__ = $tongdaolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><button type="button" class="btn btn-default btn-lg" style="margin-left: 10px; margin-top: 10px; width: 90%;" id="<?php echo ($vo["en_payname"]); ?>" disabled="disabled"><?php echo ($vo["zh_payname"]); ?> <span></span>
	</button><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="tongdaoright" style="width: 60%; float: left;">
	<?php if(is_array($tongdaolist)): $i = 0; $__LIST__ = $tongdaolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><select name="" style="margin-left: 10px; margin-top: 12px; width: 90%; font-size: 30px; color: #f00;" id="<?php echo ($vo["en_payname"]); echo ($vo["id"]); ?>" onchange="javascript:editdefaultpayapiuser(this,<?php echo ($vo["id"]); ?>)" ajaxurl="<?php echo U("User/editdefaultpayapiuser");?>">
		<option value="" style="color:#0D4C9A;">请选择<?php echo ($vo["zh_payname"]); ?>账号</option>
		<?php echo payapiaccount($vo['id']);?>
	</select><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div style="clear: left;"></div>
<input type="hidden" id="tongdaouserid" ajaxurl="<?php echo U("User/edittongdao");?>">
  </div>
  <div class="tab-pane" id="accountlist" style="text-align: center;">
  	<div style="width: 100%;">
	<div style="width: 20%; float: left; height: 30px; line-height: 60px; text-align: center;">银行代码</div>
	<div style="width: 40%; float: left; height: 30px; line-height: 60px; text-align: center;">账户</div>
	<div style="width: 20%; float: left; height: 30px; line-height: 60px; text-align: center;">启用/禁用</div>
	<div style="width: 20%; float: left;"></div>
</div>
<div style="clear: left;"></div>
<div class="feilvright" style="width: 20%; float: left;" id="bankcode">
<div>
<input type="text" class="form-control"  style="margin-top: 12px; width: 95%; height: 43.5px; color: #f00;"  placeholder="银行代码" id="feilv<?php echo ($vo["bankcode"]); echo ($vo["id"]); ?>"  onkeyup="clearNoNum(this)">
</div>
<div>
<input type="text" class="form-control"  style="margin-top: 12px; width: 95%; height: 43.5px; color: #f00;"  placeholder="银行代码" id="feilv<?php echo ($vo["bankcode"]); echo ($vo["id"]); ?>"  onkeyup="clearNoNum(this)">

</div>
</div>

<div class="feilvright" style="width: 40%; float: left;" id="account">
<input type="text" class="form-control"  style="margin-top: 12px; width: 95%; height: 43.5px; color:#0044CC;"  placeholder="账户" id="fengding<?php echo ($vo["accountid"]); echo ($vo["id"]); ?>"  onkeyup="clearNoNum(this)">
<input type="text" class="form-control"  style="margin-top: 12px; width: 95%; height: 43.5px; color:#0044CC;"  placeholder="账户" id="fengding<?php echo ($vo["accountid"]); echo ($vo["id"]); ?>"  onkeyup="clearNoNum(this)">
</div>

<div class="feilvright" style="width: 20%; float: left;" id="radiox">
<div>
<input type="radio"  style="margin-top:30px;" id="enable<?php echo ($vo["accountid"]); echo ($vo["id"]); ?>"  name="enable">启用
<input type="radio"   style="margin-top:30px;" id="enable<?php echo ($vo["accountid"]); echo ($vo["id"]); ?>"  name="enable">禁用
</div>
<div>
<input type="radio"  style="margin-top:30px;" id="enable<?php echo ($vo["accountid"]); echo ($vo["id"]); ?>"  name="enable">启用
<input type="radio"   style="margin-top:30px;" id="enable<?php echo ($vo["accountid"]); echo ($vo["id"]); ?>"  name="enable">禁用
</div>
</div>

<div class="feilvleft" style="width: 20%; float: left;" id="ismodify">
	<button type="button" class="btn btn-primary" style="margin-left: 2px; margin-top: 10px; width: 80%;" id="feilvbuttton<?php echo ($vo["accountid"]); echo ($vo["id"]); ?>" ajaxurl="<?php echo U("User/editacclist");?>" inputid="feilv<?php echo ($vo["bankcode"]); echo ($vo["id"]); ?>"  fengdingid="fengding<?php echo ($vo["accountid"]); echo ($vo["id"]); ?>" payapiid="<?php echo ($vo["id"]); ?>">确认修改
	</button>
	
	<button type="button" class="btn btn-primary" style="margin-left: 2px; margin-top: 10px; width: 80%;" id="feilvbuttton<?php echo ($vo["accountid"]); echo ($vo["id"]); ?>" ajaxurl="<?php echo U("User/editacclist");?>" inputid="feilv<?php echo ($vo["bankcode"]); echo ($vo["id"]); ?>"  fengdingid="fengding<?php echo ($vo["accountid"]); echo ($vo["id"]); ?>" payapiid="<?php echo ($vo["id"]); ?>">确认修改
	</button>
</div>

<div style="clear: left;"></div>
<input type="hidden" id="feilvuserid" ajaxurl="<?php echo U("User/edittongdao");?>">

  </div>
</div>
  <!--------------------------------------------------------------------------------------------------->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default modalgb" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>

  <script>
      function delUser(id){
          var state = confirm("确定要删除嘛？");
          if(!state){
              return false;
          }
          $.ajax({
              type:'POST',
              url:"<?php echo U('Admin/User/deluser');?>",
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
          $.post("<?php echo U('Admin/User/batchdel');?>",'ids='+idstr,function(str){
              if(str=='ok'){
                  alert('批量删除成功!');
              }else{
                  alert('批量删除失败！');
              }
              location.reload();
          });
    });
    $('#export').on('click',function(){
        $('#selectedform').attr('action',"<?php echo U('Admin/User/exportuser');?>");
        $('#selectedform').submit();
    });
  </script>
  <?php echo tongji(0);?>
</body>
</html>