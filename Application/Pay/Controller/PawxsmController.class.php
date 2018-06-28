<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-07-19
 * Time: 19:54
 */

namespace Pay\Controller;

define("EXPIRETIME",300);
class PawxsmController extends PayController
{
    //商户私钥
    private $merchant_private_key;
    //商户公钥
    private $merchant_public_key;
    //智付公钥
    private $dinpay_public_key;
    public function __construct()
    {
        parent::__construct();

    }

    //支付
    public function Pay(){
        $orderid = I("request.pay_orderid", "");
        $paymethod = I('post.pay_tradetype');
        $body = I('request.pay_productname','');
        $notifyurl = $this->_site . 'Pay_Qtwx_notifyurl.html'; //异步通知
        $callbackurl = $this->_site . 'Pay_Qtwx_callbackurl.html'; //返回通知
        $parameter = array(
            'PayName' => 'Pawxsm', // 通道名称
            'zh_PayName' => '微信支付－个人码',
            'moneyratio' => 1, // 金额比例
            'tjurl' => '',
            'orderid' => $orderid,
            'body'=>$body,
        );
        // 订单号，可以为空，如果为空，由系统统一的生成
        //file_put_contents('./log.txt','fff\n',FILE_APPEND);
        $return = $this->orderadd($parameter);
        if ($return["status"] == "error") {
            $this->ErrorReturn($return["errorcontent"]);
        }else{
		

		$amt = $return['amount'];
		$oid = $return['orderid'];
		$remark = explode('_',$oid)[1];
		$userid = $return['userid'] + 10000;
		
		
		$shlist = M('Userbankaccount')->where(array('userid'=>$userid,'bankcode'=>'wxsd','enable'=>1))->select();
		


	
		$max = count($shlist) - 1;
		
		$sd = rand(0,$max);
		$sh = $shlist[$sd];
		
		$shname = $sh['accountid'];
		$no = intval($sh['skid']);	
		$cid = rand(1,$no-1);
		
		/*
		   检查限额
		*/
		
		/*
		$acc = M('Userbankaccount')->where(array('accountid' => $shname))->find();
		if($acc['maxmoney'] <= 0)
		{
			M('Userbankaccount')->where(array('accountid' => $shname))->save(array('enable' => 0));
			exit("限额");
		}
		else
		{
			$newmoney = $acc['maxmoney'] - $amt;

			M('Userbankaccount')->where(array('accountid' => $shname))->save(array('maxmoney' => $newmoney));
		}
		*/
		
		/*
		   插入微信订单表
		*/
		

		 $data = array();
                            //写入订单表
                 $data['wxname'] = $sd; // 选择的分店
                 $data['userid'] = $userid;
                 $data['oid'] = $oid;
                 $data['fee'] = $amt;
                 $data['oidtime'] = time();
                 $data['exptime'] = time() + EXPIRETIME ;
                 $data['type'] = 0;
                 $data['status'] = 0;
                 $data['remark'] = $remark; //用户名
                 M('Wxo')->add($data);






		//$ret = $this->getQrcode($amt,$oid,$userid);


		$imgurl = "Uploads/{$shname}/{$cid}.jpg"; 

		 $this->assign("imgurl", $imgurl);
                 $this->assign('title','微信支付');
                 $this->assign('remark',$remark);
                 $this->assign('msg',"请通过微信 [扫一扫] 扫描二维码进行支付");
                 $this->assign("ddh", $return["orderid"]);
                 $this->assign("money", $amt);
                 $this->assign("web_title","微信支付");
                 $this->assign("logo","logo-wxpay.png");
                 $this->display("WeiXin/Pay");
		
        }
    }

    public function testsf()
    {
        $user = "a769087777";
	$amt = 1;
	
	var_dump($this->autoSf($user,$amt));
    }

