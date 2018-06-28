<?php
namespace Pay\Controller;

class IpsController extends PayController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function Pay()
    {
        $orderid = I("request.pay_orderid"); // 订单号
        $body = I('request.pay_productname'); //商品名称
        $productdesc = I('request.pay_productdesc'); //商品描述
        $notifyurl = $this->_site . 'Pay_Ips_notifyurl.html'; //异步通知
        $callbackurl = $this->_site . 'Pay_Ips_callbackurl.html'; //返回通知

        $parameter = array(
            'PayName' => 'Ips', // 通道名称
            'zh_PayName' => '环讯',
            'moneyratio' => 1, // 金额比例
            'tjurl' => '',
            'orderid' => I("request.pay_orderid") // 订单号，可以为空，如果为空，由系统统一的生成
        );

        $return = $this->orderadd($parameter);

        if ($return["status"] == "error") {
            $this->ErrorReturn($return["errorcontent"]);
        }

        $url = 'https://newpay.ips.com.cn/psfp-entry/gateway/payment.do';

        //获取输入参数
        $pVersion = 'v1.0.0';//版本号
        $pMerCode = $return['sid'];//商户号
        $pMerCert = $return['key'];//商户证书
        $pAccount = $return['account'];//账户号
        $pMsgId = 'IPS' . rand(1000, 9999);//消息编号
        $pReqDate = date("Ymdhis");//商户请求时间
        $pMerBillNo = $return['orderid'];//商户订单号
        $pAmount = $return['amount'];//订单金额
        $pDate = date("Ymd");//订单日期
        $pCurrencyType = '156';//币种
        $pGatewayType = '01';//支付方式
        $pMerchanturl = $callbackurl;//支付结果成功返回的商户URL
        $pOrderEncodeTyp = "5";//订单支付接口加密方式 默认为5#md5
        $pRetEncodeType = "17";//交易返回接口加密方式
        $pRetType = 1;//返回方式
        $pServerUrl = $notifyurl;//Server to Server返回页面
        $pBillEXP = 1;//订单有效期(过期时间设置为1小时)
        $pGoodsName = $body;//商品名称

        //请求报文的消息体
        $strbodyxml = "<body>"
            . "<MerBillNo>" . $pMerBillNo . "</MerBillNo>"
            . "<Amount>" . $pAmount . "</Amount>"
            . "<Date>" . $pDate . "</Date>"
            . "<CurrencyType>" . $pCurrencyType . "</CurrencyType>"
            . "<GatewayType>" . $pGatewayType . "</GatewayType>"
            . "<Merchanturl>" . $pMerchanturl . "</Merchanturl>"
            . "<OrderEncodeType>" . $pOrderEncodeTyp . "</OrderEncodeType>"
            . "<RetEncodeType>" . $pRetEncodeType . "</RetEncodeType>"
            . "<RetType>" . $pRetType . "</RetType>"
            . "<ServerUrl>" . $pServerUrl . "</ServerUrl>"
            . "<BillEXP>" . $pBillEXP . "</BillEXP>"
            . "<GoodsName>" . $pGoodsName . "</GoodsName>"
            . "</body>";

        $Sign = $strbodyxml . $pMerCode . $pMerCert;//签名明文
        $pSignature = md5($strbodyxml . $pMerCode . $pMerCert);//数字签名
        //请求报文的消息头
        $strheaderxml = "<head>"
            . "<Version>" . $pVersion . "</Version>"
            . "<MerCode>" . $pMerCode . "</MerCode>"
            . "<Account>" . $pAccount . "</Account>"
            . "<MsgId>" . $pMsgId . "</MsgId>"
            . "<ReqDate>" . $pReqDate . "</ReqDate>"
            . "<Signature>" . $pSignature . "</Signature>"
            . "</head>";

        //提交给网关的报文
        $strsubmitxml = "<Ips>"
            . "<GateWayReq>"
            . $strheaderxml
            . $strbodyxml
            . "</GateWayReq>"
            . "</Ips>";


        $html = '<html><head><title>跳转......</title><meta http-equiv="content-Type" content="text/html; charset=utf-8" /></head><body>';
        $html .= '<form action="' . $url . '" method="post" id="frm1">';
        $html .= '<input name="pGateWayReq" type="hidden" value="' . $strsubmitxml . '">';
        $html .= '</form>';
        $html .= '<script language="javascript">document.getElementById("frm1").submit();</script></body></html>';
        echo $html;
    }

    // 页面通知返回
    public function callbackurl()
    {
        $paymentResult = $_POST["paymentResult"];//获取信息
        //$paymentResult = iconv("GB2312","UTF-8",$paymentResult);
        //file_put_contents('xml1.txt',$paymentResult);

        $a = array(
            '<![CDATA[',
            ']]>');
        $b = array("" , "");
        // 取得数字签名实体并转换供入账比对
        $startPos = mb_strpos($paymentResult , "<body>");
        $nextPos = mb_strpos($paymentResult, "</GateWayRsp>");
        $bodyContent = substr($paymentResult,$startPos , $nextPos-$startPos);
        $paymentResult = str_replace($a , $b , $paymentResult);
        $xml= json_decode(json_encode((array) simplexml_load_string($paymentResult)), true);

        $billno = $xml['GateWayRsp']['body']['MerBillNo'];
        $amount = $xml['GateWayRsp']['body']['Amount'];
        $attach = $xml['GateWayRsp']['body']['Attach'];


        //读取相关xml中信息
        $Signature = $xml['GateWayRsp']['head']['Signature'];
        $RspCode= $xml['GateWayRsp']['head']['RspCode'];

        $order = M('Order')->where("pay_orderid = '" . $billno . "'")->find();
        $sign = $bodyContent.$order['memberid'] . $order['key'];
        //file_put_contents('co.txt',date('y-m-d h:i:s').'P2P验签明文:'.$sign."\r\n",FILE_APPEND);
        $md5sign = md5($sign) ;
        //file_put_contents('cs.txt',date('y-m-d h:i:s').'P2P验签密文:'.$md5sign."\r\n",FILE_APPEND);

        //判断签名
        if ($Signature == $md5sign) {
            if ($RspCode == '000000') {
                $this->EditMoney($order['pay_orderid'], 'Ips', 1);
                echo "ipscheckok";
            }
        } else {
            exit("订单签名错误");
        }
    }

    // 服务器点对点返回
    public function notifyurl()
    {
        $paymentResult = $_POST["paymentResult"];//获取信息
        //file_put_contents('xml2.txt',$paymentResult);

        $a = array(
            '<![CDATA[',
            ']]>');
        $b = array("" , "");
        // 取得数字签名实体并转换供入账比对
        $startPos = mb_strpos($paymentResult , "<body>");
        $nextPos = mb_strpos($paymentResult, "</GateWayRsp>");
        $bodyContent = substr($paymentResult,$startPos , $nextPos-$startPos);
        $paymentResult = str_replace($a , $b , $paymentResult);
        $xml= json_decode(json_encode((array) simplexml_load_string($paymentResult)), true);

        $billno = $xml['GateWayRsp']['body']['MerBillNo'];
        $amount = $xml['GateWayRsp']['body']['Amount'];
        $attach = $xml['GateWayRsp']['body']['Attach'];


        //读取相关xml中信息
        $Signature = $xml['GateWayRsp']['head']['Signature'];
        $RspCode= $xml['GateWayRsp']['head']['RspCode'];

        $order = M('Order')->where("pay_orderid = '" . $billno . "'")->find();
        $sign = $bodyContent.$order['memberid'] . $order['key'];
        //file_put_contents('no.txt',date('y-m-d h:i:s').'P2P验签明文:'.$sign."\r\n",FILE_APPEND);
        $md5sign = md5($sign) ;
        //file_put_contents('ns.txt',date('y-m-d h:i:s').'P2P验签密文:'.$md5sign."\r\n",FILE_APPEND);
        //判断签名
        $isverify = intval($RspCode);
        if ($Signature == $md5sign) {
            if (!$isverify) {
                $this->EditMoney($order['pay_orderid'], 'Ips', 0);
            }
        } else {
            exit("订单签名错误");
        }
    }
}
?>