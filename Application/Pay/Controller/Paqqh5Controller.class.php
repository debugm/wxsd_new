<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-07-19
 * Time: 19:54
 */
namespace Pay\Controller;

class Paqqh5Controller extends PayController
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
            'PayName' => 'Paqqh5', // 通道名称
            'zh_PayName' => '网关支付－海马',
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
		
		//获取用户的账户进行轮询
		$userid = $return['userid'];
		$acclist = M('Userbankaccount')->where(array("userid" => $userid+10000,"enable" => 1,"bankcode" => "paqqh5"))->select();		
		$max = count($acclist) - 1;
		/*	
		 for($i = 0;$i <= $max; $i++)
                {
                        if($acclist[$i]['floating'] == 1)
                        {
                            //$sub_mchid = $acclist[$i]['accountid'];
                            //$jumpurl = $acclist[$i]['url'];
                            $skid = $acclist[$i]['skid'];
                            M('Userbankaccount')->where(array("accountid" => $sub_mchid,"userid" => $userid+10000))->save(array('floating' => 0));

                            if($i == $max)
                            {
                                M('Userbankaccount')->where(array("accountid" => $acclist[0]['accountid'],"userid" => $userid+10000))->save(array('floating' => 1));
                            }
                            else
                                M('Userbankaccount')->where(array("accountid" => $acclist[$i+1]['accountid'],"userid" => $userid+10000))->save(array('floating' => 1));
                            break;
                        }
                }

		*/
		
		$sd = rand(0,$max);
                //var_dump($acclist);exit();

                //$sub_mchid = $acclist[$sd]['accountid'];
                //$jumpurl = $acclist[$sd]['url'];
                $skid = $acclist[$sd]['skid'];
		file_put_contents("./log.hmqq.txt",date('Y-m-d H:i:s')."--".$skid.'--'.$userid.'---'.PHP_EOL,FILE_APPEND);
		
		
		//$sub_mchid = $acclist[$sd]['accountid'];
		//$jumpurl = $acclist[$sd]['url'];

		$amt = $return['amount'];
		$oid = $return['orderid'];
		$nurl = $return['notifyurl'];
		 $ip = $realip = $_SERVER['REMOTE_ADDR'];	
		if(isMobile())
		    $tjurl = "http://vip.ziyubaihuo.com/Pay/hm/ylwap.php?amt=".$amt.'&oid='.$oid.'&url='.$nurl.'&ip='.$ip;
		else
		    $tjurl = "http://vip.ziyubaihuo.com/Pay/hm/wg.php?amt=".$amt.'&oid='.$oid.'&url='.$nurl.'&ip='.$ip;
			
		header("Location:".$tjurl);
		exit();

        }
    }

    //页面通知
    public function callbackurl()
    {
        $Order = M("Order");
        $pay_status = $Order->where("pay_orderid = '".$_REQUEST['orderid']."'")->getField("pay_status");
        if($pay_status <> 0) {
            $this->EditMoney($_REQUEST['orderid'], 'Qtwx', 1);
            echo "success";
        }     

    }

public function isMobile()
    {
        $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
        $mobile_browser = '0';
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
            $mobile_browser++;
        if ((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false))
            $mobile_browser++;
        if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
            $mobile_browser++;
        if (isset($_SERVER['HTTP_PROFILE']))
            $mobile_browser++;
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-'
        );
        if (in_array($mobile_ua, $mobile_agents))
            $mobile_browser++;
        if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
            $mobile_browser++;
        // Pre-final check to reset everything if the user is on Windows
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
            $mobile_browser = 0;
        // But WP7 is also Windows, with a slightly different characteristic
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
            $mobile_browser++;
        if ($mobile_browser > 0)
            return true;
        else
            return false;
    }

    //服务器通知
    public function notifyurl()
    {	
	$oid = $_POST['out_trade_no'];
	
        file_put_contents("./log.txt.hm",date('Y-m-d H:i:s')."notify-----".json_encode($_POST)."\n",FILE_APPEND);
        $this->EditMoney2($oid, 'Paqqh5', 0,1);
	echo 'SUCCESS';
    }

}
