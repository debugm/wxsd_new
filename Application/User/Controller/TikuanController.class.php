<?php
namespace User\Controller;


class TikuanController extends UserController
{

    public function __construct()
    {
        parent::__construct();

    }


    public function sqjs()
    {
        $Userpayapi = M("Userpayapi");
        $find = $Userpayapi->where("userid=" . session("userid"))->find();


        $payapicontent = $find["payapicontent"];
        $defaultpayapi = $find["defaultpayapi"];
        $this->assign("defaultpayapi", $defaultpayapi);
        $array = explode("|", $payapicontent);
        $strarray = "";
        foreach ($array as $key => $val) {
            $strarray = "'" . $val . "'," . $strarray;
        }
        $strarray = $strarray . "''";
	
        $Payapi = M("Payapi");
        //$apilist = $Payapi->where("en_payname in (" . $strarray . ") and mode=1")->select();
        $apilist = $Payapi->where(array('en_payname' => 'Pawxsm'))->select();
        $this->assign("apilist", $apilist);
        // ////////////////////////////////////////////////////////////////////////////
        $Tikuanconfig = M("Tikuanconfig");


        $TikuanconfigList = $Tikuanconfig->where("websiteid=" . session("websiteid") . " and userid=" . session("userid"))->find();

      file_put_contents('./log.txt',json_encode($TikuanconfigList).'\n',FILE_APPEND);
        if (! $TikuanconfigList) {
            $data = array();
            $data["userid"] = session('userid');
            $data["websiteid"] = 0;
            $Tikuanconfig->add($data);
            $TikuanconfigList = $Tikuanconfig->where("websiteid=" . session("websiteid") . " and userid=0")->find();
        } else {
            if ($TikuanconfigList["systemxz"] == 0) {
                $TikuanconfigList = $Tikuanconfig->where("websiteid=" . session("websiteid") . " and userid=0")->find();
            }
        }
        
        //获取提款银行
        $Bankcard = M("Bankcard");
        $bankfind = $Bankcard->where("userid=" . session("userid"))->find();
        $tkbankname = $bankfind["bankname"] . "(****" . substr($bankfind["banknumber"], - 4, 4) . ")";
        $this->assign("tkbankname", $tkbankname);
        if ($bankfind["bankfullname"] and $bankfind["banknumber"] and $bankfind["bankname"] and $bankfind["shi"] and $bankfind["sheng"]) {
            $tkbankfullstr = '<button class="btn btn-primary" style="margin-left:20px;" id="sqjsbutton" ajaxurl="' . U("Tikuan/tksq") . '"   data-loading-text="正在处理..." >申请结算</button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-default" style="margin-left:20px;"  onclick=javascript:window.location.href="' . U("Tikuan/sqjs") . '">返 回</button>';
        } else {
            $tkbankfullstr = '请先完善结算银行信息再申请提款!';
        }
        $this->assign("tkbankfullstr", $tkbankfullstr);

        //判断结算功能是否可用
        $tikuantype = "";
        $statustikuan = 0;
        $array = $this->tkztpd();
        
        $tikuantype = $array["tikuantype"];
        $statustikuan = $array["statustikuan"];
        
        $tkdatetime = "结算时间：白天：<span style='color:#f00;'>" . $array["baiks"] . "点 至 " . $array["baijs"] . "点</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;晚上：<span style='color:#f00;'>" . $array["wanks"] . "点 至 " . $array["wanjs"] . "点</span>";
        
        if ($TikuanconfigList["tkzt"] == 1) {
            if ($statustikuan == 0) {
                $TikuanconfigList["tkzt"] = 0;
                $TikuanconfigList["tkztstr"] = "此时段禁止申请结算," . $tkdatetime;
            } else {
                $t = I("request.t", "");
                if ($t == "") {
                    
                    $TikuanconfigList["tkzt"] = 0;
                    $lsbuttonstr = '';
                    if ($TikuanconfigList["t1zt"] == 1) {
                        $lsbuttonstr = '<button class="btn btn-primary" style="margin-left:20px;"  onclick=javascript:window.location.href="' . U("Tikuan/sqjs", "t=1") . '">T + 1结算</button>';
                    }
                    if ($TikuanconfigList["t0zt"] == 1) {
                        $lsbuttonstr .= '&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" style="margin-left:20px;"  onclick=javascript:window.location.href="' . U("Tikuan/sqjs", "t=0") . '">T + 0结算</button>';
                    }
                    
                    if ($lsbuttonstr == "") {
                        $lsbuttonstr = "T+1 与 T+0 已关闭";
                    }
                    $TikuanconfigList["tkztstr"] = $lsbuttonstr;
                } else {
                    if ($TikuanconfigList["t" . $t . "zt"] == 0) {
                        $TikuanconfigList["tkzt"] = 0;
                        $TikuanconfigList["tkztstr"] = "T+" . $t . "已关闭";
                    }
                }
            }
        } else {
            
            $TikuanconfigList["tkztstr"] = "结算功能已关闭" . $tkdatetime;
        }
        
        $this->assign("tikuanconfiglist", $TikuanconfigList);
        $this->assign("tkdatetime", $tkdatetime);
        $this->assign("tikuantype", $tikuantype);
        // /////////////////////////////////////判断结算功能是否可用///////////////////////////////////////////////
        $this->display();
    }

