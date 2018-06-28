<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title><{:C("WEB_TITLE")}></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="/Public/Front/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/Front/css/font-awesome.min.css" rel="stylesheet">
  <link href="/Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
  <link href="/Public/Front/js/plugins/layui/css/layui.css" rel="stylesheet">
  <link href="/Public/Admin/css/Payaccesscss.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/js.js"></script>
<script type="text/javascript" src="/Public/Admin/js/payaccessjs.js"></script>
</head>
 <body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
  <div class="col-sm-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>通道管理</h5>
      </div>
      <div class="ibox-content">
        <div id="PayaccessContent">
          <input type="hidden" id="urlstr" value="<{:U("Payaccess/startusing")}>">
          <div class="Payaccessdiv col-sm-4 <{$Default.id|payaccessdefault=###,0}>">
            <ul class="list-group">
              <li class="list-group-item">【<strong><{$Default.zh_payname}></strong>(<span style="color: #F50F13"><{$Default.en_payname}></span>)】

                <button type="button" class="btn btn-info btn-sm default_sz" id="btnDefault_<{$Default.id}>" onclick="javascript:szdefault(this,<{$Default.id}>,0)" urlstr="<{:U("Payaccess/Szdefault")}>"<{$Default.id|payaccessdefaultbutton=###,0}></button>

              </li>
              <li class="list-group-item" style="text-align:center;"><img style="width:180px; height: 60px;" src="/Public/<{$Public}>/images/payaccess/<{$Default.en_payname}>.jpg"></li>
              <li class="list-group-item" style="text-align:center; background-color:<{$Default['id']|payaccessdisabledbg=###,0}>">
                <button type="button" class="btn btn-success btn-sm" id="qiyong<{$Default.id}>"  data-loading-text="正在启用..."  <{$Default['id']|payaccessdisabled=###,0,0}> onclick="javascript:startusing('<{$Default.id}>',0,'<{$Default.zh_payname}>',this)"><span class="glyphicon glyphicon-ok"></span> 启用</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-warning btn-sm tingyong<{$Default.id}>"  data-loading-text="正在启用..." <{$Default['id']|payaccessdisabled=###,0}>   onclick="javascript:shutoff('<{$Default.id}>',0,'<{$Default.zh_payname}>',this)"><span class="glyphicon glyphicon-remove"></span> 停用</button>
              </li>
              <li class="list-group-item" style="text-align:center;">
                <button type="button" class="btn btn-info btn-sm tingyong<{$Default.id}>" onclick="javascript:shezhi(this,<{$Default.id}>,0);" <{$Default['id']|payaccessdisabled=###,0}>><span class="glyphicon glyphicon-cog"></span> 设置</button>&nbsp;&nbsp;
                <button type="button" class="btn btn-info btn-sm tingyong<{$Default.id}>" onclick="javascript:tikuanmoney(this,<{$Default.id}>,0);" <{$Default['id']|payaccessdisabled=###,0}>><span class="glyphicon glyphicon-tasks"></span> 提现</button>&nbsp;&nbsp;
                <button type="button" class="btn btn-info btn-sm tingyong<{$Default.id}>" onclick="javascript:yinhang(this,<{$Default.id}>,0);" <{$Default['id']|payaccessdisabled=###,0}>><span class="glyphicon glyphicon-credit-card"></span> 银行</button>&nbsp;&nbsp;
                <button type="button" class="btn btn-warning btn-sm  fanhui" id="fanhui<{$Default.id}>" onclick="javascript:fanhui();" style="display:none;">返 回</button>
              </li>
            </ul>
          </div>
          <!--系统通道循环开始-->

          <volist name="list" id="vo">
            <div class="Payaccessdiv col-sm-4 <{$vo.id|payaccessdefault=###,0}>">
              <ul class="list-group">
                <li class="list-group-item" style="text-align:center; font-size:13px;">【<strong><{$vo.zh_payname}></strong>(<span style="color: #F50F13"><{$vo.en_payname}></span>)】
                  <button type="button" class="btn btn-info btn-sm default_sz" id="btnDefault_<{$vo.id}>" onclick="javascript:szdefault(this,<{$vo.id}>,0)" urlstr="<{:U("Payaccess/Szdefault")}>"<{$vo.id|payaccessdefaultbutton=###,0}></button>

                </li>
                <li class="list-group-item" style="text-align:center;"><img style="width:180px; height:60px;" src="/Public/<{$Public}>/images/payaccess/<{$vo.en_payname}>.jpg"></li>
                <li class="list-group-item" style="text-align:center; background-color:<{$vo['id']|payaccessdisabledbg=###,0}>">
                  <button type="button" class="btn btn-success btn-sm" id="qiyong<{$vo.id}>"  data-loading-text="正在启用..."  <{$vo['id']|payaccessdisabled=###,0,0}> onclick="javascript:startusing('<{$vo.id}>',0,'<{$vo.zh_payname}>',this)"><span class="glyphicon glyphicon-ok"></span> 启用</button>&nbsp;&nbsp;&nbsp;&nbsp;
                  <button type="button" class="btn btn-warning btn-sm tingyong<{$vo.id}>"  data-loading-text="正在启用..." <{$vo['id']|payaccessdisabled=###,0}>   onclick="javascript:shutoff('<{$vo.id}>',0,'<{$vo.zh_payname}>',this)"><span class="glyphicon glyphicon-remove"></span> 停用</button>
                </li>
                <li class="list-group-item" style="text-align:center;">
                  <button type="button" class="btn btn-info btn-sm tingyong<{$vo.id}>" onclick="javascript:shezhi(this,<{$vo.id}>,0);" <{$vo['id']|payaccessdisabled=###,0}>><span class="glyphicon glyphicon-cog"></span> 设置</button>&nbsp;&nbsp;
                  <button type="button" class="btn btn-info btn-sm tingyong<{$vo.id}>" onclick="javascript:tikuanmoney(this,<{$vo.id}>,0);" <{$vo['id']|payaccessdisabled=###,0}>><span class="glyphicon glyphicon-tasks"></span> 提现</button>&nbsp;&nbsp;
                  <button type="button" class="btn btn-info btn-sm tingyong<{$vo.id}>" onclick="javascript:yinhang(this,<{$vo.id}>,0);" <{$vo['id']|payaccessdisabled=###,0}>><span class="glyphicon glyphicon-credit-card"></span> 银行</button>&nbsp;&nbsp;
                  <button type="button" class="btn btn-warning btn-sm  fanhui" id="fanhui<{$vo.id}>" onclick="javascript:fanhui();" style="display:none;">返 回</button>
                </li>
              </ul>
            </div>
          </volist>

          <div class="Payaccessdiv" style="width:500px; display:none; margin-left:0px;" id="zhmysz">
            <ul class="list-group">

              <li class="list-group-item" style="text-align:center;">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab"></ul>
                <!-- Tab panes -->
                <div class="tab-content" id="mytabcontent"></div>
              </li>
            </ul>
          </div>
          <div id="payform" style="display:none;">
            <br>
            <!------------------------------------------------------------------------------------------------------->
            <form class="form-horizontal" role="form" id="form1" action="<{:U("Payaccess/Editpayaccess")}>" loadurl="<{:U("Payaccess/Loadpayaccess")}>" loadtab="<{:U("Payaccess/Loadpaytab")}>" addtab="<{:U("Payaccess/Addpaytab")}>">
              <input type="hidden" name="id" value="">
              <div class="form-group">
                <label class="col-sm-3 control-label">商户号(MCHID)</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="sid" placeholder="商户号">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">证书密钥</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="key" placeholder="MD5KEY 或 RSA KEY">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">APPID</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="account" placeholder="微信APPID或账号">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">APPSECRET</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="keykey" placeholder="公众号APPSECRET">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">网关地址</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="domain" placeholder="网关地址">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">页面返回</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="pagereturn" placeholder="页面返回通知地址">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">服务器返回</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="serverreturn" placeholder="服务器异步通知地址">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">运营费率</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="defaultrate" placeholder="给下家的费率" onkeyup="clearNoNum(this)">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">封顶手续费</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="fengding" placeholder="封顶手续费" onkeyup="clearNoNum(this)">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">成本费率</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control"  name="rate" placeholder="通道给你的费率" onkeyup="clearNoNum(this)">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">防封域名</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control"  name="unlockdomain" placeholder="防封域名">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" style="color: #f00;">上次修改</label>
                <div class="col-sm-4"><label name="updatetime"></label></div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" style="color: #f00;">默认账号</label>
                <div class="col-sm-2">
                  <input type="checkbox" class="form-control" name="defaultpayapiuser" id="defaultpayapiuser"  value="1">
                </div>
              </div>

              <div class="form-group">
                <button type="button" class="btn btn-info loading-example-btn" data-loading-text="正在处理中..." >修 改</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-warning" onclick="javascript:fanhui();">返 回</button>
              </div>
            </form>
            <!------------------------------------------------------------------------------------------------------->
          </div>
          <!---------------------------------------------------------------------------------------------------------------------->
          <div class="Payaccessdiv" style="width:700px; display:none; margin-left:0px;" id="yhsz">
            <ul class="list-group">
              <li class="list-group-item" style="text-align:center; background-color:#f5f5f5; font-size:13px;"><strong>通道银行设置</strong></li>
              <li class="list-group-item" style="text-align:center;">
                <form role="form" id="form2" action="<{:U("Payaccess/Editpayapibank")}>" loadurl="<{:U("Payaccess/Loadpayapibank")}>">
                  <input type="hidden" id="payapiid" name="payapiid">
                  <input type="hidden" id="websiteid" name="websiteid">
                  <input type="hidden" id="en_payname" name="en_payname">
                  <volist name="listbank" id="bank">
                    <div class="bankdiv">
                      <a class="list-group-item" style="font-size:12px;"><strong><{$bank.bankname}></strong></a>
                      <img src="/Uploads/bankimg/<{$bank.images}>">
                      <input type="text" class="form-control" id="<{$bank.bankcode}>" name="<{$bank.bankcode}>" placeholder="银行编码">
                      <select  class="form-control" id="default-<{$bank.bankcode}>" name="<{$bank.bankcode}>" style="display:none;">
                        <option value="" style="color:#F00">不选</option>
                        <volist name="list" id="vo">
                          <option value="<{$vo.id}>"><{$vo.zh_payname}></option>
                        </volist>
                      </select>
                    </div>
                  </volist>
                </form>
                <div style="clear:left;"></div>
              </li>
              <li class="list-group-item" style="text-align:center;">
                <button type="button" class="btn btn-info" data-loading-text="正在处理中..." id="loading-yinghang-btn">修 改</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-warning" onclick="javascript:fanhui();">返 回</button>
              </li>
            </ul>
          </div>
          <!---------------------------------------------------------------------------------------------------------------------->
          <!---------------------------------------------------------------------------------------------------------------------->
          <div class="Payaccessdiv" style="width:700px; display:none; margin-left:0px;" id="tikuanmoney">
            <ul class="list-group">
              <li class="list-group-item" style="text-align:center; background-color:#f5f5f5; font-size:13px;"><strong>提款手续费设置</strong></li>
              <li class="list-group-item" style="text-align:center;">
                <form role="form" id="form3" action="<{:U("Payaccess/Edittikuanmoney")}>" loadurl="<{:U("Payaccess/tikuanmoney")}>">
                  <input type="hidden" id="tikuanpayapiid" name="tikuanpayapiid">
                  <input type="hidden" id="tikuanwebsiteid" name="tikuanwebsiteid">

                  <for start="0" end="2">

                    <div class="tikuandiv">
                      <a class="list-group-item" style="font-size:13px;"><strong>T+<sapn style="color:#F00"><{$i}></span></strong>&nbsp;&nbsp;(<span>白天</span>)</a>
                      <div class="input-group">
                        <div class="input-group-addon"><{:huoqutktype()}></div>
                        <input class="form-control" type="text" onkeyup="clearNoNum(this)" id="t<{$i}>b" name="t<{$i}>b">
                      </div>
                    </div>

                    <div class="tikuandiv">
                      <a class="list-group-item" style="font-size:13px;"><strong>T+<sapn style="color:#F00"><{$i}></span></strong>&nbsp;&nbsp;(<span>晚间</span>)</a>
                      <div class="input-group">
                        <div class="input-group-addon"><{:huoqutktype()}></div>
                        <input class="form-control" type="text" onkeyup="clearNoNum(this)" id="t<{$i}>w" name="t<{$i}>w">
                      </div>
                    </div>

                    <div class="tikuandiv">
                      <a class="list-group-item" style="font-size:13px;"><strong>T+<sapn style="color:#F00"><{$i}></span></strong>&nbsp;&nbsp;(<span>节假日</span>)</a>
                      <div class="input-group">
                        <div class="input-group-addon"><{:huoqutktype()}></div>
                        <input class="form-control" type="text" onkeyup="clearNoNum(this)" id="t<{$i}>j" name="t<{$i}>j">
                      </div>
                    </div>

                  </for>

                </form>
                <div style="clear:left;"></div>
              </li>
              <li class="list-group-item" style="text-align:center;">
                <button type="button" class="btn btn-info" data-loading-text="正在处理中..." id="loading-tikuan-btn">修 改</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-warning" onclick="javascript:fanhui();">返 回</button>
              </li>
            </ul>
          </div>

        </div>
      </div>
  </div>
  </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-describedby="tscontent">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-volume-up"></span></h4>
      </div>
      <div class="modal-body" id="tscontent">

      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="okbutton" style="display:none;">确认</button>&nbsp;&nbsp;&nbsp;&nbsp;
      <button type="button" class="btn btn-default" data-dismiss="modal">
        关闭
        </button>

      </div>
    </div>
  </div>
</div>
<{:tongji(0)}>
</body>
</html>
