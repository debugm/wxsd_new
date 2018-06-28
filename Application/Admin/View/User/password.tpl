  <br>
  <input type="hidden" id="passwordid">
  <form role="form">
  <div class="form-group">
    <label for="exampleInputEmail1">请输入新的登录密码</label>
    <input type="password" style="color:#01a9ef;" class="form-control" id="loginpassword" name="loginpassword"  placeholder="">
  </div>
    <div class="form-group">
  <button type="button" class="btn btn-info btn-lg btn-block" onclick="javascript:editpassword('<{:U("User/editpassword")}>',0);">修改登录密码</button>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">请输入新的支付密码</label>
    <input type="password" style="color:#01a9ef;" class="form-control" id="paypassword" name="paypassword"  placeholder="">
  </div>
    <div class="form-group">
  <button type="button" class="btn btn-success btn-lg btn-block" onclick="javascript:editpassword('<{:U("User/editpassword")}>',1);">修改支付密码</button>
  </div>
</form>