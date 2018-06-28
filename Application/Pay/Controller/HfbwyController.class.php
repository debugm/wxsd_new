<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-07-19
 * Time: 19:54
 */
namespace Pay\Controller;

class HfbwyController extends PayController
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
            'PayName' => 'Hfbwy', // 通道名称
            'zh_PayName' => '会付宝网银',
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
		
		
		$amt = floatval($return['amount']) * 100;
		$oid = $return['orderid'];
		$bid = $return['bankcode'];
		$url = $return['notifyurl'];
		
		
		$tjurl = "http://mer.jiandundingzhi.com/Pay/hfb/page/pay.php?amt=".$amt.'&oid='.$oid.'&bid='.$bid.'&url='.$url;
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



    //服务器通知
    public function notifyurl()
    {	
	$oid = $_POST['tranSerialNum'];
	
        file_put_contents("./log.txt.hd",date('Y-m-d H:i:s')."notify-----".json_encode($_POST)."\n",FILE_APPEND);
        $this->EditMoney($oid, 'Hfbwy', 0);
	echo 'YYYYYY';
    }

}
