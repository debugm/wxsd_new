<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="nav-close"><i class="fa fa-times-circle"></i> </div>
  <div class="sidebar-collapse">
    <ul class="nav" id="side-menu">
      <li class="nav-header">
        <div class="dropdown profile-element"> <span>ID:<{$Think.session.shid}></span><a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span class="clear"> <span class="block m-t-xs"><strong class="font-bold"><{$Think.session.username}></strong></span> <span class="text-muted text-xs block">
          <if condition="$rzstatus == 0"> <span>未认证</span>
          <else />
          <span>认证用户</span> </if>
          <b class="caret"></b></span> </span> </a>
          <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <li><a class="J_menuItem" href="<{:U("Account/loginpassword")}>">修改密码</a> </li>
            <li class="divider"></li>
            <li><a href="<{:U("Index/quit")}>">安全退出</a> </li>
          </ul>
        </div>
        <div class="logo-element">展开 </div>
      </li>
      <li> <a href="#"> <i class="fa fa-home"></i> <span class="nav-label">主页</span> <span class="fa arrow"></span> </a>
        <ul class="nav nav-second-level">
          <li> <a class="J_menuItem" href="<{:U("Index/gonggao")}>">通知公告</a> </li>
        </ul>
      </li>
            </eq>
	  
	  
    </ul>
  </div>
</nav>
