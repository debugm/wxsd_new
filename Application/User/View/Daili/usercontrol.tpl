<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<{$siteurl}>Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="<{$siteurl}>Public/Front/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
    <link href="<{$siteurl}>Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
    <link href="<{$siteurl}>Public/css/jquery.alerts.css" rel="stylesheet">
    <script src="<{$siteurl}>Public/Front/js/jquery.js"></script>
    <script src="<{$siteurl}>Public/js/bootstrap.min.js"></script>
    <script src="<{$siteurl}>Public/js/bootstrap-datepicker.js"></script>
    <script src="<{$siteurl}>Public/js/jquery.alerts.js"></script>
    <script src="<{$siteurl}>Public/User/js/daili.js"></script>
    <script src="<{$siteurl}>Public/js/zy.js"></script>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">

    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>下属用户列表</h5>
                <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
            </div>
            <div class="ibox-content">
        <div style=" margin:0px auto;">
            <form class="form-inline" role="form">
                <div class="form-group">
                    <input type="text" style="width:200px;" class="form-control" id="usernameidsearch"
                           placeholder="请输入商户号或用户名" value="<{$Think.get.usernameidsearch}>">
                </div>
                <div class="form-group" style="margin-left:20px;">
                    <select class="form-control" id="statussearch" style="width: 100px;">
                        <option value="" style="font-weight:bold;">状态</option>
                        <option value="1">已激活</option>
                        <option value="0">未激活</option>
                        <option value="2">禁用</option>
                    </select>
                    <script type="text/javascript">
                        $("#statussearch").val('<{$Think.get.statussearch}>');
                    </script>
                </div>
                <div class="form-group" style="margin-left:20px;">
                    <select class="form-control" id="rzsearch" style="width: 150px;">
                        <option value="">认证</option>
                        <option value="0">未认证</option>
                        <option value="2">等待审核</option>
                        <option value="1">认证用户</option>
                    </select>
                    <script type="text/javascript">
                        $("#rzsearch").val('<{$Think.get.rzsearch}>');
                    </script>
                </div>

                <div class="form-group" style="margin-left:20px;">
                    <input type="text" style="width:200px;" class="form-control" id="sjusernamesearch"
                           placeholder="请输入上级用户名或商户号" value="<{$Think.get.sjusernamesearch}>">
                </div>
                <button type="button" class="btn btn-primary" style=" margin-left:20px;" id="ptshsearch"><span
                            class="glyphicon glyphicon-search"></span> <strong>搜索</strong></button>
            </form>
        </div>
        <div class="table-responsive" style="margin:0px auto; margin-top:10px;">
            <table class="table table-bordered table-hover table-condensed table-responsive">
                <thead>
                <tr class="titlezhong">
                    <td><strong>用户名</strong></td>
                    <td><strong>商户号</strong></td>
                    <td><strong>用户类型</strong></td>
                    <td><strong>状态</strong></td>
                    <td><strong>认证</strong></td>
                    <td><strong>账户总余额</strong></td>
                    <td><strong>费率</strong></td>
                    <td><strong>注册时间</strong></td>
                    <td><strong>查看</strong></td>

                </tr>
                </thead>
                <tbody>
                <volist name="list" id="vo">
                    <tr>
                        <td style="text-align:center;"><{$vo.username}></td>
                        <td style="text-align:center;"><{$vo['id']|shanghubianhao=###}></td>
                        <td style="text-align:center"><{$vo['usertype']|usertype=###}></td>
                        <td style="text-align:center;"><{$vo["status"]|zhuangtai=###}></td>
                        <td style="text-align:center;"><{$vo['id']|renzheng=###}></td>
                        <td style="text-align:center;"><{$vo['id']|zhanghuzongyue=###}></td>
                        <td style="text-align:center;"><a href="<{:U('Daili/setfeilv',array('uid'=>$vo['id']))}>" style="font-weight:bold;" data-target="#exampleModal" data-toggle="modal">费率</a></td>
                        <td style="text-align:center; color:#369"><strong><{$vo.regdatetime|date='Y-m-d',###}></strong>
                        </td>
                        <td style="text-align:center;"><a href="<{:U('Daili/childord',array('userid'=>$vo['id']))}>">查看</a></td>

                    </tr>
                </volist>
                <tr>
                    <td colspan="14" style="text-align:center;">
                        <div class="pagex"> <{$_page}></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#exampleModal').on("hidden.bs.modal", function() {
            $(this).removeData('bs.modal');
        });
    });
</script>
</body>
</html>
