<?php

namespace Pay\Controller;

use Think\Controller;
header('Content-type:text/html;charset=utf-8');

class PayController extends Controller
{
    public $userinfo = array();
    public $_site;

    public function __construct()
    {
        parent::__construct();
        $pay_memberid = I("request.pay_memberid",0,'intval') - 10000;
        // 商户编号不能为空
        if (empty($pay_memberid)) {
            $this->ErrorReturn("商户编号不能为空!");
        }
        //用户信息
        $_modeluser = D('User');
        $this->userinfo = $_modeluser->get_Userinfo($pay_memberid);
        $this->_site = ((is_https()) ? 'https' : 'http') . '://' . C("DOMAIN") . '/';
    }

    public function ErrorReturn($errorstr)
    {
        exit($errorstr);
    }

    function domaincheck($pay_memberid)
    {
        $referer = $_SERVER["HTTP_REFERER"]; // 获取完整的来路URL
        $domain = $_SERVER['HTTP_HOST'];
        $pay_memberid = intval($pay_memberid) - 10000;
        $User = M("User");
        $num = $User->where("id=" . $pay_memberid)->count();
        if ($num <= 0) {
            $this->ErrorReturn("商户编号不存在");
        } else {
            $websiteid = $User->where("id=" . $pay_memberid)->getField("websiteid");
            $Websiteconfig = M("Websiteconfig");
            $websitedomain = $Websiteconfig->where("websiteid = " . $websiteid)->getField("domain");

            if ($websitedomain != $domain) {
                $Userverifyinfo = M("Userverifyinfo");
                $domains = $Userverifyinfo->where("userid=" . $pay_memberid)->getField("domain");
                if (!$domains) {
                    $this->ErrorReturn("域名错误 ");
                } else {
                    $arraydomain = explode("|", $domains);
                    $checktrue = true;
                    foreach ($arraydomain as $key => $val) {
                        if ($val == $domain) {
                            $checktrue = false;
                            break;
                        }
                    }
                    if ($checktrue) {
                        $this->ErrorReturn("域名错误 ");
                    }
                }
            }
        }
    }

    public function orderadd($parameter)
    {
        $return = array();
//var_dump($parameter);exit();
        $PayName = $parameter["PayName"]; // 通道名称
        $moneyratio = $parameter["moneyratio"]; // 交易金额比例
        $pay_memberid = I("request.pay_memberid",0,'intval');
        $return["memberid"] = $pay_memberid;
        $userid = intval($pay_memberid) - 10000;
        $Payapi = M("Payapi");
        $payapiid = $Payapi->where("en_payname='" . $PayName . "'")->getField("id");
        $Userpayapizhanghao = M("Userpayapizhanghao");
        //$defaultpayapiuserid = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $payapiid)->getField("defaultpayapiuserid");

        $_userpayapizhanghao = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $payapiid)->find();
        $defaultpayapiuserid = $_userpayapizhanghao['defaultpayapiuserid'];
        // exit($defaultpayapiuserid);
        if (!$defaultpayapiuserid) {
            $Payapiaccount = M("Payapiaccount");
            $defaultpayapiuserid = $Payapiaccount->where("payapiid=" . $payapiid)->getField("id");
            if (!$defaultpayapiuserid) {
                echo json_encode(array('errorno'=>20001,'msg'=>'通道账号获取失败'),JSON_UNESCAPED_UNICODE);
                exit();
            }
        }

        $feilv = $_userpayapizhanghao['feilv'];
        $fengding = $_userpayapizhanghao['fengding'];

        $Payapiaccount = M("Payapiaccount");
        $paylist = $Payapiaccount->where("id=" . $defaultpayapiuserid)->find();
        // echo ($defaultpayapiuserid);
	$return['userid'] = $userid;
        $return["sid"] = $paylist["sid"]; // 商户ID
        $return["key"] = $paylist["key"]; // 密钥
        $return["account"] = $paylist["account"]; // 帐号
        $return["keykey"] = $paylist["keykey"]; // 帐号
        $return["domain"] = $paylist["domain"] ? $paylist["domain"] : $parameter["tjurl"]; // 跳转域名
        $return["notifyurl"] = $paylist["serverreturn"] ? $paylist["serverreturn"] : $this->_site . "Pay_" . $PayName . "_notifyurl.html";
        $return["callbackurl"] = $paylist["pagereturn"] ? $paylist["pagereturn"] : $this->_site . "Pay_" . $PayName . "_callbackurl.html";
        $return['unlockdomain'] = $paylist['unlockdomian'] ? $paylist['unlockdomian'] : ''; //防封域名
        $feilv = $feilv == 0 ? $paylist["defaultrate"] : $feilv; // 交易费率
        $fengding = $fengding == 0 ? $paylist["fengding"] : $fengding; // 封顶手续费
        $fengding = $fengding == 0 ? 9999999 : $fengding; //如果没有设置封顶手续费自动设置为一个足够大的数字

