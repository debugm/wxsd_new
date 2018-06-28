<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-describedby="tscontent" data-backdrop="static" ajaxurl="<{:U("Dealmanages/dealload")}>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close modalgb" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"> <span>订单号：</span> <span id="orderidModal" style="color:#060;"></span> </h4>
      </div>
      <div class="modal-body" id="dealcontent" style="color:#000; font-family:'微软雅黑';"> 
        <!--------------------------------------------------------------------------------------------------->
        <table class="table table-condensed">
           <tr style="display:none;">
            <td>订单号：<span style="color:#090;"></span></td>
          </tr>
          <tr>
            <td>交易金额：<span style="color:#060; font-weight:bold;"></span> 元</td>
          </tr>
          <tr>
            <td>手续费：<span style="color:#666; font-weight:bold;"></span> 元</td>
          </tr>
          <tr>
            <td>实际金额：<span style="color:#C00; font-weight:bold;"></span> 元</td>
          </tr>
          <tr>
            <td>提交时间：<span style="color:#F00;"></span></td>
          </tr>
          <tr>
            <td>成功时间：<span style="color:#F00;"></span></td>
          </tr>
           <tr>
            <td>交易通道：<span></span></td>
          </tr>
           <tr>
            <td>交易银行：<span></span></td>
          </tr>
          <tr>
            <td>提交地址：<span></span></td>
          </tr>
          <tr>
            <td>页面通知返回地址：<span></span></td>
          </tr>
           <tr>
            <td>服务器点对点返回地址：<span></span></td>
          </tr>
           <tr>
            <td>状态：<span></span>&nbsp;&nbsp;<span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        <!---------------------------------------------------------------------------------------------------> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default modalgb" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
