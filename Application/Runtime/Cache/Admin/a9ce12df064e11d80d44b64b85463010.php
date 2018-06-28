<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title><?php echo ($sitename); ?></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo ($siteurl); ?>Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="<?php echo ($siteurl); ?>Public/Front/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
<link href="<?php echo ($siteurl); ?>Public/Front/css/animate.css" rel="stylesheet">
<link href="<?php echo ($siteurl); ?>Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
<link href="<?php echo ($siteurl); ?>Public/css/jquery.alerts.css" rel="stylesheet">
<script src="<?php echo ($siteurl); ?>Public/js/jquery.js"></script>
<script src="<?php echo ($siteurl); ?>Public/js/jquery.alerts.js" /></script>
<script src="<?php echo ($siteurl); ?>Public/<?php echo (MODULE_NAME); ?>/js/js.js"></script>
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
  <!--左侧导航开始-->
  <nav class="navbar-default navbar-static-side" role="navigation">
  <div class="nav-close"><i class="fa fa-times-circle"></i> </div>
  <div class="sidebar-collapse">
    <ul class="nav" id="side-menu">
      <li class="nav-header">
        <div class="dropdown profile-element"> 
		
		  <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span class="clear"> <span class="block m-t-xs"><strong class="font-bold"><?php echo (session('admin_username')); ?></strong></span>  </a>
        
            <span style="color:#F30">	<?php switch($_SESSION['admin_usertype']): case "0": ?>总管理员<?php break; endswitch;?></span> 
				<p><a href="#" data-toggle="modal" data-target="#myModal">改密</a>
				</p>
          
          
        </div>
        <div class="logo-element">MENU </div>
      </li>
	   <li> <a href="<?php echo C('HOUTAINAME');?>.html"> <i class="fa fa-home"></i> <span class="nav-label">管理首页</span>  </a></li>
      <li> <a href="#"> <i class="fa fa-asterisk"></i> <span class="nav-label">系统设置</span> <span class="fa arrow"></span> </a>
        <ul class="nav nav-second-level">
		    <li> <a href="<?php echo U("System/jbsz");?>" class="J_menuItem">基本设置</a></li>
            <li> <a href="<?php echo U("System/emailsz");?>" class="J_menuItem">邮箱设置</a></li>
			<li> <a href="<?php echo U("Update/update");?>" class="J_menuItem">系统升级</a></li>
        </ul>
      </li>
      <li> <a href="#"> <i class="fa fa-user"></i> <span class="nav-label">用户管理</span> <span class="fa arrow"></span> </a>
        <ul class="nav nav-second-level">
		   <li><a href="<?php echo U("User/usercontrol");?>" class="J_menuItem"><?php echo L("ADMIN_YHGL_PUTONGSHANGHU");?></a></li>
		   <li><a href="<?php echo U("User/zipuploadview");?>" class="J_menuItem">个人码上传</a></li>
        </ul>
      </li>
	    <li> <a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">交易管理</span> <span class="fa arrow"></span> </a>
        <ul class="nav nav-second-level">
			<li><a href="<?php echo U("Dealmanages/dealrecord");?>" class="J_menuItem">交易记录</a> </li>
			<li><a href="<?php echo U("Dealmanages/wxord");?>" class="J_menuItem">微信收单交易统计</a> </li>
			<!--<li><a href="<?php echo U("Dealmanages/wxdiaodan");?>" class="J_menuItem">微信个人码掉单统计</a> </li>-->
 
        </ul>
      </li>
 
	  
	  
    </ul>
  </div>