        //如果是集成接口单独计算手续费
        $zh_PayName = $parameter["zh_PayName"];
        $en_PayName = $parameter["PayName"];
        if (I("request.defaulttongdao", "") == "default") {
            $d_PayName = "Default"; // 通道名称
            $Payapi = M("Payapi");
            $d_payapiid = $Payapi->where("en_payname='" . $d_PayName . "'")->getField("id");
            $Userpayapizhanghao = M("Userpayapizhanghao");
            $_duserpayapizhanghao = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $d_payapiid)->find();
            $d_defaultpayapiuserid = $_duserpayapizhanghao['defaultpayapiuserid'];
            if (!$d_defaultpayapiuserid) {
                $Payapiaccount = M("Payapiaccount");
                $d_defaultpayapiuserid = $Payapiaccount->where("payapiid=" . $d_payapiid . " and defaultpayapiuser = 1")->getField("id");
                if (!$d_defaultpayapiuserid) {
                    echo json_encode(array('errorno'=>20002,'msg'=>'通道账号获取失败'),JSON_UNESCAPED_UNICODE);
                    exit();
                }
            }
            $feilv = $_duserpayapizhanghao['feilv'];
            $fengding = $_duserpayapizhanghao['fengding'];

            $Payapiaccount = M("Payapiaccount");
            $d_paylist = $Payapiaccount->where("id=" . $d_defaultpayapiuserid)->find();
            $feilv = $feilv == 0 ? $d_paylist["defaultrate"] : $feilv; // 交易费率
            $fengding = $fengding == 0 ? $d_paylist["fengding"] : $fengding; // 封顶手续费
            $fengding = $fengding == 0 ? 9999999 : $fengding; //如果没有设置封顶手续费自动设置为一个足够大的数字