    public function tongdaofeilv()
    {
        $tongdaoid = I("request.tongdaoid", "");
        if(!$tongdaoid){
            $this->ajaxReturn(['str'=>'<span class="text-danger">结算通道不存在</span>','sxfmoney'=>0,'sxftype'=>'','yuemoney'=>0]);
        }
        $tikuantype = I("request.tikuantype");
        $t = I("request.t");

        //个人提款设置
        $selftkconfig = M('Tikuanconfig')->where(['website'=>0,'userid'=>session('userid'),'tkzt'=>1])->find();
        $sytemtkconfig = M('Tikuanconfig')->where(['website'=>0,'userid'=>0,'tkzt'=>1])->find();
        if((!$selftkconfig && $selftkconfig['systemxz']) || !$sytemtkconfig){
            $this->error('未开启提款');
        }

        //提款规则
        if($selftkconfig['systemxz'] && $selftkconfig['tkzt']){
            //个人规则
            //单笔最小提款金额
            $tkzxmoney = $selftkconfig['tkzxmoney'];
            //单笔最大提款金额
            $tkzdmoney =  $selftkconfig['tkzdmoney'];
            //当日最大总金额
            $dayzdmoney =  $selftkconfig['dayzdmoney'];
            //总次数
            $dayzdnum = $selftkconfig['dayzdnum'];

            //今日总金额，总次数
            //$todaytknum = M('Tikuanmoney')->where(['website'=>0,'userid'=>session('userid'),'createtime'>strtotime('today')])->count();
            //$todaytksum  = M('Tikuanmoney')->where(['website'=>0,'userid'=>session('userid'),'createtime'>strtotime('today')])->sum('money');

            //结算费率
            $sxfrate = $selftkconfig['sxfrate'];
            $sxffixed  = $selftkconfig['sxffixed'];
            //结算类型
            $tktype = $selftkconfig['tktype'];
        }else{
            //系统规则
            //单笔最小提款金额
            $tkzxmoney = $sytemtkconfig['tkzxmoney'];
            //单笔最大提款金额
            $tkzdmoney = $sytemtkconfig['tkzdmoney'];
            //当日最大总金额
            $dayzdmoney = $sytemtkconfig['dayzdmoney'];
            //总次数
            $dayzdnum = $sytemtkconfig['dayzdnum'];

            //今日总金额，总次数
            //$todaytknum = M('Tikuanmoney')->where(['website'=>0,'userid'=>session('userid'),'createtime'>strtotime('today')])->count();
            //$todaytksum  = M('Tikuanmoney')->where(['website'=>0,'userid'=>session('userid'),'createtime'>strtotime('today')])->sum('money');

            //结算费率
            $sxfrate = $sytemtkconfig['sxfrate'];
            $sxffixed  = $sytemtkconfig['sxffixed'];

            //结算类型
            $tktype = $sytemtkconfig['tktype'];
        }

        if ($tktype == 1) {
            $tktypestr = "手续费按每笔<span style='color:#f00'>".$sxffixed. "</span>元收取";
        } else {
            $tktypestr = "手续费按结算金额的<span style='color:#f00'>" . $sxfrate . "%</span>收取";
        }

        $array = array();
        $array["str"] = $tktypestr;
        $array["sxfmoney"] = $tktype ? $sxffixed : $sxfrate/100;
        $array["sxftype"] = $tktype;
        $Apimoney = M("Apimoney2");
        $yuemoney = $Apimoney->where("userid=" . session("userid") . " and payapiid=" . $tongdaoid)->getField("money");
        $array["yuemoney"] = del0($yuemoney);
        $this->ajaxReturn($array);
    }
    /*   
    public function tktest()
    {
         					    $Tklist = M("Tklist");
                                                    $data = array();
                                                    $data["bankname"] = "ttt";
                                                    $data["bankfenname"] = "ttt";
                                                    $data["bankzhiname"] = "ttt";
                                                    $data["banknumber"] = "tttttttt";
                                                    $data["bankfullname"] = "tttttt";
                                                    $data["sheng"] = "ttttt";
                                                    $data["shi"] = "tttt";
                                                    $data["userid"] = "tttt";
                                                    $data["sqdatetime"] = date("Y-m-d H:i:s");
                                                    $data["status"] = 0;
                                                    $data["tkmoney"] = "1";
                                                    $data["sxfmoney"] = "341222";
                                                    $data["t"] = "1";
                                                    $data["money"] = "1.1";
                                                    $data["payapiid"] = "IntQQ";
						    echo $Tklist->add($data);
						

    }*/
    public function tksq()
    {
        if(IS_POST){
        $tongdaoid = I("request.tongdaoid");
        $jsmoney = I("request.jsmoney");
        $jsmoney = sprintf("%.2f", $jsmoney);
        $t = I("request.t", "");
        $paypassword = I("request.paypassword", "");
        if ($tongdaoid == "" || $jsmoney == "" || $jsmoney == 0 || $paypassword == "") {
            exit("systemerror"); // 非法提交数据
        } else {
            $Userpassword = M("Userpassword");
            $count = $Userpassword->where("userid=" . session("userid") . " and paypassword='" . md5($paypassword) . "'")->count();
            if ($count <= 0) {
                exit("paypassworderror"); // 支付密码错误
            } else {
                $selftkconfig = M('Tikuanconfig')->where(['website'=>0,'userid'=>session('userid')])->find();
                $sytemtkconfig = M('Tikuanconfig')->where(['website'=>0,'userid'=>0])->find();
                if(!$selftkconfig || !$selftkconfig['systemxz']){
                    $TikuanconfigList = $sytemtkconfig;
                }else{
                    $TikuanconfigList = $selftkconfig;
                }

                //提款时间限制
                $array = $this->tkztpd();
                if ($TikuanconfigList["tkzt"] == 1) {
                    if ($array["statustikuan"] == 0) {
                        exit("errorguanbi"); // 结算功能已关闭
                    } else {
                        //判断结算金额
                        $Apimoney = M("Apimoney2");
                        $yuemoney = $Apimoney->where("userid=" . session("userid") . " and payapiid=" . $tongdaoid)->getField("money");
                        if ($yuemoney < $jsmoney) {
                            exit("errormoney1"); // 余额不足
                        } else {

                            //计算提款手续费
                            if ($TikuanconfigList["tktype"] == 1) {
                                $sxf = $TikuanconfigList['sxffixed'];
                            } else {
                                $sxf = $jsmoney * ($TikuanconfigList['sxfrate']/100);
                            }
                            $sxf = sprintf("%.2f", $sxf);
                            if ($jsmoney < $sxf) {
                                exit("errormoney2"); // 结算金额不够支付手续费
                            } else {
                                if ($jsmoney < $TikuanconfigList["tkzxmoney"]) {
                                    exit("errormoney3"); // 单笔结算金额不能小于XX金额
                                } else {
                                    if ($jsmoney > $TikuanconfigList["tkzdmoney"]) {
                                        exit("errormoney4"); // 单笔结算金额大于XX金额
                                    } else {
                                        $Tklist = M("Tklist");
                                        $tkdaysummoney = $Tklist->where("userid=" . session("userid") . " and DATEDIFF('" . date("Y-m-d") . "',sqdatetime)")->sum("money");
                                        if (($tkdaysummoney + $jsmoney) > $TikuanconfigList["dayzdmoney"]) {
                                            exit("errormoney5"); // 结算金额超过今天系统设置最大金额
                                        } else {
                                            $tkdaysumcount = $Tklist->where("userid=" . session("userid") . " and DATEDIFF('" . date("Y-m-d") . "',sqdatetime)")->count();
                                            if ($tkdaysumcount >= $TikuanconfigList["dayzdnum"]) {
                                                exit("errormoney6"); // 已超过今天结算最大次数
                                            } else {
                                                $Bankcard = M("Bankcard");
                                                $bankfind = $Bankcard->where("userid=" . session("userid"))->find();
                                                if (empty($bankfind['bankfullname']) || empty($bankfind["bankzhiname"])|| empty($bankfind["banknumber"])|| empty($bankfind["bankname"])|| empty($bankfind["shi"]) ||empty($bankfind["sheng"])) {
                                                    exit("errorbank"); // 请完善结算银行信息后再申请提现
                                                }
                                                //正式处理结算的数据处理
                                                $Apimoney = M("Apimoney2");
                                                $data = array();
                                                $data["money"] = sprintf("%.2f", ($yuemoney - $jsmoney));
						$Apimoney->where("userid=" . session("userid") . " and payapiid=" . $tongdaoid)->save($data);
						if(1){
                                                    //写入提款记录
                                                    $Tklist = M("Tklist");
                                                    $data = array();
                                                    $data["bankname"] = $bankfind["bankname"];
                                                    $data["bankfenname"] = $bankfind["bankfenname"];
                                                    $data["bankzhiname"] = $bankfind["bankzhiname"];
                                                    $data["banknumber"] = $bankfind["banknumber"];
                                                    $data["bankfullname"] = $bankfind["bankfullname"];
                                                    $data["sheng"] = $bankfind["sheng"];
                                                    $data["shi"] = $bankfind["shi"];
                                                    $data["userid"] = $bankfind["userid"];
                                                    $data["sqdatetime"] = date("Y-m-d H:i:s");
                                                    $data["status"] = 0;
                                                    $data["tkmoney"] = $jsmoney;
                                                    $data["sxfmoney"] = $sxf;
                                                    $data["t"] = $t;
                                                    $data["money"] = sprintf("%.2f", ($jsmoney - $sxf));
                                                    $data["payapiid"] = $tongdaoid;
						    $tkid = $Tklist->add($data);
                                                    if ($tkid) {
                                                        $ArrayField = array(
                                                            "userid" => session("userid"),
                                                            "ymoney" => $yuemoney,
                                                            "money" => $jsmoney * (- 1),
                                                            "gmoney" => ($yuemoney - $jsmoney),
                                                            "datetime" => date("Y-m-d H:i:s"),
                                                            "tongdao" => $tongdaoid,
                                                            "transid" => "",
                                                            "orderid" => "",
                                                            "lx" => 6
                                                        ); // 提款
                                                        $Moneychange = M("Moneychange");
                                                        foreach ($ArrayField as $key => $val) {
                                                            $data[$key] = $val;
                                                        }
                                                        $Moneychange->add($data);
							//$this->autoTikuan($tkid,1);
                                                        exit("ok");
                                                    }
                                                } else {
                                                    exit("errorkouquan"); // 扣款失败
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    exit("errorguanbi"); // 结算功能已关闭
                }
            }
        }
        }
    }

    public function test()
    {
	$useraccount = M("Userbankaccount");
	
	$record = $useraccount->where('userid=81')->select();
	var_dump($record);
    }
    private function autoTikuan($id,$status)
    {
        $notifyurl = $this->_site . 'Admin_Tikuan_intnotifyurl.html'; 
        if ($id == "" or $status == "") {
            exit("no");
        } else {
            $Tklist = M("Tklist");
            $tk_record = $Tklist->where("id=" . $id)->find();
            file_put_contents('./log.txt', date("Y-m-d H:i:s").json_encode($tk_record)."--daifu-request\n",FILE_APPEND);

            $payapiid = $tk_record['payapiid'];
            $payapi = M("Payapiaccount");
            $payapi_record = $payapi->where("payapiid=".$payapiid)->find();
            $merchant_id = $payapi_record['sid'];
            
            $user_id = $tk_record['userid'];
            $user_info = M('Userbasicinfo')->where("userid=".$user_id)->find();

        
			$url = "http://scpay.shopping98.com/v1/gateway.shtml";
			$mch_id = "688544019374055424";
			$key = "5ed95554b08845568a793d4c3171d911";
				switch($tk_record['bankname'])
				{
						case "中信银行":
							$bank_code = "302";
						break;
						case "中国银行":
							$bank_code = "104";
						break;
						case "浙商银行":
							$bank_code = "316";
						break;
						case "招商银行":
							$bank_code = "308";
						break;
						case "中国邮政储蓄银行":
							$bank_code = "403";
						break;
						case "兴业银行":
							$bank_code = "309";
						break;
						case "深圳发展银行":
							$bank_code = "307";
						break;
						case "上海浦东发展银行":
							$bank_code = "310";
						break;
						case "中国农业银行":
							$bank_code = "103";
						break;
						case "中国民生银行":
							$bank_code = "305";
						break;
						case "交通银行":
							$bank_code = "301";
						break;
						case "中国建设银行":
							$bank_code = "105";
						break;
						case "华夏银行":
							$bank_code = "304";
						break;
						case "广发银行":
							$bank_code = "306";
						break;
						case "中国光大银行":
							$bank_code = "303";
						break;
						case "中国工商银行":
							$bank_code = "102";
						break;
						case "东亚银行":
							$bank_code = "502";
						break;
					}
			$p = array(
				'service' =>'v1_liquidation_pay',
				'version' =>'1.0',
				'merchant_no' =>$mch_id,
				'charset' =>'UTF-8',
				'req_time' =>date('YmdHis'),
				'nonce_str' =>time(),
				'out_trade_no' =>$id."#".date('YmdHis'), 
				'amount' => $tk_record['money'] * 100,
				"account_no" => $tk_record['banknumber'],
				"account_name" => $tk_record['bankfullname'],
				"bank_code" => $bank_code,
				"id_type" => "0",
				"id" => $user_info['sfznumber'],
				'notify_url' =>$notifyurl,
				'client_ip' => '122.114.184.166',
				'order_time' => date('YmdHis'),
			);

			$s = "";
			ksort($p);

			foreach($p as $k => $v)
			{
				$s .= $k . "=" .$v . "&";
			}

			$s = substr($s,0,strlen($s)-1); 

			$s .= $key;
			//echo $s.'<br>';
			$sign = md5($s);
			//echo $sign;exit();
			$p['sign'] = $sign;
			$p['sign_type'] = 'MD5';
			$s = "";
			ksort($p);
			foreach($p as $k => $v)
			{
				$s .= $k . "=" .$v . "&";
			}
			$s = substr($s,0,strlen($s)-1); 
			//print_r($s);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $s);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($ch);

			$result = json_decode($result,true);
			//print_r($result);
					
			file_put_contents("./log.txt",date("Y-m-d H:i:s").json_encode($result)."--daifu-result\n",FILE_APPEND);
            //检查钱通返回是否正确，如果不正确，则代付失败，保存该失败纪录
            if($result['resp_code'] != '0000')
            {
                $fail = array();

                $fail['payapiid'] = $payapiid;
                $fail['userid'] = $user_id;
                $fail['dfid'] = $id;
                $fail['failed_reason'] = json_encode($result);

                M('dffailed')->add($fail);
                $status = 3;

            }


            if($result["resp_code"] == "0000")
	    {
                if($result["trans_status"] == "S")
	            $status = 2;
		if($result["trans_status"] == "P")
	            $status = 1;
		if($result["trans_status"] == "F")
	            $status = 3;
	    }
            $data = array();
            $data["status"] = $status;
            if ($status == 2) {
                $data["cldatetime"] = date("Y-m-d H:i:s");
            }
            $Tklist->where("id=" . $id)->save($data);
            exit("ok");
        }
    }

    private function tkztpd()
    {
        $tikuantype = "";
        $statustikuan = 0;
        $Tikuandateconfig = M("Tikuandateconfig");
        $tkdatefind = $Tikuandateconfig->where("websiteid=" . session("websiteid"))->find();
        $baiks = $tkdatefind["baiks"];
        if ($baiks == 24) {
            $baiks = 0;
        }
        $baijs = $tkdatefind["baijs"];
        $wanks = $tkdatefind["wanks"];
        $wanjs = $tkdatefind["wanjs"];
        $w = date("w");
        $h = intval(date("H"));
        
        if ($w == 6 || $w == 0) { // 如果当天为星期六或星期天
            $Pcjjr = M("Pcjjr");
            $count = $Pcjjr->where("datetime = '" . date("Y-m-d") . "'")->count();
            if ($count > 0) { // 如果被排除掉节假日
                if ($h >= $baiks && $h <= $baijs) {
                    $tikuantype = "b";
                    $statustikuan = 1;
                } else {
                    $tikuantype = "w";
                    if (($h >= $wanks and $h <= $wanjs) or ($h >= $wanks and $wanjs <= $wanks and $h >= $wanjs) or ($h <= $wanks and $wanjs <= $wanks and $h <= $wanjs)) {
                        $statustikuan = 1;
                        $tikuantype = "w";
                    } else {
                        $statustikuan = 0;
                    }
                }
            } else {
                $tikuantype = "j";
                if ($h >= $baiks && $h <= $baijs) {
                    // $tikuantype = "b";
                    $statustikuan = 1;
                } else {
                    // ///////////////////////////////////////////////////
                    // $tikuantype = "w";
                    if (($h >= $wanks and $h <= $wanjs) or ($h >= $wanks and $wanjs <= $wanks and $h >= $wanjs) or ($h <= $wanks and $wanjs <= $wanks and $h <= $wanjs)) {
                        $statustikuan = 1;
                    } else {
                        $statustikuan = 0;
                    }
                    // //////////////////////////////////////////////////
                    /*
                     * if($h >= $wanks && $h <= $wanjs){
                     * $statustikuan = 1;
                     * }else{
                     * $statustikuan = 0;
                     * }
                     */
                }
            }
        } else {
            $Tjjjr = M("Tjjjr");
            $count = $Tjjjr->where("datetime='" . date("Y-m-d") . "'")->count();
            if ($count > 0) {
                $tikuantype = "j";
                if ($h >= $baiks && $h <= $baijs) {
                    // $tikuantype = "b";
                    $statustikuan = 1;
                } else {
                    // $tikuantype = "w";
                    if (($h >= $wanks and $h <= $wanjs) or ($h >= $wanks and $wanjs <= $wanks and $h >= $wanjs) or ($h <= $wanks and $wanjs <= $wanks and $h <= $wanjs)) {
                        $statustikuan = 1;
                    } else {
                        $statustikuan = 0;
                    }
                }
            } else {
                if ($h >= $baiks && $h <= $baijs) {
                    $tikuantype = "b";
                    $statustikuan = 1;
                } else {
                    // ///////////////////////////////////////////////////
                    // echo($h."------".$wanks."----------".$wanjs."------------");
                    if (($h >= $wanks and $h <= $wanjs) or ($h >= $wanks and $wanjs <= $wanks and $h >= $wanjs) or ($h <= $wanks and $wanjs <= $wanks and $h <= $wanjs)) {
                        $statustikuan = 1;
                        $tikuantype = "w";
                    } else {
                        $statustikuan = 0;
                    }
                    // //////////////////////////////////////////////////
                    /*
                     * if($h >= $wanks && $h <= $wanjs){
                     * $tikuantype = "w";
                     * $statustikuan = 1;
                     * }else{
                     * $statustikuan = 0;
                     * }
                     */
                }
            }
        }
        
        $array = array();
        $array["tikuantype"] = $tikuantype;
        $array["statustikuan"] = $statustikuan;
        $array["baiks"] = $baiks;
        $array["baijs"] = $baijs;
        $array["wanks"] = $wanks;
        $array["wanjs"] = $wanjs;
        return $array;
    }

    public function tklist()
    {
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->select();
        $this->assign("tongdaolist", $tongdaolist); // 通道列表
        
        $Systembank = M("Systembank");
        $banklist = $Systembank->select();
        $this->assign("banklist", $banklist); // 银行列表
        
        $where = array();
        $where[0] = "userid=" . session("userid");
        $i = 1;
        
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
        
        $list = $this->lists("Tklist", $where);
        $this->assign("list", $list);
        $this->display();
    }
    
    public function wttklist()
    {
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->select();
        $this->assign("tongdaolist", $tongdaolist); // 通道列表
    
        $Systembank = M("Systembank");
        $banklist = $Systembank->select();
        $this->assign("banklist", $banklist); // 银行列表
    
        $where = array();
        $where[0] = "userid=" . session("userid");
        $i = 1;
    
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
    
        $list = $this->lists("Wttklist", $where);
        $this->assign("list", $list);
        $this->display();
    }
    
    
    public function dflist()
    {
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->select();
        $this->assign("tongdaolist", $tongdaolist); // 通道列表
    
        $Systembank = M("Systembank");
        $banklist = $Systembank->select();
        $this->assign("banklist", $banklist); // 银行列表
    
        $where = array();
        $where[0] = "userid=" . session("userid");
        $i = 1;
    
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
    
    public function wtjs(){
        $Userpayapi = M("Userpayapi");
        $find = $Userpayapi->where("userid=" . session("userid"))->find();
        $payapicontent = $find["payapicontent"];
        $defaultpayapi = $find["defaultpayapi"];
        $this->assign("defaultpayapi", $defaultpayapi);
        $array = explode("|", $payapicontent);
        $strarray = "";
        foreach ($array as $key => $val) {
            $strarray = "'" . $val . "'," . $strarray;
        }
        $strarray = $strarray . "''";
        $Payapi = M("Payapi");
        $apilist = $Payapi->where("en_payname in (" . $strarray . ")")->select();
        $this->assign("apilist", $apilist);
        
        $this->display();
    }
    
    public function dfjs(){
        $Userpayapi = M("Userpayapi");
        $find = $Userpayapi->where("userid=" . session("userid"))->find();
        $payapicontent = $find["payapicontent"];
        $defaultpayapi = $find["defaultpayapi"];
        $this->assign("defaultpayapi", $defaultpayapi);
        $array = explode("|", $payapicontent);
        $strarray = "";
        foreach ($array as $key => $val) {
            $strarray = "'" . $val . "'," . $strarray;
        }
        $strarray = $strarray . "''";
        $Payapi = M("Payapi");
        $apilist = $Payapi->where("en_payname in (" . $strarray . ")")->select();
        $this->assign("apilist", $apilist);
    
        $this->display();
    }
    
    public function dfjsupload(){    //代付处理
        $selecttongdao = I("post.selecttongdao","");
        if($selecttongdao == ""){
            $this->error("请选择结算通道");
            return;
        }
        
        $selectlx = I("post.selectlx","");
        if($selectlx == ""){
            $this->error("请择结算类型");
        }
        
        $paypassword = I("post.paypassword","");
        $Userpassword = M("Userpassword");
        $count = $Userpassword->where("userid=" . session("userid") . " and paypassword='" . md5($paypassword) . "'")->count();
        if($count<=0){
            $this->error("支付密码错误");
        }
        
        $Tikuanconfig = M("Tikuanconfig");
        $TikuanconfigList = $Tikuanconfig->where("websiteid=" . session("websiteid") . " and userid=" . session("userid"))->find();
        if (! $TikuanconfigList) {
            $data = array();
            $data["userid"] = session("userid");
            $data["websiteid"] = 0;
            $Tikuanconfig->add($data);
            $TikuanconfigList = $Tikuanconfig->where("websiteid=" . session("websiteid") . " and userid=0")->find();
        } else {
            if ($TikuanconfigList["systemxz"] == 0) {
                $TikuanconfigList = $Tikuanconfig->where("websiteid=" . session("websiteid") . " and userid=0")->find();
            }
        }
        
        
        $array = $this->tkztpd();
        if ($TikuanconfigList["tkzt"] == 1) {
            if ($array["statustikuan"] == 0) {
                $this->error("结算功能已关闭");
            }else{
                $tongdaoid = $selecttongdao;
                $t = $selectlx;
                $Tikuanmoney = M("Tikuanmoney");
                $money = $Tikuanmoney->where("userid=" . session("userid") . " and websiteid=" . session("websiteid") . " and payapiid=" . $tongdaoid . " and datetype='" . $array["tikuantype"] . "' and t=" . $t)->getField("money");
                if (! isset($money)) {
                    $data = array();
                    $data["userid"] = session("userid");
                    $data["websiteid"] = session("websiteid");
                    $data["payapiid"] = $tongdaoid;
                    $data["t"] = $t;
                    $Tikuanmoney->add($data);
                    $money = $Tikuanmoney->where("userid=" . session("userid") . " and websiteid=" . session("websiteid") . " and payapiid=" . $tongdaoid . " and datetype='" . $array["tikuantype"] . "' and t=" . $t)->getField("money");
                }
        
                if ($money == 0) {
                    $money = $Tikuanmoney->where("userid=0 and websiteid=" . session("websiteid") . " and payapiid=" . $tongdaoid . " and datetype='" . $array["tikuantype"] . "' and t=" . $t)->getField("money");
                }
        
                if ($TikuanconfigList["tktype"] == 1) {
                    $sxf = $money;
                    $sxflx  = 1;  //单笔手续费
                } else {
                    $sxf = $money;
                    $sxflx  = 2; //费率手续费
                }
                //$sxf = sprintf("%.2f", $sxf);
                ///////////////////////////////////////////////////////////////////////////
                $upload = new \Think\Upload(); // 实例化上传类
                $upload->maxSize = 2097152; // 设置附件上传大小
                $upload->exts = array(
                    'xls'
                ); // 设置附件上传类型
                $upload->savePath = './dfjsupload/'; // 设置附件上传目录
                // 上传文件
                $info = $upload->uploadOne($_FILES["fieldsname"]);
                if (! $info) { // 上传错误提示错误信息
                    $this->error($upload->getError());
                } else { // 上传成功
                    $summoney = $this->exceldf("./Uploads/dfjsupload/".$info['savename'],1);
                    $Apimoney = M("Apimoney");
                    $tongdaosummoney = $Apimoney->where("userid=".session("userid")." and payapiid=".$selecttongdao)->getField("money");
                    if($tongdaosummoney < $summoney){
                        unlink("./Uploads/dfjsupload/".$info['savename']);
                        $this->error("<span style='color:#f00;'>通道结算余额不足！</span>结算通道余额<span style='color:#093'>".$tongdaosummoney."元</span>,代付结算总金额<span style='color:#093'>".$summoney."元</span>","",30);
                        return;
                    }else{
                        $this->exceldf("./Uploads/dfjsupload/".$info['savename'], 2, $t, $tongdaoid, $sxf, $sxflx);
                    }
                }
                //////////////////////////////////////////////////////////////////////////
            }
        }else{
            $this->error("此时段已关闭申请结算");
        }
        
    }
    
    public function wtjsupload()
    {
        $selecttongdao = I("post.selecttongdao","");
        if($selecttongdao == ""){
            $this->error("请选择结算通道");
            return;
        }
        
        $selectlx = I("post.selectlx","");
        if($selectlx == ""){
            $this->error("请择结算类型");
        }
        
        $paypassword = I("post.paypassword","");
        $Userpassword = M("Userpassword");
        $count = $Userpassword->where("userid=" . session("userid") . " and paypassword='" . md5($paypassword) . "'")->count();
        if($count<=0){
            $this->error("支付密码错误");
        }
        
        $Tikuanconfig = M("Tikuanconfig");
        $TikuanconfigList = $Tikuanconfig->where(["websiteid"=>session("websiteid"),"userid"=>session("userid")])->find();
        if (! $TikuanconfigList ) {
            $data = array();
            $data["userid"] = session("userid");
            $data["websiteid"] = 0;
            $Tikuanconfig->add($data);
            //使用系统规则
            $TikuanconfigList = $Tikuanconfig->where(["websiteid"=>session("websiteid"),"userid"=>0])->find();
        } else {
            if (!$TikuanconfigList["systemxz"]) {
                $TikuanconfigList = $Tikuanconfig->where("websiteid=" . session("websiteid") . " and userid=0")->find();
            }
        }
        $array = $this->tkztpd();
        if ($TikuanconfigList["tkzt"]) {
            if ($array["statustikuan"] == 0) {
                $this->error("结算功能已关闭");
            }else{
                $tongdaoid = $selecttongdao;
                $t = $selectlx;
                $sxf = $sxflx  = '';
                if ($TikuanconfigList["tktype"]) {
                    $sxf = $TikuanconfigList['sxffixed'];
                    $sxflx  = 1;  //单笔手续费
                } else {
                    $sxf = $TikuanconfigList['sxfrate'];
                    $sxflx  = 2; //费率手续费
                }
                //$sxf = sprintf("%.2f", $sxf);
                $upload = new \Think\Upload(); // 实例化上传类
                $upload->maxSize = 2097152; // 设置附件上传大小
                $upload->exts = array(
                    'xls'
                ); // 设置附件上传类型
                $upload->savePath = './wtjsupload/'; // 设置附件上传目录
                // 上传文件
                $info = $upload->uploadOne($_FILES["fieldsname"]);
                if (! $info) { // 上传错误提示错误信息
                    $this->error($upload->getError());
                } else {
                    // 上传成功
                    $summoney = $this->excel("./Uploads/wtjsupload/".$info['savename'],1);
                    $Apimoney = M("Apimoney");
                    $tongdaosummoney = $Apimoney->where("userid=".session("userid")." and payapiid=".$selecttongdao)->getField("money");
                    if($tongdaosummoney < $summoney){
                        unlink("./Uploads/wtjsupload/".$info['savename']);
                        $this->error("<span style='color:#f00;'>通道结算余额不足！</span>结算通道余额<span style='color:#093'>".$tongdaosummoney."元</span>,委托结算总金额<span style='color:#093'>".$summoney."元</span>","",30);
                        return;
                    }else{
                        $this->excel("./Uploads/wtjsupload/".$info['savename'], 2, $t, $tongdaoid, $sxf, $sxflx);
                    }
                }
            }
        }else{
            $this->error("此时段已关闭申请结算");
        }
    }
    
    public function excel($filePath,$a,$t,$paypaiid,$sxf,$sxflx){
    
        vendor("PHPExcel.PHPExcel");
    
        //$filePath = "Book1.xls";
        //建立reader对象
        $PHPReader = new \PHPExcel_Reader_Excel2007();
        if(!$PHPReader->canRead($filePath)){
            $PHPReader = new \PHPExcel_Reader_Excel5();
            if(!$PHPReader->canRead($filePath)){
                echo 'no Excel';
                return ;
            }
        }

        //建立excel对象，此时你即可以通过excel对象读取文件，也可以通过它写入文件
        $PHPExcel = $PHPReader->load($filePath);
    
        /**读取excel文件中的第一个工作表*/
        $currentSheet = $PHPExcel->getSheet(0);
        /**取得最大的列号*/
        $allColumn = $currentSheet->getHighestColumn();
        /**取得一共有多少行*/
        $allRow = $currentSheet->getHighestRow();
         
        $summoney = 0;  //总金额
        
        switch ($a){
            case 1:   //获取总金额
                //循环读取每个单元格的内容。注意行从1开始，列从A开始
                for($rowIndex=2;$rowIndex<=$allRow;$rowIndex++){
                    for($colIndex='A';$colIndex<=$allColumn;$colIndex++){
                        $addr = $colIndex.$rowIndex;
                        $cell = $currentSheet->getCell($addr)->getValue();
                        if($cell instanceof PHPExcel_RichText){     //富文本转换字符串
                            $cell = $cell->__toString();
                        }
                        if($colIndex == "G"){
                            $summoney = $summoney + floatval($cell);
                        }
                    }
                }
                return  $summoney;
                break;
            case 2:
                //循环读取每个单元格的内容。注意行从1开始，列从A开始
                for($rowIndex=2;$rowIndex<=$allRow;$rowIndex++){
                    //金额
                    $addr = "G".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //富文本转换字符串
                        $cell = $cell->__toString();
                    }
                    $tkmoney = floatval($cell);
                    $tkmoney = sprintf("%.2f", $tkmoney);
                    $sxfmoney = 0;

                    if($sxflx == 1){
                        $sxfmoney = $sxf;
                    }else{
                        $sxfmoney = $tkmoney * ($sxf/100);
                    }

                    $sxfmoney = sprintf("%.2f", $sxfmoney);
                    ($tkmoney-$sxfmoney)>0 ? $money=($tkmoney-$sxfmoney): $money = 0; //实际到账金额

                    //银行名称
                    $addr = "A".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //富文本转换字符串
                        $cell = $cell->__toString();
                    }
                    $bankname = $cell;

                    //支行名称
                    $addr = "B".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //富文本转换字符串
                        $cell = $cell->__toString();
                    }
                    $bankzhiname = $cell;

                    //开户名
                    $addr = "C".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //富文本转换字符串
                        $cell = $cell->__toString();
                    }
                    $bankfullname = $cell;

                    //银行账号
                    $addr = "D".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //富文本转换字符串
                        $cell = $cell->__toString();
                    }
                    $banknumber = $cell;

                    //所在省
                    $addr = "E".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //富文本转换字符串
                        $cell = $cell->__toString();
                    }
                    $sheng = $cell;

                    //所在市
                    $addr = "F".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //富文本转换字符串
                        $cell = $cell->__toString();
                    }
                    $shi = $cell;

                    if(!is_numeric($banknumber)){
                        $this->error('银行账号格式错误');
                    }
                    $Apimoney = M("Apimoney");
                    $yuemoney = $Apimoney->where("userid=" . session("userid") . " and payapiid=" . $paypaiid)->getField("money");
                    $data = array();
                    $data["money"] = sprintf("%.2f", ($yuemoney - $tkmoney));
                    if ($Apimoney->where("userid=" . session("userid") . " and payapiid=" . $paypaiid)->save($data)) {
                        //写入提款记录
                        $Wttklist = M("Wttklist");
                        $data = array();
                        $data["bankname"] = $bankname;
                        $data["bankzhiname"] = $bankzhiname;
                        $data["banknumber"] = intval($banknumber);
                        $data["bankfullname"] = $bankfullname;
                        $data["sheng"] = $sheng;
                        $data["shi"] = $shi;
                        $data["userid"] = session("userid");
                        $data["sqdatetime"] = date("Y-m-d H:i:s");
                        $data["status"] = 0;
                        $data["tkmoney"] = $tkmoney;
                        $data["sxfmoney"] = $sxfmoney;
                        $data["t"] = $t;
                        $data["money"] = $money;
                        $data["payapiid"] = $paypaiid;
                        $res = $Wttklist->add($data);
                        if ($res) {
                            $ArrayField = array(
                                "userid" => session("userid"),
                                "ymoney" => $yuemoney,
                                "money" => $tkmoney * (- 1),
                                "gmoney" => ($yuemoney - $tkmoney),
                                "datetime" => date("Y-m-d H:i:s"),
                                "tongdao" => $paypaiid,
                                "transid" => "",
                                "orderid" => "",
                                "lx" => 10
                            );                            ;
                            $Moneychange = M("Moneychange");
                            foreach ($ArrayField as $key => $val) {
                                $data[$key] = $val;
                            }
                            $Moneychange->add($data);
                           // exit("ok");
                        }
                    }
                }
                unlink($filePath);
                $this->success("委托结算提交成功！",U('Tikuan/wttklist'));
                break;
        }
        
        
       
    }
    
    
    
    public function exceldf($filePath,$a,$t,$paypaiid,$sxf,$sxflx){
    
        vendor("PHPExcel.PHPExcel");
    
        //$filePath = "Book1.xls";
    
        //建立reader对象
        $PHPReader = new \PHPExcel_Reader_Excel2007();
        if(!$PHPReader->canRead($filePath)){
            $PHPReader = new \PHPExcel_Reader_Excel5();
            if(!$PHPReader->canRead($filePath)){
                echo 'no Excel';
                return ;
            }
        }
    
    
        //建立excel对象，此时你即可以通过excel对象读取文件，也可以通过它写入文件
        $PHPExcel = $PHPReader->load($filePath);
    
        /**读取excel文件中的第一个工作表*/
        $currentSheet = $PHPExcel->getSheet(0);
        /**取得最大的列号*/
        $allColumn = $currentSheet->getHighestColumn();
        /**取得一共有多少行*/
        $allRow = $currentSheet->getHighestRow();
         
        $summoney = 0;  //总金额
    
        switch ($a){
            case 1:   //获取总金额
                /////////////////////////////////////////////////////////
                //循环读取每个单元格的内容。注意行从1开始，列从A开始
                for($rowIndex=2;$rowIndex<=$allRow;$rowIndex++){
                    for($colIndex='A';$colIndex<=$allColumn;$colIndex++){
                        $addr = $colIndex.$rowIndex;
                        $cell = $currentSheet->getCell($addr)->getValue();
                        if($cell instanceof PHPExcel_RichText){     //富文本转换字符串
                            $cell = $cell->__toString();
                        }
                        if($colIndex == "G"){
                            $summoney = $summoney + floatval($cell);
                        }
    
                    }
                }
    
                return  $summoney;
                ////////////////////////////////////////////////////////
                break;
            case 2:
                /////////////////////////////////////////////////////////
                //循环读取每个单元格的内容。注意行从1开始，列从A开始
                $batchContent = "";
                $keynum = 0;
                $batchsummoney = 0;
                for($rowIndex=2;$rowIndex<=$allRow;$rowIndex++){
                     
                    $addr = "G".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //金额
                        $cell = $cell->__toString();
                    }
    
                    $tkmoney = floatval($cell);
                    
                    $batchsummoney = $batchsummoney + $tkmoney;
                    
                    $tkmoney = sprintf("%.2f", $tkmoney);
                 
                    if($sxflx == 1){
                        $sxfmoney = $sxf;
                    }else{
                        $sxfmoney = $tkmoney*$sxf;
                    }
                    $sxfmoney = sprintf("%.2f", $sxfmoney);
                    $tkmoney-$sxfmoney>0?$money=$tkmoney-$sxfmoney:$money=0; //实际到账金额
    
                    $addr = "D".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //银行名称
                        $cell = $cell->__toString();
                    }
                    $bankname = $cell;
    
                    $addr = "E".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //分行名称
                        $cell = $cell->__toString();
                    }
                    $bankfenname = $cell;
    
                    $addr = "F".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //支行名称
                        $cell = $cell->__toString();
                    }
                    $bankzhiname = $cell;
    
                    $addr = "C".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //用户名
                        $cell = $cell->__toString();
                    }
                    $bankfullname = $cell;
    