</nav>

  <!--左侧导航结束-->
  <!--右侧部分开始-->
  <div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
      <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
          <form role="search" class="navbar-form-custom" method="post" action="#">
            <div class="form-group">
              <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
            </div>
          </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
          <li class="hidden-xs">  <a href="/"><i class="fa fa-user"></i> 网站首页 </a></li>
          <li class="hidden-xs">  <a href="#"><i class="fa fa-user"></i><?php echo (session('admin_username')); ?> </a></li>
		   <li class="hidden-xs"> <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i>修改密码</a> </li>
          <li class="dropdown hidden-xs"> <a  href="<?php echo U("Index/quit");?>" class="right-sidebar-toggle" aria-expanded="false"> <i class="fa fa-logout"></i> 退出 </a> </li>
        </ul>
      </nav>
    </div>
    <div class="row content-tabs">
      <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i> </button>
      <nav class="page-tabs J_menuTabs">
        <div class="page-tabs-content"> <a href="javascript:;" class="active J_menuTab" data-id="<?php echo U('Admin/Index/defaultindex');?>">Dashboard</a> </div>
      </nav>
      <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i> </button>
      <div class="btn-group roll-nav roll-right">
        <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span> </button>
        <ul role="menu" class="dropdown-menu dropdown-menu-right">
          <li class="J_tabShowActive"><a>定位当前选项卡</a> </li>
          <li class="divider"></li>
          <li class="J_tabCloseAll"><a>关闭全部选项卡</a> </li>
          <li class="J_tabCloseOther"><a>关闭其他选项卡</a> </li>
        </ul>
      </div>
     <a href="<?php echo U("Index/quit");?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a> </div>
    <div class="row J_mainContent" id="content-main">
      <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo U('Admin/Index/defaultindex');?>" frameborder="0" data-id="<?php echo U('Admin/Index/defaultindex');?>" seamless></iframe>
    </div>
    <div class="footer">
      <div class="pull-right">&copy; 2017 <a href="http://www.zhiyu.cc/" target="_blank"><?php echo C('SOFT_NAME');?></a> (版本:<?php echo C('SOFT_VERSION');?>) <?php echo L("ADMIN_COPYRIGHT");?></div>
    </div>
  </div>
  <!--右侧部分结束-->
 
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
        
          <button type="button" class="btn btn-primary btn-lg btn-block" id="xgpasswordbutton" ajaxurl="<?php echo U("System/Editpassword");?>">修改密码</button>
        </form>
        <!--------------------------------------------------------------------------------->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关 闭</button>
        
      </div>
    </div>
  </div>
</div>
<!-- 全局js -->
<script src="<?php echo ($siteurl); ?>Public/Front/js/jquery.min.js"></script>
<script src="<?php echo ($siteurl); ?>Public/Front/js/bootstrap.min.js"></script>
<script src="<?php echo ($siteurl); ?>Public/Front/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo ($siteurl); ?>Public/Front/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo ($siteurl); ?>Public/Front/js/plugins/layer/layer.min.js"></script>
<!-- 自定义js -->
<script src="<?php echo ($siteurl); ?>Public/Front/js/hplus.js"></script>
<script type="text/javascript" src="<?php echo ($siteurl); ?>Public/Front/js/contabs.js"></script>
<!-- 第三方插件 -->
<script src="<?php echo ($siteurl); ?>Public/Front/js/plugins/pace/pace.min.js"></script>
<script src="<?php echo ($siteurl); ?>Public/Front/js/iNotify.js"></script>
<script>
    var iNotify = new iNotify({
        message: '有消息了。',//标题
        effect: 'flash', // flash | scroll 闪烁还是滚动
        interval: 300,
        audio:{
            //file: ['/Public/sound/msg.mp4','/Public/sound/msg.mp3','/Public/sound/msg.wav']
            file:'http://tts.baidu.com/text2audio?lan=zh&ie=UTF-8&spd=5&text=有客户申请提现啦'
        }
    });
    setInterval(function() {
        $.ajax({
            type: "GET",
            url: "<?php echo U('Tikuan/checkNotice');?>",
            cache: false,
            success: function (res) {
                if (res.num>0) {
                    iNotify.setFavicon(res.num).setTitle('提现通知').notify({
                        title: "新通知",
                        body: "有客户，提现啦..."
                    }).player();
                }
            }
        });
    },10000);
</script>
<?php echo tongji(0);?>
</body>
</html>