            $zh_PayName = "系统集成接口";
            $en_PayName = 'Default';
        }

        $pay_amount = I("request.pay_amount", 0);
	
	//$pay_amount += round(mt_rand()/mt_getrandmax(),2);

        if (!$pay_amount or !is_numeric($pay_amount)) {
            echo json_encode(array('errorno'=>30001,'msg'=>'金额错误'),JSON_UNESCAPED_UNICODE);
            exit();
        }
        $pay_orderid = $parameter['orderid'];
        if ($pay_orderid) {
            $Order = M("Order");
            $count = $Order->where("pay_orderid = '" . $pay_orderid . "'")->count();
            if ($count > 0) {
                echo json_encode(array('errorno'=>30002,'msg'=>'订单号已存在'),JSON_UNESCAPED_UNICODE);
                exit();
            }
        }
        //生成订单号
        $pay_orderid = $pay_orderid ? $pay_orderid : get_requestord();

        $return["amount"] = floatval($pay_amount) * $moneyratio; // 交易金额
        $pay_sxfamount = (($pay_amount * $feilv) > $fengding) ? $fengding : ($pay_amount * $feilv); // 手续费
        $pay_shijiamount = $pay_amount - $pay_sxfamount; // 实际到账金额
	
	//计算流量是否剩余
	if($PayName == "Hmh5" || $PayName=='Pawxsm' || $PayName=='Paqqh5' || $PayName == 'Esdylwap')
	{
		$user_money = M("Money")->where("userid=".$userid)->getField("wallet");
	if($user_money <= 0)
	{
	    echo json_encode(array('errorno' => 30003,'msg' => "用户流量不足，请充值"),JSON_UNESCAPED_UNICODE);
	    exit();
	}
	
	// 扣除用户流量
	/*
	$user_money -= $pay_sxfamount;
	M("Money")->where("userid=".$userid)->save(array("wallet" => $user_money));
	*/
        }
	if ($this->md5signtest()) {
            $Systembank = M("Systembank");
            $systembankid = $Systembank->where("bankcode='" . I("request.pay_bankcode") . "'")->getField("id");
            $bankname = $Systembank->where("bankcode='" . I("request.pay_bankcode") . "'")->getField("bankname");
            if (!$systembankid) {
                echo json_encode(array('errorno'=>30004,'msg'=>'银行编码错误','data'=>I("request.pay_bankcode")),JSON_UNESCAPED_UNICODE);
                exit();
            } else {
                $Payapiconfig = M("Payapiconfig");
                $payapiconfigid = $Payapiconfig->where("payapiid=" . $payapiid)->getField("id");
		//print_r($payapiid);
                $Payapibank = M("Payapibank");
                $bankcode = $Payapibank->where("systembankid = " . $systembankid . " and payapiconfigid = " . $payapiconfigid)->getField("bankcode");
                if ($bankcode == "") {
                    echo json_encode(array('errorno'=>30005,'msg'=>'系统银行编码错误','data'=>I("request.pay_bankcode"),'systembankid' => $systembankid,'payapiid' => $payapiid,'payname' => $PayName),JSON_UNESCAPED_UNICODE);
                    exit();
                } else {
                    $return["bankcode"] = $bankcode;
                    $Order = M("Order");
                    $data["pay_memberid"] = $pay_memberid;
                    $return["orderid"] = $pay_orderid; // 订单号
                    $data["pay_orderid"] = $return["orderid"];
                    $data["pay_amount"] = $pay_amount; // 交易金额
                    $data["pay_poundage"] = $pay_sxfamount; // 手续费
                    $data["pay_actualamount"] = $pay_shijiamount; // 到账金额
                    $data["pay_applydate"] = time();
                    $data["pay_bankcode"] = $bankcode;
                    $data["pay_bankname"] = $bankname;
                    $data["pay_notifyurl"] = I("request.pay_notifyurl");
                    $data["pay_callbackurl"] = I("request.pay_callbackurl");
                    $data["pay_status"] = 0;
                    $data["pay_tongdao"] = $en_PayName;
                    $data["pay_zh_tongdao"] = $zh_PayName;
                    $data["pay_ytongdao"] = $parameter["PayName"];
                    $data["pay_yzh_tongdao"] = $parameter["zh_PayName"];
                    $data["pay_tjurl"] = $_SERVER["HTTP_REFERER"];
                    $data["pay_productname"] = I("request.pay_productname");
                    $data["pay_productnum"] = I("request.pay_productnum");
                    $data["pay_productdesc"] = I("request.pay_productdesc");
                    $data["pay_producturl"] = I("request.pay_producturl");
                    $data["pay_reserved1"] = I("request.pay_reserved1");
                    $data["pay_reserved2"] = I("request.pay_reserved2");
                    $data["pay_reserved3"] = I("request.pay_reserved3");

                    $data["ddlx"] = I("post.ddlx", 0);
                    if (I("request.pay_reserved1")) {
                        $return["resrved"] = I("request.pay_reserved1") . "/" . I("request.pay_reserved2") . "/" . I("request.pay_reserved3");
                    }
                    $data["memberid"] = $return["sid"];
                    $data["key"] = $return["key"];
                    $data["account"] = $return["account"];

                    if ($Order->add($data)) {
                        $return['datetime'] = date('Y-m-d H:i:s',$data['pay_applydate']);
                        $return["status"] = "success";
                        return $return;
                    } else {
                        echo json_encode(array('errorno'=>30006,'msg'=>'系统错误'),JSON_UNESCAPED_UNICODE);
                        exit();
                    }
                }
            }
        } else {
            echo json_encode(array('errorno'=>30003,'msg'=>'签名验证失败','data'=>$_REQUEST),JSON_UNESCAPED_UNICODE);
            exit();
        }
    }

    // 支付签名
    public function get_paysign($arraystr, $key)
    {
        ksort($arraystr);
        $buff = "";
        foreach ($arraystr as $k => $v)
        {
            if($k != "sign" && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        $string = $buff . "&key=".$key;
        $string = md5($string);
        $sign = strtoupper($string);
        return $sign;
    }

    private function md5signtest()
    {
        $requestarray = array(
            "pay_memberid" => I("request.pay_memberid", ""),
            "pay_orderid" => I("request.pay_orderid", ""),
            "pay_amount" => I("request.pay_amount", ""),
            "pay_applydate" => I("request.pay_applydate", ""),
            "pay_bankcode" => I("request.pay_bankcode", ""),
            "pay_notifyurl" => I("request.pay_notifyurl", ""),
            "pay_callbackurl" => I("request.pay_callbackurl", "")
        );

        $userid = intval($requestarray["pay_memberid"]) - 10000;
        $Userverifyinfo = M("Userverifyinfo");
        $md5key = $Userverifyinfo->where("userid=" . $userid)->getField("md5key");
        $md5keysignstr = $this->md5sign($md5key, $requestarray);
        $pay_md5sign = I("request.pay_md5sign");
        //echo $pay_md5sign .'======='.$md5keysignstr;
        if ($pay_md5sign == $md5keysignstr) {
            return true;
        } else {
            return false;
        }
    }

    public function setHtml($tjurl, $arraystr)
    {
        $str = '<form id="Form1" name="Form1" method="post" action="' . $tjurl . '">';
        foreach ($arraystr as $key => $val) {
            $str .= '<input type="hidden" name="' . $key . '" value="' . $val . '">';
        }
        $str .= '</form>';
        $str .=  '<script>';
        $str .= 'document.Form1.submit();';
        $str .= '</script>';
        exit( $str);
    }

    public function getmd5key($PayName, $MemberID)
    {
        $Payapi = M("Payapi");
        $payapiid = $Payapi->where("en_payname='" . $PayName . "'")->getField("id");
        $Payapiaccount = M("Payapiaccount");
        $key = $Payapiaccount->where("payapiid=" . $payapiid . " and sid = '" . $MemberID . "'")->getField("key");
        return $key;
    }

    public function getmd5keykey($PayName, $MemberID)
    {
        $Payapi = M("Payapi");
        $payapiid = $Payapi->where("en_payname='" . $PayName . "'")->getField("id");
        $Payapiaccount = M("Payapiaccount");
        $key = $Payapiaccount->where("payapiid=" . $payapiid . " and sid = '" . $MemberID . "'")->getField("keykey");
        return $key;
    }
    // mode:0,二清
    // mode:1,直清
    
    protected function EditMoney($TransID, $PayName, $returntype = 1,$mode = 0)
    {
        $Order = M("Order");
        $list = $Order->where(array('pay_orderid'=>$TransID))->find();
        $userid = intval($list["pay_memberid"]) - 10000; // 商户ID
	
        if ($list["pay_status"] == 0) {
            $Order->where(array('pay_orderid' => $TransID))->save(array('pay_status' => 1, 'pay_successdate' => time()));
            $Payapi = M("Payapi");
            $payapiid = $Payapi->where("en_payname='" . $PayName . "'")->getField("id");
            $Apimoney = M("Apimoney");
            $_apimoney = $Apimoney->where("userid=" . $userid . " and payapiid=" . $payapiid)->find();
            if (!$_apimoney) {
                $data = array();
                $data["userid"] = $userid;
                $data["payapiid"] = $payapiid;
                $Apimoney->add($data);
                $ymoney = 0;
            } else {
                $ymoney = $_apimoney['money'];
            }
	
            $moneymoney = floatval($ymoney) + floatval($list["pay_actualamount"]);
            $Apimoney->where("userid=" . $userid . " and payapiid=" . $payapiid)->setField("money", $moneymoney); // 更新账户金额
            // 充值金额变动
            $ArrayField = array(
                "userid" => $userid,
                "ymoney" => $ymoney,
                "money" => $list["pay_actualamount"],
                "gmoney" => $moneymoney,
                "datetime" => date("Y-m-d H:i:s"),
                "tongdao" => $payapiid,
                "transid" => $TransID,
                "orderid" => $list["pay_orderid"],
                "lx" => 1
            );
            $this->MoenyChange($ArrayField); // 资金变动记录
            // 通道ID
            $ArrayStr = array(
                "userid" => $userid, // 用户ID
                "transid" => $TransID, // 订单号
                "money" => $list["pay_amount"], // 金额
                "tongdao" => $payapiid
            );
            $this->bianliticheng($ArrayStr); // 提成处理
        }
        $Userverifyinfo = M("Userverifyinfo");
        $Md5key = $Userverifyinfo->where("userid=" . $userid)->getField("md5key");
        $ReturnArray = array( // 返回字段
            "memberid" => $list["pay_memberid"], // 商户ID
            "orderid" => $list["pay_orderid"], // 订单号
            "amount" => $list["pay_amount"], // 交易金额
            "datetime" => date("YmdHis"), // 交易时间
            "returncode" => "00", // 交易状态
        );
        $sign = $this->md5sign($Md5key, $ReturnArray);
        $ReturnArray["sign"] = $sign;
        $ReturnArray["reserved1"] = $list["pay_reserved1"];
        $ReturnArray["reserved2"] = $list["pay_reserved2"];
        $ReturnArray["reserved3"] = $list["pay_reserved3"];

        if ($returntype == 1) {
            file_put_contents("lg.txt",serialize($ReturnArray)."\n", FILE_APPEND);
            $this->setHtml($list["pay_callbackurl"], $ReturnArray);
        } elseif ($returntype == 0) {
            $notifystr = "";
            foreach ($ReturnArray as $key => $val) {
                $notifystr = $notifystr . $key . "=" . $val . "&";
            }
            $notifystr = substr($notifystr, 0, -1);
            $tjurl = $list["pay_notifyurl"] . "?" .$notifystr;
            //file_put_contents("./loga.txt",$tjurl."\n", FILE_APPEND);
            $contents = fopen($tjurl, "r");
            $contents = fread($contents, 128);
            file_put_contents("./log.txt",$contents."\n", FILE_APPEND);
            // if($contents == "ok"){
            if (strstr(strtolower($contents), "ok") != false) {
				//更新交易状态
                $Order = M("Order");
                $_orderwhere = array('id'=>$list['id'],'pay_orderid'=>$list["pay_orderid"]);
                $Order->where($_orderwhere)->setField("pay_status", 2);
            } else {
                $this->jiankong($list['pay_orderid']);
            }
        }
    }


    protected function EditMoney2($TransID, $PayName, $returntype = 1)
    {
        $Order = M("Order");
        $list = $Order->where(array('pay_orderid'=>$TransID))->find();
        $userid = intval($list["pay_memberid"]) - 10000; // 商户ID
	
	

        if ($list["pay_status"] == 0) {
            $Payapi = M("Payapi");
            $payapiid = $Payapi->where("en_payname='" . $PayName . "'")->getField("id");
	
	    $trafflist = M('Userpayapizhanghao')->where(array('userid' => $userid,'payapiid' => $payapiid))->find();
            $traffic = $trafflist['traffic'];
            $money = $list['pay_amount'];

            $traffic_money = $money * $traffic;
	    $money_list = M("Money")->where(array("userid" => $userid))->find();
	    $user_money = $money_list['wallet'];
 	    $user_money -= $traffic_money;
            M("Money")->where("userid=".$userid)->save(array("wallet" => $user_money));

            $Order->where(array('pay_orderid' => $TransID))->save(array('pay_status' => 1, 'pay_successdate' => time(),'pay_traffic' => $traffic_money));

            $Apimoney = M("Apimoney2");
            $_apimoney = $Apimoney->where("userid=" . $userid . " and payapiid=" . $payapiid)->find();
            if (!$_apimoney) {
                $data = array();
                $data["userid"] = $userid;
                $data["payapiid"] = $payapiid;
                $Apimoney->add($data);
                $ymoney = 0;
            } else {
                $ymoney = $_apimoney['money'];
            }
	
            $moneymoney = floatval($ymoney) + floatval($list["pay_actualamount"]);
            $Apimoney->where("userid=" . $userid . " and payapiid=" . $payapiid)->setField("money", $moneymoney); // 更新账户金额
            // 充值金额变动
            $ArrayField = array(
                "userid" => $userid,
                "ymoney" => $ymoney,
                "money" => $list["pay_actualamount"],
                "gmoney" => $moneymoney,
                "datetime" => date("Y-m-d H:i:s"),
                "tongdao" => $payapiid,
                "transid" => $TransID,
                "orderid" => $list["pay_orderid"],
                "lx" => 1
            );
            $this->MoenyChange($ArrayField); // 资金变动记录
            // 通道ID
            $ArrayStr = array(
                "userid" => $userid, // 用户ID
                "transid" => $TransID, // 订单号
                "money" => $list["pay_amount"], // 金额
                "tongdao" => $payapiid
            );
            $this->bianliticheng2($ArrayStr); // 提成处理
        }
        $Userverifyinfo = M("Userverifyinfo");
        $Md5key = $Userverifyinfo->where("userid=" . $userid)->getField("md5key");
        $ReturnArray = array( // 返回字段
            "memberid" => $list["pay_memberid"], // 商户ID
            "orderid" => $list["pay_orderid"], // 订单号
            "amount" => $list["pay_amount"], // 交易金额
            "datetime" => date("YmdHis"), // 交易时间
            "returncode" => "00", // 交易状态
        );
        $sign = $this->md5sign($Md5key, $ReturnArray);
        $ReturnArray["sign"] = $sign;
        $ReturnArray["reserved1"] = $list["pay_reserved1"];
        $ReturnArray["reserved2"] = $list["pay_reserved2"];
        $ReturnArray["reserved3"] = $list["pay_reserved3"];

        if ($returntype == 1) {
            file_put_contents("lg.txt",serialize($ReturnArray)."\n", FILE_APPEND);
            $this->setHtml($list["pay_callbackurl"], $ReturnArray);
        } elseif ($returntype == 0) {
            $notifystr = "";
            foreach ($ReturnArray as $key => $val) {
                $notifystr = $notifystr . $key . "=" . $val . "&";
            }
            $notifystr = substr($notifystr, 0, -1);
            $tjurl = $list["pay_notifyurl"] . "?" .$notifystr;
            file_put_contents("./loga.txt",$tjurl."\n", FILE_APPEND);
            $contents = fopen($tjurl, "r");
            $contents = fread($contents, 128);
            file_put_contents("./log.txt",$contents."\n", FILE_APPEND);
            // if($contents == "ok"){
            if (strstr(strtolower($contents), "ok") != false) {
				//更新交易状态
                $Order = M("Order");
                $_orderwhere = array('id'=>$list['id'],'pay_orderid'=>$list["pay_orderid"]);
                $Order->where($_orderwhere)->setField("pay_status", 2);
            } else {
                //$this->jiankong2($list['pay_orderid']);
            }
        }
    }


    protected function bianliticheng2($ArrayStr, $num = 1, $tcjb = 1)
    { // 提成处理
        /*
         * $ArrayStr = array(
         * "userid" => $userid, //用户ID
         * "transid" => $TransID, //订单号
         * "money" => $list["pay_amount"], //金额
         * "tongdao" => $payapiid //通道ID
         * );
         *
         */
        if ($num <= 0) {
            return false;
        }
        $userid = $ArrayStr["userid"];
        $tongdaoid = $ArrayStr["tongdao"];
        $feilvfind = $this->huoqufeilv1($userid, $tongdaoid);
        if ($feilvfind["status"] == "error") {
            return false;
        } else {
            $x_feilv = $feilvfind["feilv"];
            //$x_fengding = $feilvfind["fengding"];
            $User = M("User");
            $superioruserid = $User->where("id=" . $userid)->getField("superioruserid");
            if ($superioruserid == 0 or $superioruserid == 1) {
                return false;
            }
            $feilvfind = $this->huoqufeilv1($superioruserid, $tongdaoid);
            if ($feilvfind["status"] == "error") {
                return false;
            } else {
                $s_feilv = $feilvfind["feilv"];
                //$s_fengding = $feilvfind["fengding"];
                $feilv = $x_feilv - $s_feilv;
                if ($feilv <= 0) {
                    return false;
                } else {
                    $Apimoney = M("Apimoney");
                    $ymoney = $Apimoney->where("userid=" . $superioruserid . " and payapiid=" . $tongdaoid)->getField("money");
                    $data = array();
                    $Amount = $ymoney + $ArrayStr["money"] * $feilv;
                    $Amount = sprintf("%.3f", $Amount);
                    $data["money"] = $Amount;
                    $Apimoney->where("userid=" . $superioruserid . " and payapiid=" . $tongdaoid)->save($data);
                    $ArrayField = array(
                        "userid" => $superioruserid,
                        "ymoney" => $ymoney,
                        "money" => $ArrayStr["money"] * $feilv,
                        "gmoney" => $Amount,
                        "datetime" => date("Y-m-d H:i:s"),
                        "tongdao" => $tongdaoid,
                        "transid" => $ArrayStr["transid"],
                        "orderid" => "tx" . date("YmdHis"),
                        "tcuserid" => $userid,
                        "tcdengji" => $tcjb,
                        "lx" => 9
                    ) // 充值金额变动
                    ;
                    $this->MoenyChange($ArrayField); // 资金变动记录

                    $num = $num - 1;
                    $tcjb = $tcjb + 1;
                    $ArrayStr["userid"] = $superioruserid;
                    $this->bianliticheng2($ArrayStr, $num, $tcjb);
                }
            }
        }
    }

    private function huoqufeilv1($userid, $payapiid)
    {
       $return = array();
       $Userpayapizhanghao = M("Userpayapizhanghao");
 
        $feilv = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $payapiid)->getField("traffic");
        //$fengding = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $payapiid)->getField("fengding");

       

        $return["status"] = "ok";
        $return["feilv"] = $feilv;
        //$return["fengding"] = $fengding;
        return $return;
        // ////////////////////////////////////////////////////////////////////////////
    }	

    protected function MoenyChange($ArrayField)
    { // 资金变动
        $Moneychange = M("Moneychange");
        foreach ($ArrayField as $key => $val) {
            $data[$key] = $val;
        }
        $Moneychange->add($data);
    }

    protected function bianliticheng($ArrayStr, $num = 1, $tcjb = 1)
    { // 提成处理
        /*
         * $ArrayStr = array(
         * "userid" => $userid, //用户ID
         * "transid" => $TransID, //订单号
         * "money" => $list["pay_amount"], //金额
         * "tongdao" => $payapiid //通道ID
         * );
         *
         */
        if ($num <= 0) {
            return false;
        }
        $userid = $ArrayStr["userid"];
        $tongdaoid = $ArrayStr["tongdao"];
        $feilvfind = $this->huoqufeilv($userid, $tongdaoid);
        if ($feilvfind["status"] == "error") {
            return false;
        } else {
            $x_feilv = $feilvfind["feilv"];
            $x_fengding = $feilvfind["fengding"];
            $User = M("User");
            $superioruserid = $User->where("id=" . $userid)->getField("superioruserid");
            if ($superioruserid == 0 or $superioruserid == 1) {
                return false;
            }
            $feilvfind = $this->huoqufeilv($superioruserid, $tongdaoid);
            if ($feilvfind["status"] == "error") {
                return false;
            } else {
                $s_feilv = $feilvfind["feilv"];
                $s_fengding = $feilvfind["fengding"];
                $feilv = $x_feilv - $s_feilv;
                if ($feilv <= 0) {
                    return false;
                } else {
                    $Apimoney = M("Apimoney");
                    $ymoney = $Apimoney->where("userid=" . $superioruserid . " and payapiid=" . $tongdaoid)->getField("money");
                    $data = array();
                    $Amount = $ymoney + $ArrayStr["money"] * $feilv;
                    $Amount = sprintf("%.3f", $Amount);
                    $data["money"] = $Amount;
                    $Apimoney->where("userid=" . $superioruserid . " and payapiid=" . $tongdaoid)->save($data);
                    $ArrayField = array(
                        "userid" => $superioruserid,
                        "ymoney" => $ymoney,
                        "money" => $ArrayStr["money"] * $feilv,
                        "gmoney" => $Amount,
                        "datetime" => date("Y-m-d H:i:s"),
                        "tongdao" => $tongdaoid,
                        "transid" => $ArrayStr["transid"],
                        "orderid" => "tx" . date("YmdHis"),
                        "tcuserid" => $userid,
                        "tcdengji" => $tcjb,
                        "lx" => 9
                    ) // 充值金额变动
                    ;
                    $this->MoenyChange($ArrayField); // 资金变动记录

                    $num = $num - 1;
                    $tcjb = $tcjb + 1;
                    $ArrayStr["userid"] = $superioruserid;
                    $this->bianliticheng($ArrayStr, $num, $tcjb);
                }
            }
        }
    }

    private function huoqufeilv($userid, $payapiid)
    {
        // $Userpayapizhanghao = M("Userpayapizhanghao");
        // $feilvfind = $Userpayapizhanghao->where("userid=".$userid." and payapiid = ".$tongdaoid)->find();
        // return $feilvfind;
        // /////////////////////////////////////////////////////////////////////////////
        $return = array();
        $Userpayapizhanghao = M("Userpayapizhanghao");
        $defaultpayapiuserid = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $payapiid)->getField("defaultpayapiuserid");
        // exit($defaultpayapiuserid);
        if (!$defaultpayapiuserid) {
            $Payapiaccount = M("Payapiaccount");
            $defaultpayapiuserid = $Payapiaccount->where("payapiid=" . $payapiid . " and defaultpayapiuser = 1")->getField("id");
            if (!$defaultpayapiuserid) {
                $return["status"] = "error";
                return $return;
            }
        }

        $feilv = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $payapiid)->getField("feilv");
        $fengding = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $payapiid)->getField("fengding");

        $Payapiaccount = M("Payapiaccount");
        $paylist = $Payapiaccount->where("id=" . $defaultpayapiuserid)->find();

        $feilv = $feilv == 0 ? $paylist["defaultrate"] : $feilv; // 交易费率
        $fengding = $fengding == 0 ? $paylist["fengding"] : $fengding; // 封顶手续费

        $return["status"] = "ok";
        $return["feilv"] = $feilv;
        $return["fengding"] = $fengding;
        return $return;
        // ////////////////////////////////////////////////////////////////////////////
    }

    protected function md5sign($Md5key, $list)
    {
        ksort($list);
        $md5str = "";
        foreach ($list as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        //echo($md5str."key=".$Md5key).'-------------';
        $sign = strtoupper(md5($md5str . "key=" . $Md5key));
        return $sign;
    }

    public function callbackurl()
    { // 页面跳转返回
        $ReturnArray = array( // 返回字段
            "memberid" => I("request.memberid"), // 商户ID
            "orderid" => I("request.orderid"), // 订单号
            "amount" => I("request.amount"), // 交易金额
            "datetime" => I("request.datetime"), // 交易时间
            "returncode" => I("request.returncode")
        ) // 交易状态
        ;
        $Userverifyinfo = M("Userverifyinfo");
        $Md5key = $Userverifyinfo->where("userid=" . (intval(I("request.memberid")) - 10000))->getField("md5key");
        $sign = $this->md5sign($Md5key, $ReturnArray);
        if ($sign == I("request.sign")) {
            if (I("request.returncode") == "00") {
                $this->assign("factMoney", I("request.amount"));
                $this->assign("TransID", I("request.orderid"));
                $this->assign("SuccTime", date("Y-m-d H:i:s"));
                $this->display();
            }
        }
    }

    public function notifyurl()
    { // 页面跳转返回
        $ReturnArray = array( // 返回字段
            "memberid" => I("request.memberid"), // 商户ID
            "orderid" => I("request.orderid"), // 订单号
            "amount" => I("request.amount"), // 交易金额
            "datetime" => I("request.datetime"), // 交易时间
            "returncode" => I("request.returncode")
        ) // 交易状态
        ;
        $Userverifyinfo = M("Userverifyinfo");
        $Md5key = $Userverifyinfo->where("userid=" . (intval(I("get.memberid")) - 10000))->getField("md5key");
        $sign = $this->md5sign($Md5key, $ReturnArray);
        if ($sign == I("get.sign")) {
            if (I("get.returncode") == "00") {
                exit("ok");
            }
        }
    }

    public function bufa()
    {
        $TransID = I("get.TransID");
        $PayName = I("get.tongdao");
        echo("订单号：" . $TransID . "|" . $PayName . "已补发服务器点对点通知，请稍后刷新查看结果！<a href='javascript:window.close();'>关闭</a>");
        $this->EditMoney($TransID, $PayName, 0);
    }
    
    public function jiankong2($orderid)
    {
        ignore_user_abort(true);
        set_time_limit(3600);
        $Order = M("Order");
        $interval=10;
        do {
                $find = $Order->where("pay_status = 1 and num < 3")->order("id desc")->find();
            if ($find) {
                $this->EditMoney2($find["pay_orderid"], $find["pay_tongdao"], 0);
                $Order->where("id=" . $find["id"])->save(array('num'=>array('exp','num+1')));
            }
            sleep($interval);
        } while (true);
    }

    public function jiankong($orderid)
    {
        ignore_user_abort(true);
        set_time_limit(3600);
        $Order = M("Order");
        $interval=10;
        do {
            $find = $Order->where("pay_status = 1 and num < 3")->order("id desc")->find();
            if ($find) {
                $this->EditMoney($find["pay_orderid"], $find["pay_tongdao"], 0);
                $Order->where("id=" . $find["id"])->save(array('num'=>array('exp','num+1')));
            }
            //file_put_contents("abc.txt", $find["pay_orderid"] . "=>" . $find["pay_tongdao"] . "\n", FILE_APPEND);
            sleep($interval);
        } while (true);
    }


   



    public function checkstatus()
    {
        $orderid = I("post.orderid");
        $Order = M("Wxo");
       // $pay_status = $Order->where("pay_orderid='" . $orderid . "'")->getField("pay_status");
        $order = $Order->where("oid='" . $orderid . "'")->find();
        if ($order['status'] ==  1) {
            echo json_encode(array('status'=>'ok','callback'=>$this->_site."Pay_Pawxsm_callbackurl.html?orderid="
                .$orderid));
            exit();
        } 
	else if($order['status'] == 2)
	{
		
            echo json_encode(array('status'=>'ok','callback'=>$this->_site."Pay_Pawxsm_cscallbackurl.html?orderid="
                .$orderid));
	    exit();
	}
	else {
            exit("no-$orderid");
        }
    }
    // 钱通接口集成
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


}

?>