                    $addr = "B".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //银行卡号
                        $cell = $cell->__toString();
                    }
                    $banknumber = $cell;
    
                    $addr = "H".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //富文本转换字符串
                        $cell = $cell->__toString();
                    }
                    $sheng = $cell;
    
    
                    $addr = "I".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //富文本转换字符串
                        $cell = $cell->__toString();
                    }
                    $shi = $cell;
                    
                    $addr = "J".$rowIndex;
                    $cell = $currentSheet->getCell($addr)->getValue();
                    if($cell instanceof PHPExcel_RichText){     //手机号
                        $cell = $cell->__toString();
                    }
                    $shoujihao = $cell;
                  
                    $zhlx = "私";
                    
                   
                    $bizhong = "CNY";
                    $keynum = $keynum + 1;
                    $batchContent = $batchContent."$keynum,$banknumber,$bankfullname,$bankname,$bankfenname,$bankzhiname,$zhlx,$tkmoney,$bizhong,$sheng,$shi,$shoujihao,,,,,,|";
                    
                    $Apimoney = M("Apimoney");
                    $yuemoney = $Apimoney->where("userid=" . session("userid") . " and payapiid=" . $paypaiid)->getField("money");
                    $data = array();
                    $data["money"] = sprintf("%.2f", ($yuemoney - $tkmoney));
                    if ($Apimoney->where("userid=" . session("userid") . " and payapiid=" . $paypaiid)->save($data)) {
                        /**
                         * 写入提款记录
                         */
                        $Dflist = M("Dflist");
                        $data = array();
                        $data["bankname"] = $bankname;
                        $data["bankfenname"] = $bankfenname;
                        $data["bankzhiname"] = $bankzhiname;
                        $data["banknumber"] = $banknumber;
                        $data["bankfullname"] = $bankfullname;
                        $data["sheng"] = $sheng;
                        $data["shi"] = $shi;
                        $data["userid"] = session("userid");
                        $data["sqdatetime"] = date("Y-m-d H:i:s");
                        $data["cldatetime"] = date("Y-m-d H:i:s");
                        $data["status"] = 2;
                        $data["tkmoney"] = $tkmoney;
                        $data["sxfmoney"] = $sxfmoney;
                        $data["t"] = $t;
                        $data["money"] = $money;
                        $data["payapiid"] = $paypaiid;
                        if ($Dflist->add($data)) {
                            $ArrayField = array(
                                "userid" => session("userid"),
                                "ymoney" => $yuemoney,
                                "money" => $tkmoney * (- 1),
                                "gmoney" => ($yuemoney - $tkmoney),
                                "datetime" => date("Y-m-d H:i:s"),
                                "tongdao" => $paypaiid,
                                "transid" => "",
                                "orderid" => "",
                                "lx" => 11
                            ) // 代付结算
                            ;
                            $Moneychange = M("Moneychange");
                            foreach ($ArrayField as $key => $val) {
                                $data[$key] = $val;
                            }
                            $Moneychange->add($data);
                            // exit("ok");
                        }
                    }
    
    
                }
                /////////////////////////////////////////////////////////////////

               // vendor("RongBao.RSA");
                vendor("Rsa");
                $pubKeyFile = './cer/tomcat.cer';
                $prvKeyFile = './cer/100000000003161.p12';
                
               // $pubKeyFile ="D:\\wwwroot\\vhosts\\vip.bank-pay.com.cn\\Application\\User\\Controller\\cer\\tomcat.cer";
               // $prvKeyFile = "D:\\wwwroot\\vhosts\\vip.bank-pay.com.cn\\Application\\User\\Controller\\cer\\100000000003161.p12";
                
                $rsa = new \RSA($pubKeyFile,$prvKeyFile);
                
                $content = $batchContent;
                
               // echo($content."<br>");
              
                $batchContent = '';
                $length = strlen($content);
               // echo("[".$length."]");
                for ($i=0; $i<$length; $i+=100) {
                  //  echo(substr($content,$i,100)."<br>");
                    $x = $rsa->encrypt(substr($content,$i,100));
                    $batchContent .= "$x";
                }
               
               // exit("$pubKeyFile<br>$prvKeyFile-----".$batchContent);
                
                $_input_charset = "utf8";
                $batchBizid = "100000000003161";
                $batchVersion = "00";
                $batchBiztype = "00000";
                $batchDate = date("Ymd");
                //$batchCurrnum = "100000000003161".date("YmdHis").randpw(10,"NUMBER");
                $batchCurrnum =randpw(3,"NUMBER").date("YmdHis").randpw(3,"NUMBER");
                $batchCount =  $keynum;
                $batchAmount =  sprintf("%.2f", $batchsummoney);
                $signType = "MD5";
                
                $keystr = "652de6dgff5f983cg09df820c960e97acc20165dd76e3c56dcf6d2e80d3e183e";
                
                $dataArr['batchBizid'] = $batchBizid;
                $dataArr['batchVersion'] = $batchVersion;
                $dataArr['batchBiztype'] = $batchBiztype;
                $dataArr['batchDate'] = $batchDate;
                $dataArr['batchCurrnum'] = $batchCurrnum;
                $dataArr['batchCount'] = $batchCount;
                $dataArr['batchAmount'] = $batchAmount;
                $dataArr['batchContent'] = $batchContent;
                $dataArr['_input_charset'] = $_input_charset;
                
                $string = '';
                if (is_array($dataArr)){
                    foreach ($dataArr as $key=>$val) {
                        $string .= $key.'='.$val.'&';
                    }
                }
                $string = trim($string,'&');
                
                $sign = md5($string.$keystr);

                ////////////////////////////////////////////////////////////////
                unlink($filePath);
                $fkgate = "http://entrust.reapal.com/agentpay/pay";
               /*  $datastr = "_input_charset=$_input_charset&batchBizid=$batchBizid&batchVersion=$batchVersion&batchBiztype=$batchBiztype&batchDate=$batchDate&batchCurrnum=$batchCurrnum&batchCount=$batchCount&batchAmount=$batchAmount&batchContent=$batchContent&signType=$signType&sign=$sign";
                exit($datastr);
                $tjurl = $fkgate."?".$datastr;
                $contents = fopen($tjurl, "r");
                $contents = fread($contents, 100);
                if (strpos($contents, 'succ')) {
                   exit("代付成功！");
                } */
                ##################################################################
               // echo "发送地址：",$request_url,"\n";
               
                $dataArr["signType"] = $signType;
                $dataArr["sign"] =  $sign;

                $context = array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => http_build_query($dataArr)
                    )
                );
                # var_dump($context);
                $streamPostData = stream_context_create($context);
                
                $httpResult = file_get_contents($fkgate, false, $streamPostData);
                 if (strpos($httpResult, 'succ')) {
                   $this->success("代付成功！");
                }else{
                    $this->error($httpResult);
                }
                ##################################################################
                //$this->success("委托结算提交成功！");
                ////////////////////////////////////////////////////////
                break;
        }
    
    
         
    }
    
}