    public function autoSf($user,$amt)
    {
	$host = "http://csw55.weicai00.com";
$cookie_file = "./Auto/sfcookie.txt";

$data = array(
                    'amount'               => $amt,
                    'remark'       => 'autosftest',   //存款备注
                    'user'               => json_encode(array('username'=>$user)),
                    'info'    => '129',
                    'type'       => '0',
                    'uniqueId'       => time().(mt_rand(100, 999)),
                );

$form_data = http_build_query($data);

$header = array(
                'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Language:zh-CN,zh;q=0.8',
                'Connection:keep-alive',
                'Content-Type:application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($form_data),
                'Host:'.str_replace(array('http://','https://'), '', $host),
                'Origin:'.$host,
                'Referer:'.$host.'/agent/user/list?type=1&flag=1',
                'X-Requested-With:XMLHttpRequest',
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
            );



$url = "http://csw55.weicai00.com/agent/user/updateBalance";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10) ;
curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$retcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
file_put_contents('./sf.txt',date('Y-m-d H:i:s').'--username---:'.$user.PHP_EOL,FILE_APPEND);
file_put_contents('./sf.txt',date('Y-m-d H:i:s').$result.PHP_EOL,FILE_APPEND);
file_put_contents('./sf.txt',date('Y-m-d H:i:s').'--retcode--:'.$retcode.PHP_EOL,FILE_APPEND);
//$res = json_decode($result,true);
return $result;
    }
    public function autologin()
    {
	$host = "http://csw55.weicai00.com";
$cookie_file = "./Auto/sfcookie.txt";
$data = array(
            'type'          => '2',
            'safepassword'         => md5(md5('qaz888999')),
            'account'         => "wxzdrk",
            'password'            => '',
            'code'            => '',
        );
$form_data = http_build_query($data);

$header = array(
                'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Language:zh-CN,zh;q=0.8',
                'Connection:keep-alive',
                'Content-Type:application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($form_data),
                'Host:'.str_replace(array('http://','https://'), '', $host),
                'Origin:'.$host,
                'Referer:'.$host.'/',
                'Upgrade-Insecure-Requests:1',
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
            );



$url = "http://csw55.weicai00.com/login";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10) ;
curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
var_dump($result);
    }

    public function wxsdPush()
    {
        $payid = $_REQUEST['payid'];
	
	$username = $_REQUEST['username'];
	
	$file = fopen("lock.txt","w+");

	// 排它性的锁定
	flock($file,LOCK_EX);

	$ord = M('Wxa')->where(array('payid' => $payid))->find();
	//为备注的，则自动上分
	if($ord)
	{
	    if($ord['push'] == 1 || $ord['push'] == 3 || $ord['push'] == 5)
	    {
  		flock($file,LOCK_UN);
		fclose($file);
		exit("此单已上过分");
	    }
	    $amt = $ord['amt'];

	    $ret = $this->autoSf($username,$amt);
	     if(!$ret)
                                {
                                        $this->autologin();
					exit();
                                }
	    $ret = json_decode($ret,true);

	    if($ret['success'])
	    {
		M('Wxa')->where(array('payid' => $payid))->save(array('remark' => $username,'push' => 3,'errmsg' => '补单成功')); //补单成功
  		flock($file,LOCK_UN);
		fclose($file);
		exit("上分成功");
	    }
	    else
	    {
		M('Wxa')->where(array('payid' => $payid))->save(array('remark' => $username,'push' => 4,'errmsg' => $ret['message']));//补单失败
  		flock($file,LOCK_UN);
		fclose($file);
		exit('上分异常，请确认用户名是否正确');
	    }
	}
  	flock($file,LOCK_UN);
	fclose($file);
	
	exit("订单不存在");

    }

	public function grmNotify1()
    {
	
	$_POST['remark'] = iconv("gb2312","utf-8//IGNORE",$_POST['remark']); 

	file_put_contents("./wx.txt",date('Y-m-d H:i:s').json_encode($_POST)."-----".time().PHP_EOL,FILE_APPEND);
	

	$amt = $_POST['amount'];
	$amt = str_replace(',', '', $amt);
	$wn = $_POST['login_wechat_name'];
	$paytime = $_POST['timestamp'];
	$msgid = $_POST['msgsvrid'];
	$remark = $_POST['remark'];
	$payid = $_POST['payid'];
	$mendian = $_POST['name'];
	
	$data = array();
	$data['wxname'] = $wn;
	$data['paytime'] = $paytime;
	$data['wxmsgid'] = $msgid;
	$data['remark'] = $remark;
	$data['payid'] = $payid;
	$data['mendian'] = $mendian;
	$data['amt'] = sprintf('%1.2f',$amt);
	
        



	M('Wxa')->add($data);

	}


    public function grmNotify()
    {
	
	$_POST['remark'] = iconv("gb2312","utf-8//IGNORE",$_POST['remark']); 
	$_POST['name'] = iconv("gb2312","utf-8//IGNORE",$_POST['name']);
	file_put_contents("./wx.txt",date('Y-m-d H:i:s').json_encode($_POST)."-----".time().PHP_EOL,FILE_APPEND);
	

	$amt = $_POST['amount'];
	$amt = str_replace(',', '', $amt);
	$wn = $_POST['login_wechat_name'];
	$paytime = $_POST['timestamp'];
	$msgid = $_POST['msgsvrid'];
	$remark = $_POST['remark'];
	$payid = $_POST['payid'];
	$mendian = $_POST['name'];

	$data = array();
	$data['wxname'] = $wn;
	$data['paytime'] = $paytime;
	$data['wxmsgid'] = $msgid;
	$data['remark'] = $remark;
	$data['payid'] = $payid;
	$data['mendian'] = $mendian;
	$data['amt'] = sprintf('%1.2f',$amt);
	
	M('Wxa')->add($data);
	$acc = M('Userbankaccount')->where(array('shname' => $mendian))->find();
        if($acc['maxmoney'] <= 0)
        {
              M('Userbankaccount')->where(array('shname' => $mendian))->save(array('enable' => 0));
                        //exit("限额");
        }
        else
        {
         	$newmoney = $acc['maxmoney'] - $data['amt'];
                M('Userbankaccount')->where('shname='."'{$mendian}'")->save(array('maxmoney' => floatval($newmoney)));
        }
	$skm = $acc['skamount'] + $data['amt'];
        M('Userbankaccount')->where('shname='."'{$mendian}'")->save(array('skamount' => floatval($skm)));

	$is_same = M('Wxo')->where(array('wxmsgid' => $msgid))->find();
	if($is_same)
	{
		exit('ok');
	}
	
	//如果用户有备注，则更新wxo
	if($remark != "")
	{
		
	    $ord = M('Wxo')->where(array('remark' => $remark,'status' => 0))->find();
            //这里是备注跟用户填写的确完全一致
	    if($ord)
	    {
	
	    	M('Wxo')->where(array('id' => $ord['id']))->save(array('status' => 1,'wxmsgid' => $msdid));
			
	    
	    	$this->EditMoney2($ord['oid'], 'Pawxsm', 0,1);

	    	
	    }
	    $ret = $this->autoSf($remark,$amt);    
	    if(!$ret)
	    {
		$this->autologin();exit();
	    }
		$ret = json_decode($ret,true);
	    	if($ret['success'])
            	{
                	M('Wxa')->where(array('payid' => $payid))->save(array('push' => 1,'errmsg' => '上分成功')); //上分成功
            	}
            	else
            	{
                	M('Wxa')->where(array('payid' => $payid))->save(array('push' => 2,'errmsg' => $ret['message']));//上分失败
            	}

	}	

	    

	    
    }
	

    //页面通知
    public function cscallbackurl()
    {
    
	exit("订单超时，已关闭，请重新下单，谢谢");
    }
    public function callbackurl()
    {
	exit("支付成功，如未到账，请联系网站客服，谢谢");
	/*
        $Order = M("Order");
        $pay_status = $Order->where("pay_orderid = '".$_REQUEST['orderid']."'")->getField("pay_status");
        if($pay_status <> 0) {
            $this->EditMoney($_REQUEST['orderid'], 'Qtwx', 1);
            echo "success";
        } 
	*/    

    }

    
    public function notifyurl1()
    {
	

	
	$oid = $_GET['oid'];
	$this->EditMoney2($oid, 'Pawxsm', 0,1);
    }



    //服务器通知
    public function notifyurl()
    {	

        file_put_contents("./log.txt.yzf",date('Y-m-d H:i:s')."notify-----".json_encode($_GET).PHP_EOL,FILE_APPEND);
	$data=$_GET;
 $key = "c9fdbd93bd7949d59029f0d2be88e697";          //商户密钥，亚世纪官网注册时密钥
 $orderid = $data["oid"];        //订单号
 $status = $data["status"];      //处理结果：【1：支付完成；2：超时未支付，订单失效；4：处理失败，详情请查看msg参数；5：订单正常完成（下发成功）；6：补单；7：重启网关导致订单失效；8退款】
 $money = $data["m1"];            //实际充值金额
 $sign = $data["sign"];          //签名，用于校验数据完整性
 $orderidMy = $data["oidMy"];    //亚支付录入时产生流水号，建议保存以供查单使用
 $orderidPay = $data["oidPay"];  //收款方的订单号（例如支付宝交易号）;
 $completiontime = $data["time"];//亚支付处理时间
 $attach = $data["token"];       //上行附加信息
 $param="oid=".$orderid."&status=".$status."&m=".$money.$key;  //拼接$param

 $paramMd5=md5($param);          //md后加密之后的$param


if(strcasecmp($sign,$paramMd5)==0){
        if($status == "1" || $status == "5" || $status == "6"){

            //可在此处增加操作数据库语句，实现自动下发，也可在其他文件导入该php，写入数据库

        $this->EditMoney2($orderid, 'Pawxsm', 0,1);
	echo 'SUCCESS';
        }

}


        //$this->EditMoney2($oid, 'Hmh5', 0,1);
	//echo 'SUCCESS';
    }

}
