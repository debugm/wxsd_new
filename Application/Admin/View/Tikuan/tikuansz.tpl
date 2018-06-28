<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title><{:C("WEB_TITLE")}></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="/Public/Front/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="/Public/Front/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
<link href="/Public/Front/css/style.css?v=4.1.0" rel="stylesheet">
<link href="/Public/css/jquery.alerts.css" rel="stylesheet">
<link href="/Public/Admin/css/tikuansz.css" rel="stylesheet">
    <link href="/Public/Front/js/plugins/layui/css/layui.css" rel="stylesheet">
<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/js/jquery.alerts.js" /></script>
<script type="text/javascript" src="/Public/laydate/laydate.js" /></script>
<script type="text/javascript" src="/Public/Admin/js/js.js"></script>
<script type="text/javascript" src="/Public/Admin/js/tikuansz.js"></script>
</head>
<body>
 <body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
  <div class="col-sm-12">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>提款管理</h5>
          </div>
          <div class="ibox-content">
<div id="tikuanszdiv">
<!------------------------------------------------------------------------->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#tksz" role="tab" data-toggle="tab">基本设置</a></li>
  <li><a href="#tksjsz" role="tab" data-toggle="tab">提款时间设置</a></li>
  <li><a href="#tkjjrsz" role="tab" data-toggle="tab">提款节假日设置</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="tksz" ><br>
  <!-------------------------------------------------------------------------------------------------->
  <form  role="form" id="tikuanconfigform" action="<{:U("Tikuan/Tikuanconfigedit")}>" class="form-horizontal">
   <input type="hidden" id="tkconfigid" name="tkconfigid" value="<{$tikuanconfiglist["id"]}>">
  <div class="form-group">
  <label>单笔提款最小金额：</label>
    <div class="input-group">
      <div class="input-group-addon">¥</div>
      <input class="form-control" type="text" name="tkzxmoney" id="tkzxmoney" value="<{$tikuanconfiglist["tkzxmoney"]}>" placeholder="单笔提现最小金额">
    </div>
  </div>
  <div class="form-group">
  <label>单笔提款最大金额：</label>
    <div class="input-group">
      <div class="input-group-addon">¥</div>
      <input class="form-control" type="text" name="tkzdmoney" id="tkzdmoney" value="<{$tikuanconfiglist["tkzdmoney"]}>" placeholder="单笔提现最大金额">
    </div>
  </div>
  <div class="form-group">
  <label>当日提款最大总金额：</label>
    <div class="input-group">
      <div class="input-group-addon">¥</div>
      <input class="form-control" type="text" name="dayzdmoney" id="dayzdmoney" value="<{$tikuanconfiglist["dayzdmoney"]}>" placeholder="当日提款最大总金额">
    </div>
  </div>
   <div class="form-group">
      <label>当日提款最大次数：</label>
      <input class="form-control" type="text" name="dayzdnum" id="dayzdnum" value="<{$tikuanconfiglist["dayzdnum"]}>" placeholder="当日提款最大次数">
  </div>
  <div class="form-group">
      <label>是否开通T+1：</label>
       <select class="form-control" name="t1zt" id="t1zt">
       		<option value="1">开通T+1</option>
            <option value="0">关闭T+1</option>
       </select>
       <script>
	   $("#t1zt").val('<{$tikuanconfiglist["t1zt"]}>');
	   </script>
  </div>
   <div class="form-group">
      <label>是否开通T+0：</label>
       <select class="form-control" name="t0zt" id="t0zt">
       		<option value="1">开通T+0</option>
            <option value="0">关闭T+0</option>
       </select>
        <script>
	   $("#t0zt").val('<{$tikuanconfiglist["t0zt"]}>');
	   </script>
  </div>
   <div class="form-group">
  <label>购买T+0金额：</label>
    <div class="input-group">
      <div class="input-group-addon">¥</div>
      <input class="form-control" type="text" name="gmt0" id="gmt0" value="<{$tikuanconfiglist["gmt0"]}>"  placeholder="购买T+0金额">
    </div>
  </div>
  <div class="form-group">
      <label>提款手续费类型：</label>
       <select class="form-control" name="tktype" id="tktype">
       		<option value="0">按比例计算</option>
            <option value="1">按单笔计算</option>
       </select>
        <script>
	   $("#tktype").val('<{$tikuanconfiglist["tktype"]}>');
	   </script>
  </div>
  <div class="form-group">
      <label>单笔提款比例：</label>
      <div class="input-group">
          <div class="input-group-addon">%</div>
          <input class="form-control" type="text" name="sxfrate" id="sxfrate" value="<{$tikuanconfiglist["sxfrate"]}>"  placeholder="单笔提款比例">
      </div>
  </div>
  <div class="form-group">
      <label>单笔提款收取：</label>
      <div class="input-group">
          <div class="input-group-addon">¥</div>
          <input class="form-control" type="text" name="sxffixed" id="sxffixed" value="<{$tikuanconfiglist["sxffixed"]}>"  placeholder="单笔提款收取">
      </div>
  </div>
  <div class="form-group">
      <label>提款状态：</label>
       <select class="form-control" name="tkzt" id="tkzt">
       		<option value="1">开启提款</option>
            <option value="0">关闭提款</option>
       </select>
        <script>
	   $("#tkzt").val('<{$tikuanconfiglist["tkzt"]}>');
	   </script>
  </div>
  <button type="button" id="tkconfigbutton" class="btn btn-primary">确认修改</button>
