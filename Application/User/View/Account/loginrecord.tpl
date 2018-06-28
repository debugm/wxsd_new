<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<{$siteurl}>Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/font-awesome.css?v=4.4.0" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/animate.css" rel="stylesheet">
<link href="<{$siteurl}>Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
  <div class="row animated fadeInRight">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>登录记录</h5>
          <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="timeline.html#"> <i class="fa fa-wrench"></i> </a>
            
            <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content timeline">
           <volist name="list" id="vo">
          <div class="timeline-item">
            <div class="row">
              <div class="col-xs-3 date"> <i class="fa fa-calendar"></i>  <br>
              </div>
              <div class="col-xs-7">
                <p class="m-b-xs"><{$vo.logindatetime}> / <strong><{$vo.loginaddress}>(<{$vo.loginip}>)</strong> </p>
               
              </div>
            </div>
          </div>
           </volist> 
        </div>
		 <div class="text-center">
                            <div class="btn-group">
                               <{$_page}>
                            </div>
                        </div>
						
      </div>
    </div>
  </div>
</div>
<!-- 全局js -->
<script src="<{$siteurl}>Public/Front/js/jquery.min.js?v=2.1.4"></script>
<script src="<{$siteurl}>Public/Front/js/bootstrap.min.js?v=3.3.6"></script>
<!-- Peity -->
<script src="<{$siteurl}>Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
<!-- 自定义js -->
<script src="<{$siteurl}>Public/Front/js/content.js?v=1.0.0"></script>
<!-- Peity -->
<script src="<{$siteurl}>Public/Front/js/demo/peity-demo.js"></script>
<{:tongji(0)}>
</body>
</html>
