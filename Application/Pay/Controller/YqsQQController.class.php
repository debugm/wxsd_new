<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-07-19
 * Time: 19:54
 */
namespace Pay\Controller;

class YqsQQController extends PayController
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
            'PayName' => 'YqsQQ', // 通道名称
            'zh_PayName' => 'QQ扫码-yqs',
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
                $acclist = M('Userbankaccount')->where(array("userid" => $userid+10000,"enable" => 1,"bankcode" => "yqs"))->select();
                $max = count($acclist) - 1;
                $sd = rand(0,$max);
                $mid = $acclist[$sd]['accountid'];
                $key = $acclist[$sd]['skid'];



$p = array('service' => 'ten.activescan.pay',
           'mch_id' => $mid,
           'goods' => 'charge',
           'order_no' => $return['orderid'],
           'amount' => $return['amount'],
           'notify_url' => $return['notifyurl'],
);
ksort($p);
$str = "";
foreach($p as $k => $v)
{
    $str .= $k ."=". $v ."&";
}
$str .= "key=".$key;
$p['sign'] = md5($str);
$xml = "<xml>";
        foreach ($p as $key=>$val)
        {
                $xml.="<".$key.">".$val."</".$key.">";
        }
        $xml.="</xml>";

$url = "https://opay.arsomon.com:28443/vipay/reqctl.do";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$values = json_decode(json_encode(simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA)), true);       
		                if($values['res_code'] == "100")
                {
			$url = $values['code_url'];
                    import("Vendor.phpqrcode.phpqrcode",'',".php");
                    //$url = urldecode($url);
                    $QR = "Uploads/codepay/". $return["orderid"] . ".png";//已经生成的原始二维码图
                    \QRcode::png($url, $QR, "L", 20);

                    $this->assign("imgurl", $QR);
                    $this->assign('title',$body);
                    $this->assign('msg',"请通过QQ [扫一扫] 扫描二维码进行支付");
                    $this->assign("ddh", $return["orderid"]);
                    $this->assign("money", $return["amount"]);
                    $this->assign("web_title","QQ支付");
                    $this->assign("logo","logo-qqpay.png");
                    $this->display("WeiXin/Pay");
                }
                else
                {
		    file_put_contents("./log.txt",date('Y-m-d H:i:s').json_encode($result)."\n",FILE_APPEND);
                    echo "服务异常，请稍后再试...";
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
            $this->EditMoney($_REQUEST['orderid'], 'IntQQ', 1);
            echo "success";
        }     

    }



    //服务器通知
    public function notifyurl()
    {
	$p = file_get_contents("php://input");
	file_put_contents("./log.txt.yqs",date('Y-m-d H:i:s').$p."\n",FILE_APPEND);
	$p = json_decode(json_encode(simplexml_load_string($p, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
	$sign = $p['sign'];
	unset($p['sign']);
	ksort($p);
	$s = "";
	foreach($p as $k => $v)
	{
		$s .= $k ."=". $v ."&";
	}
	$mchid = $p['mch_id'];	
	$acclist = M('Userbankaccount')->where(array("accountid" => $mchid))->find();
	$key = $acclist['skid'];
	$s .= "key=".$key;
if($sign == md5($s))
{
	
         $this->EditMoney2($p['order_no'], 'YqsQQ', 0,1);
    }
}
}
