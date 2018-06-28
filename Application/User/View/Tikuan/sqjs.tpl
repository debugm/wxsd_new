<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<{$siteurl}>Public/Front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<{$siteurl}>Public/Front/css/font-awesome.css" rel="stylesheet">
    <link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
    <link href="<{$siteurl}>Public/Front/css/style.css" rel="stylesheet">
    <link href="<{$siteurl}>Public/css/jquery.alerts.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>申请结算</h5>
                </div>
                <div class="ibox-content">
                    <if condition="$tikuanconfiglist.tkzt == 1">
                        <div class="form-group" style="text-align:center; font-size:20px; margin-top:20px;">
                            <input type="hidden" id="tkzxmoney" value="<{:del0($tikuanconfiglist["tkzxmoney"])}>">
                            <input type="hidden" id="tkzdmoney" value="<{:del0($tikuanconfiglist["tkzdmoney"])}>">
                            <input type="hidden" id="dayzdmoney" value="<{:del0($tikuanconfiglist["dayzdmoney"])}>">
                            <input type="hidden" id="dayzdnum" value="<{:del0($tikuanconfiglist["dayzdnum"])}>">
                            <label class="control-label">&nbsp;&nbsp;单笔结算最小金额：<span style="color:#F00;"><{:del0($tikuanconfiglist["tkzxmoney"])}></span> 元，</label>
                            <label class="control-label">&nbsp;&nbsp;单笔结算最大金额：<span style="color:#F00;"><{:del0($tikuanconfiglist["tkzdmoney"])}></span> 元，</label>
                        </div>
                        <div class="form-group" style="text-align:center; font-size:20px;">
                            <label class="control-label">&nbsp;&nbsp;当日结算金额上限：<span style="color:#F00;"><{:del0($tikuanconfiglist["dayzdmoney"])}></span> 元，</label>
                            <label class="control-label">&nbsp;&nbsp;当日结算次数上限：<span style="color:#F00;"><{:del0($tikuanconfiglist["dayzdnum"])}></span> 次，</label>
                        </div>
                        <div class="form-group" style="text-align:center; font-size:20px;">
                            <{$tkdatetime}>
                        </div>
                        <div  style="width:80%; margin:0px auto; height:auto;">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <table class="table table-bordered" style="margin-top:20px;">
                                        <tr>
                                            <td colspan="2" >T + <{$Think.get.t}></td>
                                        </tr>
                                        <tr>
                                            <td >提款通道：</td>
                                            <td>
                                                <input type="hidden" name="t" id="t" value="<{$Think.get.t}>">
                                                <select class="form-control" style="font-weight:bold; color:#003;" id="selecttongdao" ajaxurl="<{:U("Tikuan/tongdaofeilv")}>">
                                                    <option value="">请选择提款通道</option>
                                                    <volist name="apilist" id="vo">
                                                        <option value="<{$vo.id}>"><{$vo.zh_payname}></option>
                                                    </volist>
                                                </select>
                                                <input type="hidden" id="tikuantype" value="<{$tikuantype}>">
                                                <input type="hidden" id="sxfmoney" value="">
                                                <input type="hidden" id="sxftype" value="">
                                                <input type="hidden" id="yuemoney" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" id="tongdaofeilvdiv">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>可用余额：</td>
                                            <td style="font-size:30px; color:#f00; font-weight:bold; vertical-align:middle; text-align:left;" id="yuemoneydiv"></td>
                                        </tr>
                                        <tr>
                                            <td >结算金额(元)：</td>
                                            <td><input type="text" class="form-control" name="jsmoney" id="jsmoney" onkeyup="javascript:clearNoNum(this,2);" style="color:#F00; font-weight:bold;width:150px; float:left;">&nbsp;&nbsp;<button class="btn btn-info" style="margin-left:20px;" id="jssxfbutton">计算手续费</button></td>
                                        </tr>
                                        <tr>
                                            <td >手续费(元)：</td>
                                            <td style="text-align: left;"><input type="text" id="sxfdiv" class="form-control" style="display: none;" name="sxf" readonly value=""></td>
                                        </tr>
                                        <tr>
                                            <td>到账金额(元)：</td>
                                            <td style="text-align: left;"><input type="text" name="realymoney" class="form-control"  style="display: none;" id="dzmoneydiv" readonly value=""></td>
                                        </tr>
                                        <tr>
                                            <td >结算银行：</td>
                                            <td ><{$tkbankname}></td>
                                        </tr>
                                        <tr>
                                            <td >支付密码：</td>
                                            <td><input type="password" class="form-control" name="paypassword" id="paypassword" style="color:#000; font-weight:bold;width:300px;"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align:center; font-size:30px; color:#F00;">
                                                <{$tkbankfullstr}>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <else />
                        <div class="form-group" style="text-align:center; color:#F00;margin-top:20px;">
                            <{$tikuanconfiglist.tkztstr}>
                        </div>
                    </if>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<{$siteurl}>Public/js/jquery.js"></script>
<script src="<{$siteurl}>Public/js/jquery.alerts.js"></script>
<script src="<{$siteurl}>Public/User/js/tikuan.js"></script>
<script src="<{$siteurl}>Public/js/zy.js"></script>
<script src="<{$siteurl}>Public/Front/js/jquery.min.js"></script>
<script src="<{$siteurl}>Public/Front/js/bootstrap.min.js"></script>
<{:tongji(0)}>
</body>
</html>
