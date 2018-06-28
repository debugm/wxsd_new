<?php
namespace Pay\Controller;

class WxSmController extends PayController
{

    public $_site;
    public function __construct()
    {
        parent::__construct();
    }

    public function Pay()
    {
        $orderid = I("request.pay_orderid");
        $body = I('request.pay_productname');
        $notifyurl = $this->_site . 'Pay_WxSm_notifyurl.html'; //异步通知
        $callbackurl = $this->_site . 'Pay_WxSm_callbackurl.html'; //跳转通知
        $parameter = array(
            'PayName' => 'WxSm', // 通道名称
            'zh_PayName' => '微信扫码支付-官方',
            'moneyratio' => 100, // 金额比例
            'tjurl' => 'https://api.mch.weixin.qq.com/pay/unifiedorder',
            'orderid' => $orderid, // 订单号，可以为空，如果为空，由系统统一的生成
        );
        $return = $this->orderadd($parameter);
        if ($return["status"] == "error") {
            $this->ErrorReturn($return["errorcontent"]);
        } else {
            $Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
            $location = $Ip->getlocation(); // 获取某个IP地址所在的位置
            $ip = $location['ip'];
            $arraystr = array(
                "trade_type" => "NATIVE",
                'appid' => $return["account"],
                "mch_id" => $return["sid"],
                "out_trade_no" => $return["orderid"],
                "body" => "VIP会员服务",
                "total_fee" => $return["amount"],
                "spbill_create_ip" => $ip,
                "notify_url" => $return["notifyurl"],
                "nonce_str" => MD5(time()),
                "product_id" => MD5(time()),
            );
            ksort($arraystr);
            $buff = "";
            foreach ($arraystr as $k => $v) {
                if ($k != "sign" && $v != "" && !is_array($v)) {
                    $buff .= $k . "=" . $v . "&";
                }
            }
            $buff = trim($buff, "&");
            // echo($buff."<br>");
            //////////////////////////////////////////
            //签名步骤二：在string后加入KEY
            $string = $buff . "&key=" . $return["key"];
            //签名步骤三：MD5加密
            $string = md5($string);
            //签名步骤四：所有字符转为大写
            $sign = strtoupper($string);
            $arraystr["sign"] = $sign;
            //var_dump($arraystr);
            $xml = "<xml>";
            foreach ($arraystr as $key => $val) {
                if (is_numeric($val)) {
                    $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
                } else {
                    $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
                }
                //echo($key."<br>");
            }
            $xml .= "</xml>";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_URL, $parameter["tjurl"]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
            $data = curl_exec($ch);
            curl_close($ch);

            if ($data) {
                libxml_disable_entity_loader(true);
                $dataxml = json_decode(json_encode(simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
                //print_r($dataxml);
                if ($dataxml['return_code'] == 'SUCCESS') {
                    import("Vendor.phpqrcode.phpqrcode",'',".php");
                    $url = urldecode($dataxml['code_url']);
                    $QR = "Uploads/codepay/". $return["orderid"] . ".png";//已经生成的原始二维码图
                    //$delqr = $QR;
                    \QRcode::png($url, $QR, "L", 20);
					echo json_encode(array('status'=>1,'codeurl'=>$this->_site.$QR));
					exit();
                } else {
                    exit($dataxml['message'] . "------" . $dataxml['status']);
                }
            }
        }
    }

    public function callbackurl()
    { // 页面通知返回

    }

    // 服务器点对点返回
    public function notifyurl()
    {
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        libxml_disable_entity_loader(true);
        $arraystr = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        $pkey = $this->getmd5key('WxSm', $arraystr["mch_id"]); // 密钥
        //签名步骤一：按字典序排序参数
        ksort($arraystr);
        $buff = "";
        foreach ($arraystr as $k => $v) {
            if ($k != "sign" && $v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        //////////////////////////////////////////
        //签名步骤二：在string后加入KEY
        $string = $buff . "&key=" . $pkey;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $sign = strtoupper($string);
        if ($sign == $arraystr["sign"]) {

            //支付记录
            $rows = array(
                'out_trade_no'=>$arraystr['out_trade_no'],
                'result_code'=>$arraystr['result_code'],
                'transaction_id'=>$arraystr['transaction_id'],
                'fromuser'=>$arraystr['openid'],
                'time_end'=>$arraystr['time_end'],
                'total_fee'=>$arraystr['total_fee'],
                'bank_type'=>$arraystr['bank_type'],
                'trade_type'=>$arraystr['trade_type'],
                'payname'=> 'WXGzh'
            );
            M('Paylog')->add($rows);

            $this->EditMoney($arraystr["out_trade_no"], 'WxSm', 0);
            exit("success");
        } else {

        }

    }
}

?>