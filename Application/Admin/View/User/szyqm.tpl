<div id="szyqm" style="width:580px; height:600px; display:none;">
  <div class="panel panel-primary">
    <div class="panel-heading">邀请码设置<span class="close" aria-hidden="true" onclick="javascript:$('#szyqm').hide(); $('#yqmsz').button('reset'); $('.pagination').show();">&times;</span></div>
    <div class="panel-body"> 
      <!-------------------------------------------------------------------------->
      <div style="width:100%; margin:0px auto;">
        <form class="form-inline" role="form" id="inviteconfig" ajaxurl="<{:U("ajaxinviteconfig")}>">
          <div class="form-group">
            <input type="hidden" id="inviteconfigid">
            <label class="control-label">状态：</label>
          </div>
          <div class="form-group">
            <select class="form-control" id="invitezt">
              <option value="1">正常</option>
              <option value="0">关闭</option>
            </select>
          </div>
          <div style="clear:left;"></div>
          <div class="form-group" style="margin-top:10px; display: none">
            <label>分站管理员指标：</label>
          </div>
          <div class="form-group" style="margin-top:10px;display: none"> 可生成
            <input type="text" class="form-control" id="invitetype2number" style="width:100px;" onkeyup="javascript:clearNoNum(this);">
            个邀请码，
            <select class="form-control" id="invitetype2ff">
              <option value="1">可分配给下级</option>
              <option value="0">不可分配给下级</option>
            </select>
          </div>
          <div style="clear:left;"></div>
          <div class="form-group" style="margin-top:10px;display: none">
            <label class="control-label">独立代理商指标：</label>
          </div>
          <div class="form-group" style="margin-top:10px;display: none"> 可生成
            <input type="text" class="form-control" id="invitetype6number" onkeyup="javascript:clearNoNum(this);">
            个邀请码，
            <select class="form-control" id="invitetype6ff">
              <option value="1">可分配给下级</option>
              <option value="0">不可分配给下级</option>
            </select>
          </div>

          <div style="clear:left;"></div>
          <div class="form-group" style="margin-top:10px;">
            <label class="control-label">普通代理商指标：</label>
          </div>
          <div class="form-group" style="margin:20px 0;"> 可生成
            <input type="text" class="form-control" id="invitetype5number" onkeyup="javascript:clearNoNum(this);">
            个邀请码，
            <select class="form-control" id="invitetype5ff">
              <option value="1">可分配给下级</option>
              <option value="0">不可分配给下级</option>
            </select>
          </div>
        </form>
      </div>
      <div style="clear:left;"></div>
      <div class="form-group" style="margin-top:20px; text-align:center;">
        <button type="button" class="btn btn-primary" data-loading-text="正在处理中..." id="invitebc" ajaxurl="<{:U("invitebc")}>"><strong>保 存</strong> </button>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-info" onclick="javascript:$('#szyqm').hide(); $('#yqmsz').button('reset'); $('#yqmtj').button('reset');  $('.pagination').show();"><strong>关 闭</strong> </button>
      </div>
      <!--------------------------------------------------------------------------> 
    </div>
  </div>
</div>