</form>
  <!-------------------------------------------------------------------------------------------------->
  </div>
  <div class="tab-pane" id="tksjsz">
    <!------------------------------------------------------------------------------->
    <form role="form" action="<{:U("Tikuan/tikuanshijianedit")}>" class="form-horizontal">
      <fieldset>
        <div class="form-group">
          <label>白天提款时间</label>
        </div>
        <div class="form-group tksjsz">
          <div>
          <select class="form-control" name="baiks" id="baiks">
              <option value="24">午夜12点</option>
              <option value="1">午夜1点</option>
              <option value="2">午夜2点</option>
              <option value="3">午夜3点</option>
              <option value="4">凌晨4点</option>
              <option value="5">清晨5点</option>
              <option value="6">清晨6点</option>
              <option value="7">早上7点</option>
              <option value="8">早上8点</option>
              <option value="9">早上9点</option>
              <option value="10">上午10点</option>
              <option value="11">上午11点</option>
              <option value="12">中午12点</option>
              <option value="13">下午1点</option>
              <option value="14">下午2点</option>
              <option value="15">下午3点</option>
              <option value="16">下午4点</option>
              <option value="17">下午5点</option>
              <option value="18">傍晚6点</option>
              <option value="19">晚上7点</option>
              <option value="20">晚上8点</option>
              <option value="21">晚上9点</option>
              <option value="22">晚上10点</option>
              <option value="23">晚上11点</option>
            </select>
            <script type="text/javascript">
			$("#baiks").val(<{$baiks}>);
			</script>
          </div>
          <div>至</div>
          <div>
           <select class="form-control" name="baijs" id="baijs">
              <option value="24">午夜12点</option>
              <option value="1">午夜1点</option>
              <option value="2">午夜2点</option>
              <option value="3">午夜3点</option>
              <option value="4">凌晨4点</option>
              <option value="5">清晨5点</option>
              <option value="6">清晨6点</option>
              <option value="7">早上7点</option>
              <option value="8">早上8点</option>
              <option value="9">早上9点</option>
              <option value="10">上午10点</option>
              <option value="11">上午11点</option>
              <option value="12">中午12点</option>
              <option value="13">下午1点</option>
              <option value="14">下午2点</option>
              <option value="15">下午3点</option>
              <option value="16">下午4点</option>
              <option value="17">下午5点</option>
              <option value="18">傍晚6点</option>
              <option value="19">晚上7点</option>
              <option value="20">晚上8点</option>
              <option value="21">晚上9点</option>
              <option value="22">晚上10点</option>
              <option value="23">晚上11点</option>
            </select>
            <script type="text/javascript">
			$("#baijs").val(<{$baijs}>);
			</script>
          </div>
        </div>
        <div style="clear:left;"></div>
         <div class="form-group" style="margin-top:50px;">
          <label>晚间提款时间</label>
        </div>
        <div class="form-group tksjsz">
          <div>
           <select class="form-control" name="wanks" id="wanks">
              <option value="24">午夜12点</option>
              <option value="1">午夜1点</option>
              <option value="2">午夜2点</option>
              <option value="3">午夜3点</option>
              <option value="4">凌晨4点</option>
              <option value="5">清晨5点</option>
              <option value="6">清晨6点</option>
              <option value="7">早上7点</option>
              <option value="8">早上8点</option>
              <option value="9">早上9点</option>
              <option value="10">上午10点</option>
              <option value="11">上午11点</option>
              <option value="12">中午12点</option>
              <option value="13">下午1点</option>
              <option value="14">下午2点</option>
              <option value="15">下午3点</option>
              <option value="16">下午4点</option>
              <option value="17">下午5点</option>
              <option value="18">傍晚6点</option>
              <option value="19">晚上7点</option>
              <option value="20">晚上8点</option>
              <option value="21">晚上9点</option>
              <option value="22">晚上10点</option>
              <option value="23">晚上11点</option>
            </select>
            <script type="text/javascript">
			$("#wanks").val(<{$wanks}>);
			</script>
          </div>
          <div>至</div>
          <div>
          <select class="form-control" name="wanjs" id="wanjs">
              <option value="24">午夜12点</option>
              <option value="1">午夜1点</option>
              <option value="2">午夜2点</option>
              <option value="3">午夜3点</option>
              <option value="4">凌晨4点</option>
              <option value="5">清晨5点</option>
              <option value="6">清晨6点</option>
              <option value="7">早上7点</option>
              <option value="8">早上8点</option>
              <option value="9">早上9点</option>
              <option value="10">上午10点</option>
              <option value="11">上午11点</option>
              <option value="12">中午12点</option>
              <option value="13">下午1点</option>
              <option value="14">下午2点</option>
              <option value="15">下午3点</option>
              <option value="16">下午4点</option>
              <option value="17">下午5点</option>
              <option value="18">傍晚6点</option>
              <option value="19">晚上7点</option>
              <option value="20">晚上8点</option>
              <option value="21">晚上9点</option>
              <option value="22">晚上10点</option>
              <option value="23">晚上11点</option>
            </select>
            <script type="text/javascript">
			$("#wanjs").val(<{$wanjs}>);
			</script>
          </div>
        </div>
        <button type="button" id="tksjszbutton" class="btn btn-primary" style="margin-top:50px;">确认修改</button>
      </fieldset>
    </form>
    <!------------------------------------------------------------------------------->
  </div>
  <div class="tab-pane" id="tkjjrsz">
  		<div class="tstitle">排除节假日 <span>(默认所有周六、周日为节假日 ，这里可以排除指定的日期为节假日)</span></div>
        <div class="inputcontent"> 请选择排除的日期：<input type="text"  id="pcjjrval" name="pcjjrval"  class="laydate-icon" onclick="laydate({ele:this,max: laydate.now(+1),istime: false,
            istoday: true,format: 'YYYY-MM-DD'})" style="height: 30px; width:160px;">&nbsp;&nbsp;<button type="button" id="buttonpcjjr" class="layui-btn layui-btn-small" ajaxurl="<{:U("Tikuan/pcjjradd")}>">添加</button></div>
        <input type="hidden" id="pcjjrdelurl" value="<{:U("Tikuan/pcjjrdel")}>">
        <div class="sjcontent" id="pcjjr">
            <volist name="pcjjrlist" id="vo">
            	<div><{$vo.datetime}> <button class="layui-btn layui-btn-danger layui-btn-small" onclick="javascript:pcjjrdel('<{$vo.id}>',this)">删除</button></div>
            </volist>
        </div>
        <div style="clear:left;"></div>
        <div class="tstitle" style="margin-top:50px;">添加节假日 <span>(添加除周六、周日以外的其它日期为节假日)</span></div>
        <div class="inputcontent"> 请选择日期：<input type="text"  id="tjjjrval" name="birthday"  class="laydate-icon" onclick="laydate({ele:this,max: laydate.now(+1),istime: false,
            istoday: true,format: 'YYYY-MM-DD'})" style="height: 30px; width:160px;">&nbsp;&nbsp;节假日说明：<input type="text" class="form-group" id="shuoming" placeholder="节假日说明" style="width:150px; height:30px; line-height:30px;">
        <button type="button" id="buttontjjjr" class="layui-btn layui-btn-small" ajaxurl="<{:U("Tikuan/tjjjradd")}>">添加</button></div>
         <input type="hidden" id="tjjjrdelurl" value="<{:U("Tikuan/tjjjrdel")}>">
        <div class="sjcontent" id="tjjjr">
        	 <volist name="tjjjrlist" id="vo">
            	<div><{$vo.datetime}>(<span><{$vo.shuoming}></span>) <button class="layui-btn layui-btn-danger layui-btn-small" onclick="javascript:tjjjrdel('<{$vo.id}>',this)">删除</button></div>
            </volist>
        </div>
  </div>
</div>
 
</div>
</div>
</div>
</div>
<{:tongji(0)}>
</body>
</html>
