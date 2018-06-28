<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Page;

class DealmanagesController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->assign("Public", MODULE_NAME); // 模块名称
    }

    public function wxord()
    {
	$where = array();


        $wxname = I("request.payid","");
	
        if($wxname != ""){
            $where['payid'] = array('like','%'.$wxname.'%');
        }
        $shname = I("request.shname","");
	
        if($shname != ""){
            $where['mendian'] = array('like','%'.$shname.'%');
        }

	$oid = I("request.remark","");
	
        if($oid != ""){
            $where['remark'] = array('eq',$oid);
        }

 	$status = I("request.status",-1,'intval');
        if ($status != -1) {
		
            $where['push'] = array('eq',$status);
        }
	

        $cgdate_ks = urldecode(I("request.cgdateks"));
        $cgdate_js = urldecode(I("request.cgdatejs"));
        if ($cgdate_ks || $cgdate_js ) {
            $where['paytime'] = array('between',array(strtotime($cgdate_ks),strtotime($cgdate_js)?strtotime($cgdate_js):time()));
        }
	$summoney = M('Wxa')->where($where)->sum('amt');
	$list = $this->lists("Wxa", $where);
	foreach ($list as $item){
                $amount += $item['amt'];
        }

        $this->assign("list", $list);
        $this->assign("stamount", $amount);
        $this->assign("summoney", $summoney);
        C('TOKEN_ON',false);
        $this->display();

    }

    public function wxdiaodan()
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

	$list = $this->lists("Wxe", $where);
	
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
        
        $memberid = I("request.memberid",0,'intval');
        $i = 0;
        if ($memberid) {
            $where['pay_memberid'] = array('eq',$memberid);
        }
        
        $orderid = I("request.orderid",0,'intval');
        if ($orderid) {
            $where['pay_orderid'] = array('like','%'.$orderid.'%');
        }
        
        $ddlx = I("request.ddlx","");
        if($ddlx != ""){
            $where['ddlx'] = array('eq',$ddlx);
        }
        
        $tongdao = I("request.tongdao");
        if ($tongdao) {
            $where['pay_tongdao'] = array('eq',$tongdao);
        }
        
        $bank = I("request.bank",'','strip_tags');
        if ($bank) {
            $where['pay_bankname'] = array('eq',$bank);
        }
        
        $status = I("request.status",0,'intval');
        if ($status) {
            $where['pay_status'] = array('eq',$status);
        }
        
        $tjdate_ks = urldecode(I("request.tjdateks"));
        $tjdate_js = urldecode(I("request.tjdatejs"));
        if ($tjdate_ks || $tjdate_js) {
            $where['pay_applydate'] = array('between',array(strtotime($tjdate_ks),strtotime($tjdate_js)?strtotime($tjdate_js):time()));
        }
        
        $cgdate_ks = urldecode(I("request.cgdateks"));
        $cgdate_js = urldecode(I("request.cgdatejs"));
        if ($cgdate_ks || $cgdate_js ) {
            $where['pay_applydate'] = array('between',array(strtotime($cgdate_ks),strtotime($cgdate_js)?strtotime($cgdate_js):time()));
        }

        $list = $this->lists("Order", $where);
        //查询统计
        $amount = $rate = $realmoney = $traffic = 0;
        foreach ($list as $item){
            if($item['pay_status'] == 2 || $item['pay_status'] == 1){
                $amount += $item['pay_amount'];
                $rate += $item['pay_poundage'];
                $realmoney += $item['pay_actualamount'];
		$traffic += $item['pay_traffic'];
            }
        }
        $this->assign("list", $list);
        $this->assign('stamount',$amount);
        $this->assign('strate',$rate);
        $this->assign('traffic',$traffic);
        $this->assign('strealmoney',$realmoney);
        C('TOKEN_ON',false);
        $this->display();
    }

    //导出交易订单
    public function exportorder()
    {
        foreach ($_GET as $key=>$value){
            if(!in_array($key,array('__hash__','tjdateks','tjdatejs','cgdateks','cgdatejs')) && !empty($value)){
                $map['pay_'.$key] = array('eq',$value);
            }
        }
        if($_GET['tjdateks'] || $_GET['tjdatejs']){
            $map['pay_applydate'] = array('between',array(strtotime($_GET['tjdateks']),strtotime($_GET['tjdatejs'])));
        }
        if($_GET['cgdateks'] || $_GET['cgdatejs']){
            $map['pay_successdate'] = array('between',array(strtotime($_GET['cgdateks']),strtotime($_GET['cgdatejs'])));
        }

        $title = array('订单号','商户编号','交易金额','手续费','实际金额','提交时间','成功时间','通道','状态');
        $data = M('Order')->where($map)->select();
        foreach ($data as $item){

            switch ($item['pay_status']){
                case 0:
                    $status = '未处理';
                    break;
                case 1:
                    $status = '成功，未返回';
                    break;
                case 2:
                    $status = '成功，已返回';
                    break;
            }
            $list[] = array(
                'pay_orderid'=>"\t".$item['pay_orderid'],
                'pay_memberid'=>$item['pay_memberid'],
                'pay_amount'=>$item['pay_amount'],
                'pay_poundage'=>$item['pay_poundage'],
                'pay_actualamount'=>$item['pay_actualamount'],
                'pay_applydate'=>date('Y-m-d H:i:s',$item['pay_applydate']),
                'pay_successdate'=>date('Y-m-d H:i:s',$item['pay_orderid']),
                'pay_zh_tongdao'=>$item['pay_zh_tongdao'],
                'pay_status'=>$status,
            );
        }
        exportCsv($list,$title);
    }

    public function dealload()
    {
        $id = I("post.id",0,'intval');
        $Order = M("Order");
        $findlist = $Order->where("id=" . $id)->find();
        $pay_memberid = $findlist["pay_memberid"];
        $userid = intval($pay_memberid) - 10000;
        
        $jsonarray = array();
        $jsonarray[0] = $pay_memberid;
        
        $User = M("User");
        $username = $User->where("id=" . $userid)->getField("username");
        $jsonarray[1] = $username;
        $Userbasicinfo = M("Userbasicinfo");
        $fullname = $Userbasicinfo->where("userid=" . $userid)->getField("fullname");
        $jsonarray[2] = $fullname;
        $jsonarray[3] = $findlist["pay_orderid"]; // 订单号
        $jsonarray[4] = $findlist["pay_amount"]; // 交易金额
        $jsonarray[5] = $findlist["pay_poundage"]; // 手续费
        $jsonarray[6] = $findlist["pay_actualamount"]; // 实际金额
        $jsonarray[7] = date('Y-m-d H:i:s',$findlist["pay_applydate"]); // 提交时间
        $jsonarray[8] = $findlist["pay_successdate"] ? date('Y-m-d H:i:s',$findlist["pay_successdate"]): '---'; // 交易时间
        $jsonarray[9] = $findlist["pay_zh_tongdao"]; // 通道
        $jsonarray[10] = $findlist["pay_yzh_tongdao"]; // 通道
        $jsonarray[11] = $findlist["pay_bankname"]; // 银行
        $jsonarray[12] = $findlist["pay_tjurl"]; // 来源地址
        $jsonarray[13] = $findlist["pay_callbackurl"]; // 来源地址
        $jsonarray[14] = $findlist["pay_notifyurl"]; // 来源地址
        $jsonarray[15] = status($findlist["pay_status"]);
        if ($findlist["pay_status"] == 1) {
            $jsonarray[16] = '(<a href="' . U("/Pay/Pay/bufa", "TransID=" . $findlist["pay_orderid"] . "&tongdao=" . $findlist["pay_ytongdao"]) . '" target="_blank">补发</a>)';
        }
        
        $this->ajaxReturn($jsonarray, "json");
    }

    public function zjbdjl()
    {
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->select();
        $this->assign("tongdaolist", $tongdaolist); // 通道列表
        $where = array();
        $memberid = I("get.memberid",0,'intval');
        $i = 0;
        if ($memberid) {
            $User = M("User");
            $userid = $User->where("username='" . $memberid . "'")->getField("id");
            if (! $userid) {
                $userid = 0;
            }
            $where[$i] = "userid = " . (intval($memberid) - 10000) . " or userid = " . $userid;
            $i ++;
        }
        
        $orderid = I("get.orderid",0,'intval');
        if ($orderid) {
            $where[$i] = "transid = '" . $orderid . "'";
            $i ++;
        }
        
        $tongdao = I("get.tongdao",'','strip_tags');
        if ($tongdao) {
            $Payapi = M("Payapi");
            $tongdaoid = $Payapi->where("en_payname='" . $tongdao . "'")->getField("id");
            $where[$i] = "tongdao = " . $tongdaoid;
            $i ++;
        }
        
        $tjdate_ks = urldecode(I("get.tjdateks"));
        if ($tjdate_ks) {
            $where[$i] = " DATEDIFF('" . $tjdate_ks . "',datetime) <= 0";
            ;
            $i ++;
        }
        
        $tjdate_js = urldecode(I("get.tjdatejs"));
        if ($tjdate_js) {
            $where[$i] = " DATEDIFF('" . $tjdate_js . "',datetime) >= 0";
            ;
            $i ++;
        }
        
        $bank = I("get.bank");
        if ($bank) {
            $where[$i] = "lx = " . $bank;
            $i ++;
        }
        $list = $this->lists("Moneychange", $where);
        $this->assign("list", $list);
        $this->display();
    }

    public function exceldownload()
    {
        $where = array();
        $memberid = I("get.memberid",0,'intval');
        $i = 0;
        if ($memberid) {
            $User = M("User");
            $userid = $User->where("username='" . $memberid . "'")->getField("id");
            if (! $userid) {
                $userid = 0;
            }
            $where[$i] = "userid = " . (intval($memberid) - 10000) . " or userid = " . $userid;
            $i ++;
        }
        
        $orderid = I("get.orderid",0,'intval');
        if ($orderid) {
            $where[$i] = "transid = '" . $orderid . "'";
            $i ++;
        }
        
        $tongdao = I("get.tongdao",'','strip_tags');
        if ($tongdao) {
            $Payapi = M("Payapi");
            $tongdaoid = $Payapi->where("en_payname='" . $tongdao . "'")->getField("id");
            $where[$i] = "tongdao = " . $tongdaoid;
            $i ++;
        }
        
        $tjdate_ks = I("get.tjdateks");
        if ($tjdate_ks) {
            $where[$i] = " DATEDIFF('" . $tjdate_ks . "',datetime) <= 0";
            ;
            $i ++;
        }
        
        $tjdate_js = I("get.tjdatejs");
        if ($tjdate_js) {
            $where[$i] = " DATEDIFF('" . $tjdate_js . "',datetime) >= 0";
            ;
            $i ++;
        }
        
        $bank = I("get.bank");
        if ($bank) {
            $where[$i] = "lx = " . $bank;
            $i ++;
        }
        
        $str = "";
        foreach ($where as $key => $val) {
            $str = $str . "(" . $val . ") and ";
        }
        $str = $str . "(1=1)";
        $Moneychange = M("Moneychange");
        $list = $Moneychange->where($str)->select();
        // /////////////////////////////////////////////////////////////////////////////
        Vendor('PHPExcel175.PHPExcel');
        $objPHPExcel = new \PHPExcel();
        
        $objPHPExcel->getProperties()
            ->setCreator("Da")
            ->setLastModifiedBy("Da")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $objPHPExcel->setActiveSheetIndex(0);
        $titlename = date('Ymd', time());
        $objPHPExcel->getActiveSheet(0)->setTitle("资金变动记录" . $titlename);
        
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', '用户名');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', '类型');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', '提成用户名');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', '提成级别');
        $objPHPExcel->getActiveSheet(0)->setCellValue('E1', '原金额');
        $objPHPExcel->getActiveSheet(0)->setCellValue('F1', '变动金额');
        $objPHPExcel->getActiveSheet(0)->setCellValue('G1', '变动后金额');
        $objPHPExcel->getActiveSheet(0)->setCellValue('H1', '变动时间');
        $objPHPExcel->getActiveSheet(0)->setCellValue('I1', '通道');
        $objPHPExcel->getActiveSheet(0)->setCellValue('J1', '订单号');
        $objPHPExcel->getActiveSheet(0)->setCellValue('K1', '备注');
        $i = 2;
        foreach ($list as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A' . $i, sjusername($value["userid"], 1), \PHPExcel_Cell_DataType::TYPE_STRING);
            switch ($value["lx"]) {
                case 1:
                    $lx = "付款";
                    break;
                case 3:
                    $lx = "手动增加";
                    break;
                case 4:
                    $lx = "手动减少";
                    break;
                case 6:
                    $lx = "结算";
                    break;
                case 7:
                    $lx = "冻结";
                    break;
                case 8:
                    $lx = "解冻";
                    break;
                case 9:
                    $lx = "提成";
                    break;
                default:
                    $lx = "未知";
            }
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B' . $i, $lx, \PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('C' . $i, sjusername($value["tcuserid"], 1), \PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('D' . $i, $value["tcdengji"], \PHPExcel_Cell_DataType::TYPE_NUMERIC);
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('E' . $i, $value["ymoney"], \PHPExcel_Cell_DataType::TYPE_NUMERIC);
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('F' . $i, $value["money"], \PHPExcel_Cell_DataType::TYPE_NUMERIC);
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('G' . $i, $value["gmoney"], \PHPExcel_Cell_DataType::TYPE_NUMERIC);
            
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('H' . $i, $value["datetime"], \PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('I' . $i, huoqutongdaoname($value["tongdao"]), \PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('J' . $i, $value["transid"], \PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('k' . $i, $value["contentstr"], \PHPExcel_Cell_DataType::TYPE_STRING);
            $i ++;
        }
        
        $filename = date('YmdHis', time());
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename='.$filename."(T+".$T.").xls");
        // header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        header("Content-Transfer-Encoding: binary");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $objWriter->save('php://output');
        exit();
        // ////////////////////////////////////////////////////////////////////////////
    }
}
?>

