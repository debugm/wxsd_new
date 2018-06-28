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
  <li class="active"><a href="#jbxx" role="tab" data-toggle="tab" ajaxurl="<{:U("User/jbxx")}>">基本信息</a></li>
  <li><a href="#zhuangtai" role="tab" data-toggle="tab" ajaxurl="<{:U("User/zhuangtai")}>">状态</a></li>
  <li><a href="#rzxx" role="tab" data-toggle="tab" ajaxurl="<{:U("User/renzheng")}>">认证</a></li>
  <li><a href="#mima" role="tab" data-toggle="tab" ajaxurl="<{:U("User/password")}>">密码</a></li>
  <li><a href="#yinhangka" role="tab" data-toggle="tab" ajaxurl="<{:U("User/bankcard")}>">银行卡</a></li>
  <li><a href="#tksz" role="tab" data-toggle="tab" ajaxurl="<{:U("User/tksz")}>">提款设置</a></li>
  <li><a href="#feilv" role="tab" data-toggle="tab" ajaxurl="<{:U("User/feilv")}>">费率</a></li>
  <li><a href="#tongdao" role="tab" data-toggle="tab" ajaxurl="<{:U("User/tongdao")}>">通道</a></li>
  <li><a href="#accountlist" role="tab" data-toggle="tab" ajaxurl="<{:U("User/acclist")}>">通道账户列表</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="jbxx">
     <include file="jbxxedit" />
  </div>
  <div class="tab-pane" id="zhuangtai" style="text-align: center;">
  	 <include file="zhuangtai" />
  </div>
  <div class="tab-pane" id="rzxx" style="text-align: center;">
  	<include file="renzheng" />
  </div>
  <div class="tab-pane" id="mima">
  	<include file="password" />
  </div>
  <div class="tab-pane" id="yinhangka">
  	<include file="bankcard" />
  </div>
  <div class="tab-pane" id="tksz">
    <include file="tksz" />
  </div>
  <div class="tab-pane" id="feilv">
	<include file="feilv" />
  </div>
  <div class="tab-pane" id="tongdao" style="text-align: center;">
  	<include file="tongdao" />
  </div>
  <div class="tab-pane" id="accountlist" style="text-align: center;">
  	<include file="bankaccount" />
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
