<?php
namespace Admin\Controller;

use Think\Controller;

class TikuanController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function tikuansz()
    {
        $Tikuanconfig = M("Tikuanconfig");
        $tikuanconfiglist = $Tikuanconfig->where("websiteid=" . session("admin_usertype") . " and userid=0")->find();
        $this->assign("tikuanconfiglist", $tikuanconfiglist);
        
        $Tikuandateconfig = M("Tikuandateconfig");
        $find = $Tikuandateconfig->where("websiteid=" . session("admin_websiteid"))->find();
        if ($find) {
            $this->assign("baiks", $find["baiks"]);
            $this->assign("baijs", $find["baijs"]);
            $this->assign("wanks", $find["wanks"]);
            $this->assign("wanjs", $find["wanjs"]);
        } else {
            $data["websiteid"] = session("admin_websiteid");
            $Tikuandateconfig->data($data)->add();
            $this->assign("baiks", 0);
            $this->assign("baijs", 0);
            $this->assign("wanks", 0);
            $this->assign("wanjs", 0);
        }
        
        $Pcjjr = M("Pcjjr");
        $pcjjrlist = $Pcjjr->where("websiteid=" . session("admin_websiteid"))
            ->order("datetime desc")
            ->select();
        $this->assign("pcjjrlist", $pcjjrlist);
        
        $Tjjjr = M("Tjjjr");
        $tjjjrlist = $Tjjjr->where("websiteid=" . session("admin_websiteid"))
            ->order("datetime desc")
            ->select();
        $this->assign("tjjjrlist", $tjjjrlist);
        
        $this->display();
    }

    public function Titest()
    { 
         echo "tt";
    }

    public function Tikuanconfigedit()
    {
        if(IS_POST){
            $userid = I('post.userid') ? I('post.userid') : 0;
            $systemxz = I('post.systemxz') ? I('post.systemxz') : 0;
            $id = I('post.id',0,'intval') ? I('post.id',0,'intval') : 0;
            $Tikuanconfig = M("Tikuanconfig");
            $_rows = [
                'tkzxmoney'=>I('post.tkzxmoney'),
                'tkzdmoney'=>I('post.tkzdmoney'),
                'dayzdmoney'=>I('post.dayzdmoney'),
                'dayzdnum'=>I('post.dayzdnum'),
                't1zt'=>I('post.t1zt'),
                't0zt'=>I('post.t0zt'),
                'gmt0'=>I('post.gmt0'),
                'tktype'=>I('post.tktype'),
                'tkzt'=>I('post.tkzt'),
                'systemxz'=>$systemxz,
                'sxfrate'=>I('post.sxfrate'),
                'sxffixed'=>I('post.sxffixed')
            ];
            if($id ){
                $res = $Tikuanconfig->where(['websiteid'=>0,'userid'=>$userid,'id'=>$id])->save($_rows);
            }else{
                $_rows['websiteid'] = 0;
                $_rows['userid'] = $userid;
                $res = $Tikuanconfig->add($_rows);

            }
            $res ? exit('修改成功') : exit('修改失败');
        }
    }

    public function tikuanshijianedit()
    {
        $websiteid = session("admin_websiteid");
        $baiks = I("post.baiks", "");
        $baijs = I("post.baijs", "");
        $wanks = I("post.wanks", "");
        $wanjs = I("post.wanjs");
        
        if ($websiteid == "" || $baiks == "" || $baijs == "" || $wanks == "" || $wanjs == "") {
            exit("修改错误 ");
        } else {
            
            $data["baiks"] = $baiks;
            $data["baijs"] = $baijs;
            $data["wanks"] = $wanks;
            $data["wanjs"] = $wanjs;
            
            $Tikuandateconfig = M("Tikuandateconfig");
            $count = $Tikuandateconfig->where("websiteid=" . $websiteid)->count();
            if ($count > 0) {
                $Tikuandateconfig->where("websiteid=" . $websiteid)->save($data);
            } else {
                $Tikuandateconfig->data($data)->add();
            }
            exit("修败成功");
        }
    }

    public function pcjjradd()
    {
        $datetime = I("post.datetime", "");
        if ($datetime == "") {
            exit("a");
        } else {
            $Pcjjr = M("Pcjjr");
            $count = $Pcjjr->where("websiteid=" . session("admin_websiteid") . " and datetime = '" . $datetime . "'")->count();
            if ($count > 0) {
                exit("b");
            } else {
                $data["websiteid"] = session("admin_websiteid");
                $data["datetime"] = $datetime;
                $id = $Pcjjr->add($data);
                exit($id);
            }
        }
    }

    public function tjjjradd()
    {
        $datetime = I("post.datetime", "");
        $shuoming = I("post.shuoming", "");
        if ($datetime == "") {
            exit("a");
        } else {
            $Tjjjr = M("Tjjjr");
            $count = $Tjjjr->where("websiteid=" . session("admin_websiteid") . " and datetime = '" . $datetime . "'")->count();
            if ($count > 0) {
                exit("b");
            } else {
                $data["websiteid"] = session("admin_websiteid");
                $data["datetime"] = $datetime;
                $data["shuoming"] = $shuoming;
                $id = $Tjjjr->add($data);
                exit($id);
            }
        }
    }

    public function pcjjrdel()
    {
        $id = I("post.id", "");
        if ($id == "") {
            exit("no");
        } else {
            $Pcjjr = M("Pcjjr");
            $Pcjjr->where("id=" . $id)->delete();
            exit("ok");
        }
    }

    public function tjjjrdel()
    {
        $id = I("post.id", "");
        if ($id == "") {
            exit("no");
        } else {
            $Tjjjr = M("Tjjjr");
            $Tjjjr->where("id=" . $id)->delete();
            exit("ok");
        }
    }

    public function tikuanlist()
    {
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->select();
        $this->assign("tongdaolist", $tongdaolist); // 通道列表
        
        $Systembank = M("Systembank");
        $banklist = $Systembank->select();
        $this->assign("banklist", $banklist); // 银行列表

        $where = array();
        $memberid = I("get.memberid");
        $i = 0;
        if ($memberid) {
            $where[$i] = "userid = " . ($memberid - 10000);
            $i ++;
        }
        $tongdao = I("get.tongdao");
        if ($tongdao) {
            $where[$i] = "payapiid = " . $tongdao;
            $i ++;
        }
        $bank = I("get.bank");
        if ($bank) {
            $where[$i] = "bankname = '" . $bank . "'";
            $i ++;
        }
        $T = I("get.T");
        if ($T != "") {
            $where[$i] = "t = " . $T;
            $i ++;
        }
        $status = I("get.status");
        if ($status!=null) {
            $where[$i++] = "status = " . $status;
            $i ++;
        }
        $tjdate_ks = urldecode(I("get.tjdate_ks"));
        if ($tjdate_ks) {
            $where[$i] = " DATEDIFF('" . $tjdate_ks . "',sqdatetime) <= 0";
            $i ++;
        }
        $tjdate_js = urldecode(I("get.tjdate_js"));
        if ($tjdate_js) {
            $where[$i] = " DATEDIFF('" . $tjdate_js . "',sqdatetime) >= 0";
            $i ++;
        }
        $cgdate_ks = urldecode(I("get.cgdate_ks"));
        if ($cgdate_ks) {
            $where[$i] = " DATEDIFF('" . $cgdate_ks . "',cldatetime) <= 0";
            $i ++;
        }
        $cgdate_js = urldecode(I("get.cgdate_js"));
        if ($cgdate_js) {
            $where[$i] = " DATEDIFF('" . $cgdate_js . "',cldatetime) >= 0";
            $i ++;
        }
        $list = $this->lists("Tklist", $where);

        $this->assign("list", $list);
        $this->display();
    }


    //导出提款记录
    public function exportorder()
    {
        $memberid = I("get.memberid");
        $tongdao = I("get.tongdao");
        $bank = I("get.bank");
        $T = I("get.T");
        $status = I("get.status");
        $tjdate_ks = I("get.tjdate_ks");
        $tjdate_js = I("get.tjdate_js");
        $cgdate_ks = I("get.cgdate_ks");
        $cgdate_js = I("get.cgdate_js");
        if ($memberid) {
            $_where['userid'] = array('eq',$memberid - 10000);
        }
        if($tongdao){
            $_where['payapiid'] = ['eq',$tongdao];
        }
        if($bank){
            $_where['bankname'] = ['eq',$bank];
        }
        if($T){
            $_where['t'] = ['eq',$T];
        }
        if($status!=null){
            $_where['status'] = ['eq',$status];
        }
        if($_GET['tjdate_ks'] || $_GET['tjdate_js']){
            $_where['sqdatetime'] = array('between',array($tjdate_ks,$tjdate_js));
        }
        if($_GET['cgdate_ks'] || $_GET['cgdate_js']){
            $_where['cldatetime'] = array('between',array($cgdate_ks,$cgdate_js));
        }

        $title = array('类型','商户编号','结算金额','手续费','到账金额','银行名称','支行名称','银行卡号','开户名','所属省','所属市','申请时间','处理时间','通道','状态');
        $data = M('Tklist')->where($_where)->select();

        foreach ($data as $item){
            switch ($item['status']){
                case 0:
                    $status = '未处理';
                    break;
                case 1:
                    $status = '处理中';
                    break;
                case 2:
                    $status = '已打款';
                    break;
            }
            switch ($item['t']){
                case 0:
                    $tstr = 'T + 0';
                    break;
                case 1:
                    $tstr = 'T + 1';
                    break;
            }

            $list[] = array(
                't'=>$tstr,
                'memberid'=>$item['userid']+10000,
                'tkmoney'=>$item['tkmoney'],
                'sxfmoney'=>$item['sxfmoney'],
                'money'=>$item['money'],
                'bankname'=>$item['bankname'],
                'bankzhiname'=>$item['bankzhiname'],
                'banknumber'=>$item['banknumber'],
                'bankfullname'=>$item['bankfullname'],
                'sheng'=>$item['sheng'],
                'shi'=>$item['shi'],
                'sqdatetime'=>$item['sqdatetime'],
                'cldatetime'=>$item['cldatetime'],
                'tongdao'=>huoqutongdaoname($item['payapiid']),
                'status'=>$status,
            );
        }
        exportCsv($list,$title);
    }

    public function wttikuanlist()
    {
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->select();
        $this->assign("tongdaolist", $tongdaolist); // 通道列表
    
        $Systembank = M("Systembank");
        $banklist = $Systembank->select();
        $this->assign("banklist", $banklist); // 银行列表
    
        $where = array();
        $memberid = I("get.memberid");
        $i = 0;
        if ($memberid) {
            $where[$i] = "userid = " . ($memberid - 10000);
            $i ++;
        }
    
        $tongdao = I("get.tongdao");
        if ($tongdao) {
            $where[$i] = "payapiid = " . $tongdao;
            $i ++;
        }
    
        $bank = I("get.bank");
        if ($bank) {
            $where[$i] = "bankname = '" . $bank . "'";
            $i ++;
        }
    
        $T = I("get.T", "");
        if ($T != "") {
            $where[$i] = "t = " . $T;
            $i ++;
        }
    
        $status = I("get.status");
        if ($status) {
            $where[$i] = "status = " . $status;
            $i ++;
        }
    
        $tjdate_ks = urldecode(I("get.tjdate_ks"));
        if ($tjdate_ks) {
            $where[$i] = " DATEDIFF('" . $tjdate_ks . "',sqdatetime) <= 0";
            ;
            $i ++;
        }
    
        $tjdate_js = urldecode(I("get.tjdate_js"));
        if ($tjdate_js) {
            $where[$i] = " DATEDIFF('" . $tjdate_js . "',sqdatetime) >= 0";
            ;
            $i ++;
        }
    
        $cgdate_ks = urldecode(I("get.cgdate_ks"));
        if ($cgdate_ks) {
            $where[$i] = " DATEDIFF('" . $cgdate_ks . "',cldatetime) <= 0";
            ;
            $i ++;
        }
    
        $cgdate_js = urldecode(I("get.cgdate_js"));
        if ($cgdate_js) {
            $where[$i] = " DATEDIFF('" . $cgdate_js . "',cldatetime) >= 0";
            ;
            $i ++;
        }
    
        $list = $this->lists("wttklist", $where);
        $this->assign("list", $list);
        $this->display();
    }

    //导出委托提款记录
    public function exportweituo()
    {
        $memberid = I("get.memberid");
        $tongdao = I("get.tongdao");
        $bank = I("get.bank");
        $T = I("get.T");
        $status = I("get.status");
        $tjdate_ks = I("get.tjdate_ks");
        $tjdate_js = I("get.tjdate_js");
        $cgdate_ks = I("get.cgdate_ks");
        $cgdate_js = I("get.cgdate_js");
        if ($memberid) {
            $_where['userid'] = array('eq',$memberid - 10000);
        }
        if($tongdao){
            $_where['payapiid'] = ['eq',$tongdao];
        }
        if($bank){
            $_where['bankname'] = ['eq',$bank];
        }
        if($T){
            $_where['t'] = ['eq',$T];
        }
        if($status!=null){
            $_where['status'] = ['eq',$status];
        }
        if($_GET['tjdate_ks'] || $_GET['tjdate_js']){
            $_where['sqdatetime'] = array('between',array($tjdate_ks,$tjdate_js));
        }
        if($_GET['cgdate_ks'] || $_GET['cgdate_js']){
            $_where['cldatetime'] = array('between',array($cgdate_ks,$cgdate_js));
        }

        $title = array('类型','商户编号','结算金额','手续费','到账金额','银行名称','支行名称','银行卡号','开户名','所属省','所属市','申请时间','处理时间','通道','状态');
        $data = M('Wttklist')->where($_where)->select();

        foreach ($data as $item){
            switch ($item['status']){
                case 0:
                    $status = '未处理';
                    break;
                case 1:
                    $status = '处理中';
                    break;
                case 2:
                    $status = '已打款';
                    break;
            }
            switch ($item['t']){
                case 0:
                    $tstr = 'T + 0';
                    break;
                case 1:
                    $tstr = 'T + 1';
                    break;
            }

            $list[] = array(
                't'=>$tstr,
                'memberid'=>$item['userid']+10000,
                'tkmoney'=>$item['tkmoney'],
                'sxfmoney'=>$item['sxfmoney'],
                'money'=>$item['money'],
                'bankname'=>$item['bankname'],
                'bankzhiname'=>$item['bankzhiname'],
                'banknumber'=>$item['banknumber'],
                'bankfullname'=>$item['bankfullname'],
                'sheng'=>$item['sheng'],
                'shi'=>$item['shi'],
                'sqdatetime'=>$item['sqdatetime'],
                'cldatetime'=>$item['cldatetime'],
                'tongdao'=>huoqutongdaoname($item['payapiid']),
                'status'=>$status,
            );
        }
        exportCsv($list,$title);
    }
    
    public function dftikuanlist()
    {
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->select();
        $this->assign("tongdaolist", $tongdaolist); // 通道列表
    
        $Systembank = M("Systembank");
        $banklist = $Systembank->select();
        $this->assign("banklist", $banklist); // 银行列表
    
        $where = array();
        $memberid = I("get.memberid");
        $i = 0;
        if ($memberid) {
            $where[$i] = "userid = " . ($memberid - 10000);
            $i ++;
        }
    
        $tongdao = I("get.tongdao");
        if ($tongdao) {
            $where[$i] = "payapiid = " . $tongdao;
            $i ++;
        }
    
        $bank = I("get.bank");
        if ($bank) {
            $where[$i] = "bankname = '" . $bank . "'";
            $i ++;
        }
    
        $T = I("get.T", "");
        if ($T != "") {
            $where[$i] = "t = " . $T;
            $i ++;
        }
    
        $status = I("get.status");
        if ($status) {
            $where[$i] = "status = " . $status;
            $i ++;
        }
    
        $tjdate_ks = I("get.tjdate_ks");
        if ($tjdate_ks) {
            $where[$i] = " DATEDIFF('" . $tjdate_ks . "',sqdatetime) <= 0";
            ;
            $i ++;
        }
    
        $tjdate_js = I("get.tjdate_js");
        if ($tjdate_js) {
            $where[$i] = " DATEDIFF('" . $tjdate_js . "',sqdatetime) >= 0";
            ;
            $i ++;
        }
    
        $cgdate_ks = I("get.cgdate_ks");
        if ($cgdate_ks) {
            $where[$i] = " DATEDIFF('" . $cgdate_ks . "',cldatetime) <= 0";
            ;
            $i ++;
        }
    
        $cgdate_js = I("get.cgdate_js");
        if ($cgdate_js) {
            $where[$i] = " DATEDIFF('" . $cgdate_js . "',cldatetime) >= 0";
            ;
            $i ++;
        }
    
        $list = $this->lists("dflist", $where);
        $this->assign("list", $list);
        $this->display();
    }
    
    public function Reloadstatus()   
    {
       $id = I("post.id", ""); 
       
       $Tklist = M("Tklist");
	$tk_record = $Tklist->where("id=" . $id)->find();
	$cldate = $tk_record['cldatetime'];
	$date=date_create($cldate);
	$tranDate = date_format($date,"Ymd");
      	$tranFlow = $id;
	
	$p = array(
		"oriTranDate" => $tranDate,
		"oriTranFlow" => $tranFlow
	);
	$ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://mer.jiandundingzhi.com/Pay/hfbdf/page/queryhandler.php");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
	var_dump($result);
	$res = json_decode($result,true);
	if($res['rtnCode'] == '0000' && $res['oriRtnCode'] == '0000')
	{
		$status = 2;
		$data['status'] = 2;
		$Tklist->where("id=" . $id)->save($data);
		exit('ok');
	}
	else
	{
		/*
		$fail = array();
		
                $fail['payapiid'] = $tk_record['payapiid'];
                $fail['userid'] = $tk_record['userid'];
                $fail['dfid'] = $id;
                $fail['failed_reason'] = $result;

                M('dffailed')->add($fail);
                $status = 3;
		*/
	}
	
    }

    public function Editstatus()
    {

        $notifyurl = $this->_site . 'Admin_Tikuan_intnotifyurl.html'; 
        $id = I("post.id", "");
        $status = I("post.status", "");
        if ($id == "" or $status == "") {
            exit("no");
        } else {
            $Tklist = M("Tklist");


            $tk_record = $Tklist->where("id=" . $id)->find();
	    if($tk_record['status'] != 0)
	    {
		exit("ok");
	    }
	
            file_put_contents('./log.txt', date("Y-m-d H:i:s").json_encode($tk_record)."--daifu-request\n",FILE_APPEND);

            $payapiid = $tk_record['payapiid'];
            $payapi = M("Payapiaccount");
            $payapi_record = $payapi->where("payapiid=".$payapiid)->find();
            $merchant_id = $payapi_record['sid'];
            
            $user_id = $tk_record['userid'];
            $user_info = M('Userbasicinfo')->where("userid=".$user_id)->find();

            //调用钱通的代付接口
		//此处提款成功，需扣款，将用户的余额扣除。
		$status = 2;
		 $Apimoney = M("Apimoney2");
                 $yuemoney = $Apimoney->where("userid=" . $tk_record['userid'] . " and payapiid=" . $payapiid)->getField("money");
		 
		 $jsmoney = $tk_record['tkmoney'];
		
		$data = array();
                $data["money"] = sprintf("%.2f", ($yuemoney - $jsmoney));
		//$Apimoney->where("userid=" . $tk_record['userid'] . " and payapiid=" . $payapiid)->save($data);
		$data = array();
		$data['status'] = 2;
            $Tklist->where("id=" . $id)->save($data);
            exit("ok");
        }
    }
    
    public function Checkfail()
    {
        $id = I("get.id", "");
        
        if ($id == "") 
        {
            exit("no");
        }
        $dffail = M('dffailed');

        $reason = $dffail->where("dfid=".$id)->find();
        exit($reason['failed_reason']);
    }
	
    public function intnotifyurl()
    {

	file_put_contents('./log.txt',date('Y-m-d H:i:s').json_encode($_POST)."--json_post-daifu###",FILE_APPEND);
	
	$sign = $_POST['sign'];
	unset($_POST['sign']);
	unset($_POST['sign_type']);

	ksort($_POST);
	$s = "";

	foreach($_POST as $k => $v)
	{
    		$s .= $k ."=". $v . "&";
	}

	$s = substr($s,0,strlen($s)-1); 
	$key = "5ed95554b08845568a793d4c3171d911";
	$s .= $key;

	if($sign == md5($s) )
	{

        $tranId = $_POST['out_trade_no'];
        $dfid = explode('#',$tranId);
        $dfid = $dfid[0];

        //代付成功，修改tikuanlist
        $Tklist = M("Tklist");
        $tk_record = $Tklist->where("id=" . $dfid)->find();

        $payapiid = $tk_record['payapiid'];
        $user_id = $tk_record['userid'];
        $status = 2;
        if($_POST['resp_code'] != "0000")
        {
            
       
            $fail = array();

            $fail['payapiid'] = $payapiid;
            $fail['userid'] = $user_id;
            $fail['dfid'] = $dfid;
            $fail['failed_reason'] = json_encode($_POST);

            M('dffailed')->add($fail);
            $status = 3;
        }
        $Tklist->where("id=" . $dfid)->save(array('status' => $status));
	}
    }



    public function notifyurl()
    {
        $result=file_get_contents('php://input', 'r');
        $tmp = explode("|", $result);
        $resp_xml = base64_decode($tmp[0]);

        //file_put_contents('./log.txt',$resp_xml,FILE_APPEND);

        $resp_sign = $tmp[1];
        $array_data = json_decode(json_encode(simplexml_load_string($resp_xml, 'SimpleXMLElement', LIBXML_NOCDATA))); 
        $arr = $array_data["@attributes"];

        $tranId = $arr['tranId'];
        $dfid = explode('#',$tranId);
        $dfid = $dfid[0];

        //代付成功，修改tikuanlist
        $Tklist = M("Tklist");
        $tk_record = $Tklist->where("id=" . $dfid)->find();

        $payapiid = $tk_record['payapiid'];
        $user_id = $tk_record['userid'];
        $status = 2;
        if($arr['tranList']['item']['respCode'] != "0")
        {
            
       
            $fail = array();

            $fail['payapiid'] = $payapiid;
            $fail['userid'] = $user_id;
            $fail['dfid'] = $dfid;
            $fail['failed_reason'] = json_encode($arr);

            M('dffailed')->add($fail);
            $status = 3;
        }
        $Tklist->where("id=" . $dfid)->save(array('status' => $status));
    }


    public function sign($data) 
    {
        $certs = array();
        openssl_pkcs12_read(file_get_contents("./merchant_cert.pfx"),
                $certs,"11111111"); //其中password为你的证书密码
        if(!$certs) return ;
        $signature = '';
        openssl_sign($data, $signature, $certs['pkey']);
        return base64_encode($signature);
    }


    public function arrToXml($arr)
    {
        $str = '<?xml version="1.0" encoding="utf-8" standalone="no"?><message';
        foreach($arr as $k => $v)
        {
             $tmp = "";
         $tmp =  " {$k}=\"{$v}\"";

         $str .= $tmp;
        }
        $str .= "/>";   
        return $str;
    }

    public function verity($data,$signature)  
    {  
        $pubKey = file_get_contents("./server_cert.cer");  
        $res = openssl_get_publickey($pubKey);  
        $result = (bool)openssl_verify($data, base64_decode($signature), $res);  
        openssl_free_key($res);
        return $result;  
    }


    public function Editstatuswt()
    {
        $id = I("post.id", "");
        $status = I("post.status", "");
        if ($id == "" or $status == "") {
            exit("no");
        } else {
            $Wttklist = M("Wttklist");
            $data = array();
            $data["status"] = $status;
            if ($status == 2) {
                $data["cldatetime"] = date("Y-m-d H:i:s");
            }
            $Wttklist->where("id=" . $id)->save($data);
            exit("ok");
        }
    }

    //提现语音提现
    public function checkNotice(){
        //提款记录
        $tikuan = M('Tklist')->where(['status'=>0])->count();
        //委托提款
        $wttikuan = M('Wttklist')->where(['status'=>0])->count();
        $this->ajaxReturn(['errorno'=>0,'num'=>($tikuan+$wttikuan)]);
    }
}
?>
