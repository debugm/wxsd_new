<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<{$siteurl}>Public/css/bootstrap.min.css">
<css href="<{$siteurl}>Public/css/datepicker.css" />
<link href="<{$siteurl}>Public/__MODULE__/css/css.css" rel="stylesheet" type="text/css" />
<link href="<{$siteurl}>Public/__MODULE__/css/tongdao.css" rel="stylesheet" type="text/css" />
<css href="<{$siteurl}>Public/css/jquery.alerts.css" />
<js href="<{$siteurl}>Public/js/jquery.js" />
<js href="<{$siteurl}>Public/js/bootstrap.min.js" />
<js href="<{$siteurl}>Public/__MODULE__/js/tongdao.js" />
<js href="<{$siteurl}>Public/js/jquery.alerts.js" />
</head>

<body>
<ol class="breadcrumb">
  <li class="active">管理后台</li>
  <li class="active">通道管理</li>
  <li class="active">充值手续费</li>
</ol>
<input type="hidden" id="defaultpayapi" value="<{$defaultpayapi}>">
<input type="hidden" id="ajaxurl" value="<{:U("Tongdao/editwdtongdao")}>">
<div id="tongdaoczsxfcontent">
	<volist name="tongdaosxf" id="vo">
    <div>
    <button class="btn btn-primary buttontongdao" id="<{$vo.en_payname}>"><{$vo.zh_payname}> </button>
    </div>
    <div>费率：<span><{:realityfeilv($vo["id"],$vo["userid"],$vo["feilv"],$vo["defaultpayapiuserid"])}></span></div>
    <div>封顶手续费：<span><{:realityfengding($vo["id"],$vo["userid"],$vo["fengding"],$vo["defaultpayapiuserid"])}></span>元</div>
    </volist>
</div>
<{:tongji(0)}>
</body>
</html>
