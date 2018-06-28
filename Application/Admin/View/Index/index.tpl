<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title><{$sitename}></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<{$siteurl}>Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
<link href="<{$siteurl}>Public/css/jquery.alerts.css" rel="stylesheet">
<script src="<{$siteurl}>Public/js/jquery.js"></script>
<script src="<{$siteurl}>Public/js/jquery.alerts.js" /></script>
<script src="<{$siteurl}>Public/<{$Think.MODULE_NAME}>/js/js.js"></script>
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
  <!--左侧导航开始-->
  <include file="left-nav" />
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
          <li class="hidden-xs">  <a href="#"><i class="fa fa-user"></i><{$Think.session.admin_username}> </a></li>
		   <li class="hidden-xs"> <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i>修改密码</a> </li>
          <li class="dropdown hidden-xs"> <a  href="<{:U("Index/quit")}>" class="right-sidebar-toggle" aria-expanded="false"> <i class="fa fa-logout"></i> 退出 </a> </li>
        </ul>
      </nav>
    </div>
    <div class="row content-tabs">
      <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i> </button>
      <nav class="page-tabs J_menuTabs">
        <div class="page-tabs-content"> <a href="javascript:;" class="active J_menuTab" data-id="<{:U('Admin/Index/defaultindex')}>">Dashboard</a> </div>
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
     <a href="<{:U("Index/quit")}>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a> </div>
    <div class="row J_mainContent" id="content-main">
      <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<{:U('Admin/Index/defaultindex')}>" frameborder="0" data-id="<{:U('Admin/Index/defaultindex')}>" seamless></iframe>
    </div>
    <div class="footer">
      <div class="pull-right">&copy; 2017 <a href="http://www.zhiyu.cc/" target="_blank"><{:C('SOFT_NAME')}></a> (版本:<{:C('SOFT_VERSION')}>) <{:L("ADMIN_COPYRIGHT")}></div>
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
<!-- 全局js -->
<script src="<{$siteurl}>Public/Front/js/jquery.min.js"></script>
<script src="<{$siteurl}>Public/Front/js/bootstrap.min.js"></script>
<script src="<{$siteurl}>Public/Front/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<{$siteurl}>Public/Front/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<{$siteurl}>Public/Front/js/plugins/layer/layer.min.js"></script>
<!-- 自定义js -->
<script src="<{$siteurl}>Public/Front/js/hplus.js"></script>
<script type="text/javascript" src="<{$siteurl}>Public/Front/js/contabs.js"></script>
<!-- 第三方插件 -->
<script src="<{$siteurl}>Public/Front/js/plugins/pace/pace.min.js"></script>
<script src="<{$siteurl}>Public/Front/js/iNotify.js"></script>
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
            url: "<{:U('Tikuan/checkNotice')}>",
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
<{:tongji(0)}>
</body>
</html>
