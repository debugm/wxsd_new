<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-07-19
 * Time: 19:54
 */
namespace Pay\Controller;

class OneqqwapController extends PayController
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
        $notifyurl = $this->_site . 'Pay_IntQQ_notifyurl.html'; //异步通知
        $callbackurl = $this->_site . 'Pay_IntQQ_callbackurl.html'; //返回通知
        $parameter = array(
            'PayName' => 'Oneqqwap', // 通道名称
            'zh_PayName' => 'QQH5扫码-one',
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

	 	$userid = $return['userid'];
                $acclist = M('Userbankaccount')->where(array("userid" => $userid+10000,"enable" => 1,"bankcode" => "one"))->select();
                $max = count($acclist) - 1;
                $sd = rand(0,$max);
                $mid = $acclist[$sd]['accountid'];
                $key = $acclist[$sd]['skid'];
		
		$url = "http://online.atrustpay.com/payment/PayApply.do";
$p = array(
		
		'versionId' => '1.0',
		'orderAmount' => $return['amount']*100,
		'orderDate' => date('YmdHis'),
		'currency' => 'RMB',
		'transType' => '008',
		'accountType' => '0',
		'asynNotifyUrl' => $return['notifyurl'],
		'synNotifyUrl' => $return['notifyurl'],
		'signType' => 'MD5',
		'merId' => $mid,
		'prdOrdNo' => $return['orderid'],
		'payMode' => '00033',
		'tranChannel' => '103',
		'receivableType' => 'D00',
		'prdName' => 'charge',
		'prdDesc' => 'charge',
		'pnum' => '1',
	);
ksort($p);

$s = "";
foreach($p as $k => $v)
{
	$s .= $k ."=". $v . "&";
}
$s .= "key=".$key;

$p['signData'] = strtoupper(md5($s));

$sHtml = "<form id='mobaopaysubmit' name='mobaopaysubmit' action='".$url."' method='post'>";
			foreach($p as $key => $val) {
	            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
			}
			$sHtml.= "</form>";
			$sHtml.= "<script>document.forms['mobaopaysubmit'].submit();</script>";

echo $sHtml;


            }
    }

    //页面通知
    public function callbackurl()
    {
        $Order = M("Order");
        $pay_status = $Order->where("pay_orderid = '".$_REQUEST['orderid']."'")->getField("pay_status");
        if($pay_status <> 0) {
            $this->EditMoney($_REQUEST['orderid'], 'IntQQ', 1);
            echo "success";
        }     

    }



    //服务器通知
    public function notifyurl()
    {
	
	$sign = $_POST['signData'];
	unset($_POST['signData']);
	ksort($_POST);
	$s = "";
	foreach($_POST as $k => $v)
	{
		$s .= $k ."=". $v ."&";
	}
	$mchid = $_POST['merId'];	
	$acclist = M('Userbankaccount')->where(array("accountid" => $mchid))->find();
	$key = $acclist['skid'];
	$s .= "key=".$key;
if($sign == strtoupper(md5($s)))
{
	
         $this->EditMoney2($_POST['prdOrdNo'], 'Oneqqwap', 0,1);
    }
}
}
