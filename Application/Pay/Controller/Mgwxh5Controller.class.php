<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-07-19
 * Time: 19:54
 */
namespace Pay\Controller;

class Mgwxh5Controller extends PayController
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
        $notifyurl = $this->_site . 'Pay_Mgwxh5_notifyurl.html'; //异步通知
        $callbackurl = $this->_site . 'Pay_Mgwxh5_callbackurl.html'; //返回通知
        $parameter = array(
            'PayName' => 'Mgwxh5', // 通道名称
            'zh_PayName' => 'MG微信H5',
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
		
		$url = "http://pay.ytcpu.com/quick/pay";
$key = "rrk0v8trq2j1uqs5asgu25fsgc";
$p = array(

                "partner_id" => "20180102150208719000",
                "amount" => $return['amount'],
                "pay_type" => "wxh5",
                "out_order_no" => $return['orderid'],
                "body" => "test",
                "notify_url" => $return['notifyurl'],
                "ip" => "127.0.0.1"
                //"sign" => "",


        );

$str = "";

ksort($p);
foreach($p as $k => $v)
{
        $str .= $k ."=". $v ."&" ;
}
$str .= "key=rrk0v8trq2j1uqs5asgu25fsgc";

$p['sign'] = strtoupper(md5($str));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($p));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
		
		$res = json_decode($result,true);
		if(isset($res['code']) && $res['code'] == 1)
		{
			header("Location:".$res['url']);
			exit();
		}
		else
		{
			$msg = $res['msg'];	
			echo json_encode(array("status" => -1,"msg" => $msg));
			exit();
		}


	}
    }

    //页面通知
    public function callbackurl()
    {
        $Order = M("Order");
        $pay_status = $Order->where("pay_orderid = '".$_REQUEST['orderid']."'")->getField("pay_status");
        if($pay_status <> 0) {
            $this->EditMoney($_REQUEST['orderid'], 'Qtqq', 1);
            echo "success";
        }     

    }



    //服务器通知
    public function notifyurl()
    {
	 
   	 $p = file_get_contents("php://input"); 	
	 file_put_contents("./log.txt.mgwxh5",date('Y-m-d H:i:s').$p."\n",FILE_APPEND);
	 $r = json_decode($p,true);	
	 
	 $oid = $r['out_order_no'];
	 $amt = $r['amount'];
         $this->EditMoney($oid, 'Mgwxh5', 0);
    }
}
