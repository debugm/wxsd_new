<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="nav-close"><i class="fa fa-times-circle"></i> </div>
  <div class="sidebar-collapse">
    <ul class="nav" id="side-menu">
      <li class="nav-header">
        <div class="dropdown profile-element"> 
		
		  <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span class="clear"> <span class="block m-t-xs"><strong class="font-bold"><{$Think.session.admin_username}></strong></span>  </a>
        
            <span style="color:#F30">	<switch name="Think.session.admin_usertype">
				    <case value="0">总管理员</case>
				</switch></span> 
				<p><a href="#" data-toggle="modal" data-target="#myModal">改密</a>
				</p>
          
          
        </div>
        <div class="logo-element">MENU </div>
      </li>
	   <li> <a href="<{:C('HOUTAINAME')}>.html"> <i class="fa fa-home"></i> <span class="nav-label">管理首页</span>  </a></li>
      <li> <a href="#"> <i class="fa fa-asterisk"></i> <span class="nav-label">系统设置</span> <span class="fa arrow"></span> </a>
        <ul class="nav nav-second-level">
		    <li> <a href="<{:U("System/jbsz")}>" class="J_menuItem">基本设置</a></li>
            <li> <a href="<{:U("System/emailsz")}>" class="J_menuItem">邮箱设置</a></li>
			<li> <a href="<{:U("Update/update")}>" class="J_menuItem">系统升级</a></li>
        </ul>
      </li>
      <li> <a href="#"> <i class="fa fa-user"></i> <span class="nav-label">用户管理</span> <span class="fa arrow"></span> </a>
        <ul class="nav nav-second-level">
		   <li><a href="<{:U("User/usercontrol")}>" class="J_menuItem"><{:L("ADMIN_YHGL_PUTONGSHANGHU")}></a></li>
		   <li><a href="<{:U("User/zipuploadview")}>" class="J_menuItem">个人码上传</a></li>
        </ul>
      </li>
	    <li> <a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">交易管理</span> <span class="fa arrow"></span> </a>
        <ul class="nav nav-second-level">
			<li><a href="<{:U("Dealmanages/dealrecord")}>" class="J_menuItem">交易记录</a> </li>
			<li><a href="<{:U("Dealmanages/wxord")}>" class="J_menuItem">微信收单交易统计</a> </li>
			<!--<li><a href="<{:U("Dealmanages/wxdiaodan")}>" class="J_menuItem">微信个人码掉单统计</a> </li>-->
 
        </ul>
      </li>
 
	  
	  
    </ul>
  </div>
</nav>
