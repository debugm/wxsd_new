<?php
namespace User\Controller;

use Think\Controller;

class DealmanagesController extends UserController
{

    public function __construct()
    {
        parent::__construct();
        $this->assign("Public", MODULE_NAME); // 模块名称
    }
    public function wxrecord()
    {
        $where = array();


        $wxname = I("request.wxname","");

        if($wxname != ""){
            $where['wxname'] = array('eq',$wxname);
        }


        $cgdate_ks = urldecode(I("request.cgdateks"));
        $cgdate_js = urldecode(I("request.cgdatejs"));
        if ($cgdate_ks || $cgdate_js ) {
            $where['paytime'] = array('between',array(strtotime($cgdate_ks),strtotime($cgdate_js)?strtotime($cgdate_js):time()));
        }
        $list = $this->lists("Wxa", $where);
        $this->assign("list", $list);
        C('TOKEN_ON',false);
        $this->display();

    }


    public function dealrecord()
    {
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->select();
        $this->assign("tongdaolist", $tongdaolist); // 通道列表

        $Systembank = M("Systembank");
        $banklist = $Systembank->select();
        $this->assign("banklist", $banklist); // 银行列表

        $where = array();
        $where['pay_memberid'] = intval(session("userid")) + 10000;
        $where['del'] = 0;
        $orderid = I("get.orderid");
        if ($orderid) {
            $where['pay_orderid'] = array('eq',$orderid);
        }

        $ddlx = I("get.ddlx","");
        if($ddlx != ""){
            $where['ddlx'] = array('eq',$ddlx);
        }

        $tongdao = I("get.tongdao");
        if ($tongdao) {
            $where['pay_tongdao'] = array('eq',pay_tongdao);
        }

        $bank = I("get.bank");
        if ($bank) {
            $where['pay_bankname'] = array('eq',$bank);
        }

        $status = I("get.status");
        if ($status) {
            $where['pay_status'] = array('eq',$status);
        }
	else
	{
	}
        $tjdate_ks = I("get.tjdate_ks");
        $tjdate_js = I("get.tjdate_js");
        if ($tjdate_ks || $tjdate_js) {
            $where['pay_applydate'] = array('between',array(strtotime($tjdate_ks),strtotime($tjdate_js)?strtotime($tjdate_js):time()));
        }

        $cgdate_ks = I("get.cgdate_ks");
        $cgdate_js = I("get.cgdate_js");
        if ($cgdate_ks || $cgdate_js ) {
            $where['pay_applydate'] = array('between',array(strtotime($cgdate_ks),strtotime($cgdate_js)?strtotime($cgdate_js):time()));
        }
        $list = $this->lists("Order", $where);
        $this->assign("list", $list);
        C('TOKEN_ON',false);
        $this->display();
    }

    public function dealload()
    {
        $id = I("post.id");
        $Order = M("Order");
        $findlist = $Order->where("id=" . $id)->find();
        $pay_memberid = $findlist["pay_memberid"];
        $userid = intval($pay_memberid) - 10000;
        
        $jsonarray = array();
        $jsonarray[0] = $findlist["pay_orderid"]; // 订单号
        $jsonarray[1] = $findlist["pay_amount"]; // 交易金额
        $jsonarray[2] = $findlist["pay_poundage"]; // 手续费
        $jsonarray[3] = $findlist["pay_actualamount"]; // 实际金额
        $jsonarray[4] = $findlist["pay_applydate"]; // 提交时间
        $jsonarray[5] = $findlist["pay_successdate"]; // 交易时间
        $jsonarray[6] = $findlist["pay_zh_tongdao"]; // 通道
        $jsonarray[7] = $findlist["pay_bankname"]; // 银行
        $jsonarray[8] = $findlist["pay_tjurl"]; // 来源地址
        $jsonarray[9] = $findlist["pay_callbackurl"]; // 来源地址
        $jsonarray[10] = $findlist["pay_notifyurl"]; // 来源地址
        $jsonarray[11] = status($findlist["pay_status"]);
        if ($findlist["pay_status"] == 1) {
            $jsonarray[12] = '(<a href="' . U("/Pay/Pay/bufa", "TransID=" . $findlist["pay_orderid"] . "&tongdao=" . $findlist["pay_tongdao"]) . '" target="_blank">补发</a>)';
        }
        
        $this->ajaxReturn($jsonarray, "json");
    }

    public function dealindexload()
    {
        $id = I("post.id");
        $Order = M("Order");
        $findlist = $Order->where("pay_orderid=" . $id)->find();
        $pay_memberid = $findlist["pay_memberid"];
        $userid = intval($pay_memberid) - 10000;
        
        $jsonarray = array();
        $jsonarray[0] = $findlist["pay_orderid"]; // 订单号
        $jsonarray[1] = $findlist["pay_amount"]; // 交易金额
        $jsonarray[2] = $findlist["pay_poundage"]; // 手续费
        $jsonarray[3] = $findlist["pay_actualamount"]; // 实际金额
        $jsonarray[4] = $findlist["pay_applydate"]; // 提交时间
        $jsonarray[5] = $findlist["pay_successdate"]; // 交易时间
        $jsonarray[6] = $findlist["pay_zh_tongdao"]; // 通道
        $jsonarray[7] = $findlist["pay_bankname"]; // 银行
        $jsonarray[8] = $findlist["pay_tjurl"]; // 来源地址
        $jsonarray[9] = $findlist["pay_callbackurl"]; // 来源地址
        $jsonarray[10] = $findlist["pay_notifyurl"]; // 来源地址
        $jsonarray[11] = status($findlist["pay_status"]);
        if ($findlist["pay_status"] == 1) {
            $jsonarray[12] = '(<a href="' . U("/Pay/Pay/bufa", "TransID=" . $findlist["pay_orderid"] . "&tongdao=" . $findlist["pay_tongdao"]) . '" target="_blank">补发</a>)';
        }
        
        $this->ajaxReturn($jsonarray, "json");
    }

    public function deldel()
    {
        $id = I("post.id");
        $Order = M("Order");
        $count = $Order->where("id=" . $id . " and pay_memberid = " . (intval(session("userid")) + 10000) . " and pay_status = 0")->count();
        if ($count != 1) {
            exit("no");
        } else {
            if ($Order->where("id=" . $id . " and pay_memberid = " . (intval(session("userid")) + 10000) . " and pay_status = 0")->setField("del", 1)) {
                exit("ok");
            } else {
                exit("no");
            }
        }
    }
}
?>
