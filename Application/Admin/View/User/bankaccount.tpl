<div style="width: 100%;">
	<div style="width: 20%; float: left; height: 30px; line-height: 60px; text-align: center;">银行代码</div>
	<div style="width: 40%; float: left; height: 30px; line-height: 60px; text-align: center;">账户</div>
	<div style="width: 20%; float: left; height: 30px; line-height: 60px; text-align: center;">启用/禁用</div>
	<div style="width: 20%; float: left;"></div>
</div>
<div style="clear: left;"></div>
<div class="feilvright" style="width: 20%; float: left;" id="bankcode">
<div>
<input type="text" class="form-control"  style="margin-top: 12px; width: 95%; height: 43.5px; color: #f00;"  placeholder="银行代码" id="feilv<{$vo["bankcode"]}><{$vo["id"]}>"  onkeyup="clearNoNum(this)">
</div>
<div>
<input type="text" class="form-control"  style="margin-top: 12px; width: 95%; height: 43.5px; color: #f00;"  placeholder="银行代码" id="feilv<{$vo["bankcode"]}><{$vo["id"]}>"  onkeyup="clearNoNum(this)">

</div>
</div>

<div class="feilvright" style="width: 40%; float: left;" id="account">
<input type="text" class="form-control"  style="margin-top: 12px; width: 95%; height: 43.5px; color:#0044CC;"  placeholder="账户" id="fengding<{$vo["accountid"]}><{$vo["id"]}>"  onkeyup="clearNoNum(this)">
<input type="text" class="form-control"  style="margin-top: 12px; width: 95%; height: 43.5px; color:#0044CC;"  placeholder="账户" id="fengding<{$vo["accountid"]}><{$vo["id"]}>"  onkeyup="clearNoNum(this)">
</div>

<div class="feilvright" style="width: 20%; float: left;" id="radiox">
<div>
<input type="radio"  style="margin-top:30px;" id="enable<{$vo["accountid"]}><{$vo["id"]}>"  name="enable">启用
<input type="radio"   style="margin-top:30px;" id="enable<{$vo["accountid"]}><{$vo["id"]}>"  name="enable">禁用
</div>
<div>
<input type="radio"  style="margin-top:30px;" id="enable<{$vo["accountid"]}><{$vo["id"]}>"  name="enable">启用
<input type="radio"   style="margin-top:30px;" id="enable<{$vo["accountid"]}><{$vo["id"]}>"  name="enable">禁用
</div>
</div>

<div class="feilvleft" style="width: 20%; float: left;" id="ismodify">
	<button type="button" class="btn btn-primary" style="margin-left: 2px; margin-top: 10px; width: 80%;" id="feilvbuttton<{$vo["accountid"]}><{$vo["id"]}>" ajaxurl="<{:U("User/editacclist")}>" inputid="feilv<{$vo["bankcode"]}><{$vo["id"]}>"  fengdingid="fengding<{$vo["accountid"]}><{$vo["id"]}>" payapiid="<{$vo["id"]}>">确认修改
	</button>
	
	<button type="button" class="btn btn-primary" style="margin-left: 2px; margin-top: 10px; width: 80%;" id="feilvbuttton<{$vo["accountid"]}><{$vo["id"]}>" ajaxurl="<{:U("User/editacclist")}>" inputid="feilv<{$vo["bankcode"]}><{$vo["id"]}>"  fengdingid="fengding<{$vo["accountid"]}><{$vo["id"]}>" payapiid="<{$vo["id"]}>">确认修改
	</button>
</div>

<div style="clear: left;"></div>
<input type="hidden" id="feilvuserid" ajaxurl="<{:U("User/edittongdao")}>">
