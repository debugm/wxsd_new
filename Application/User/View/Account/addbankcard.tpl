<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户银行卡信息</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<{$siteurl}>Public/Front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<{$siteurl}>Public/Front/css/font-awesome.css" rel="stylesheet">
    <link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
    <link href="/Public/Front/js/plugins/layui/css/layui.css" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <form role="form" id="bankcardform" class="form-horizontal" method="post" action="<{:U("Account/addbankcard")}>" autocomplete="off">
                <div class="form-group">
                    <label class="col-sm-2 control-label">所属省市</label>
                    <div data-toggle="distpicker">
                        <label class="radio-inline" style="padding:0 0 0 15px;margin:0;">
                            <select class="form-control" style="width: 200px;" id="sheng" name="sheng"></select>
                        </label>
                        <label class="radio-inline" style="padding:0 0 0 10px;margin:0;">
                            <select class="form-control" style="width: 200px;" id="shi" name="shi"></select>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bankname" class="col-sm-2 control-label">银行名称</label>
                    <div class="col-md-8">
                        <select class="form-control" id="bankname" name="bankname">
                            <option value="">选择开户行</option>
                            <volist name="banklist" id="vobank">
                                <option <if condition="$list['bankname'] eq $vobank['bankname']">selected</if> value="<{$vobank.bankname}>"><{$vobank.bankname}></option>
                            </volist>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tel" class="col-sm-2 control-label">支行名称</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="bankzhiname" name="bankzhiname" value="<{$list.bankzhiname}>" placeholder="请输入支行的名称">
                    </div>
                </div>

                <div class="form-group">
                    <label for="bankfullname" class="col-sm-2 control-label">开户名</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="bankfullname" name="bankfullname" value="<{$list.bankfullname}>" placeholder="请输入开户人姓名">
                    </div>
                </div>
                <div class="form-group">
                    <label for="banknumber" class="col-sm-2 control-label">银行卡号</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="banknumber" name="banknumber" value="<{$list.banknumber}>" placeholder="请输入银行账号">
                    </div>
                </div>
                <div id="insertbank"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <button type="<if condition="$list[disabled]">button<else/>submit</if>" class="btn btn-primary <if condition="$list[disabled]">disabled</if>">提交保存</button>
                </div>
            </form>
            <script src="<{$siteurl}>Public/Front/js/jquery.min.js"></script>
            <script src="<{$siteurl}>Public/Front/js/bootstrap.min.js"></script>
            <script src="<{$siteurl}>Public/Front/js/distpicker.js"></script>
            <script>
                $('[data-toggle="distpicker"]').distpicker({
                    province: "<{$list.sheng}>",
                    city: "<{$list.shi}>"
                });
            </script>
</body>
</html>