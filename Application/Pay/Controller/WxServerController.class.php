<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-03-22
 * Time: 22:38
 */
namespace Pay\Controller;

class WxServerController extends PayController
{
    public $_site;
    public $sub_mch_id;
    public function __construct()
    {
        parent::__construct();
        $this->_site = ((is_https()) ? 'https':'http:').'://'.C("DOMAIN").'/';
        $this->sub_mch_id = I('param.pay_submchid','');
    }

    public function Pay()
    {
        $_tradetype = I('param.pay_tradetype');
        $_orderid = I('param.pay_orderid');
        $parameter = array(
            'PayName' => 'WxServer', // 通道名称
            'zh_PayName' => '微信服务商官方',
            'moneyratio' => 100, // 金额比例
            'tjurl' => '',
            'orderid' => $_orderid,
        );
        // 订单号，可以为空，如果为空，由系统统一的生成
        $return = $this->orderadd($parameter);
        if($_tradetype == 'NATIVE'){
            if ($return["status"] == "error") {
                $this->ErrorReturn($return["errorcontent"]);
            } else {
                // 实例化类 参数表示IP地址库文件
                $Ip = new \Org\Net\IpLocation('UTFWry.dat');
                // 获取某个IP地址所在的位置
                $location = $Ip->getlocation();
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
                //签名步骤二：在string后加入KEY
                $string = $buff . "&key=" . $return["key"];
                //签名步骤三：MD5加密
                $string = md5($string);
                //签名步骤四：所有字符转为大写
                $sign = strtoupper($string);
                $arraystr["sign"] = $sign;
                $xml = "<xml>";
                foreach ($arraystr as $key => $val) {
                    if (is_numeric($val)) {
                        $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
                    } else {
                        $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
                    }
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

                if ($data) {
                    curl_close($ch);
                    libxml_disable_entity_loader(true);
                    $dataxml = json_decode(json_encode(simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
                    if ($dataxml['return_code'] == 'SUCCESS') {
                        $this->assign("imgurl", 'http://paysdk.weixin.qq.com/example/qrcode.php?data=' . urldecode($dataxml['code_url']));
                        $this->assign("ddh", $return["orderid"]);
                        $this->assign("money", $return["amount"] / 100);
                        $this->display("WeiXin/Pay");
                    } else {
                        exit($dataxml['message'] . "------" . $dataxml['status']);
                    }
                } else {

                    echo($dataxml['message']);
                    echo($dataxml['result_code']);
                }
            }
        }else {
            $redirect_uri = $this->_site . 'Pay_WxServer_jsapi.html';
            $state = $return["orderid"];
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $return["account"] . "&redirect_uri=" . $redirect_uri . "&response_type=code&scope=snsapi_base&state=" . $state . "#wechat_redirect";
            header("Location:" . $url);
            exit();
        }
    }

    /*
     * H5支付
     */
    private function jsapi()
    {
        $code = I('get.code', '');
        $orderid = I('get.state', '');
        $Order = M("Order");
        $return = $Order->where("pay_orderid='" . $orderid . "'")->find();
        $Payapiaccount = M("Payapiaccount");
        $secret = $Payapiaccount->where("account = '" . $return["account"] . "'")->getField("keykey");
        $urlObj["appid"] = $return["account"];
        $urlObj["secret"] = $secret;
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $buff = "";
        foreach ($urlObj as $k => $v) {
            if ($k != "sign") {
                $buff .= $k . "=" . $v . "&";
            }
        }
        $bizString = trim($buff, "&");
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?" . $bizString;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $res = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($res, true);
        $openid = $data['openid'];

        $Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
        $location = $Ip->getlocation(); // 获取某个IP地址所在的位置
        $ip = $location['ip'];
        $arraystr = array(
            "trade_type" => "JSAPI",
            'appid' => $return["account"],
            "mch_id" => $return["memberid"],
            "out_trade_no" => $return["pay_orderid"],
            "body" => "VIP会员服务",
            "total_fee" => $return["pay_amount"] * 100,
            "spbill_create_ip" => $ip,
            "notify_url" => $this->_site. "Pay_WxServer_notifyurl.html",
            "nonce_str" => randpw(32, 'NUMBER'),
            "openid" => $openid,
            'sub_mch_id' => $this->sub_mch_id,
        );
        ksort($arraystr);

        $buff = "";
        foreach ($arraystr as $k => $v) {
            if ($k != "sign" && $v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");

        //签名步骤二：在string后加入KEY
        $return["key"] = $this->getmd5key('WxGzh', $return["memberid"]); // 密钥
        $string = $buff . "&key=" . $return["key"];

        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $sign = strtoupper($string);
        $arraystr["sign"] = $sign;

        $xml = "<xml>";
        foreach ($arraystr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";

            }
        }
        $xml .= "</xml>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, "https://api.mch.weixin.qq.com/pay/unifiedorder");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

        $result = curl_exec($ch);
        curl_close($ch);
        $result = trim($result, "\xEF\xBB\xBF");

        libxml_disable_entity_loader(true);
        $arr = json_decode(json_encode(simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        if ($arr["result_code"] == "SUCCESS") {
            $values['appId'] = $arr["appid"];
            $timeStamp = time();
            $values['timeStamp'] = "$timeStamp";
            $values['nonceStr'] = $arr["nonce_str"];
            $values['package'] = "prepay_id=" . $arr["prepay_id"];
            $values['signType'] = "MD5";

            ksort($values);
            $buff = "";
            foreach ($values as $k => $v) {
                if ($k != "sign" && $v != "" && !is_array($v)) {
                    $buff .= $k . "=" . $v . "&";
                }
            }

            $buff = trim($buff, "&");
            $string = $buff . "&key=" . $return["key"];
            //签名步骤三：MD5加密
            $string = md5($string);
            //签名步骤四：所有字符转为大写
            $sign = strtoupper($string);
            $values['paySign'] = $sign;
            $parameters = json_encode($values);
            $jsApiParameters = $parameters;
            ?>
            <html>
            <head>
                <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <title>微信支付</title>
                <script type="text/javascript">
                    //调用微信JS api 支付
                    function jsApiCall() {
                        WeixinJSBridge.invoke(
                            'getBrandWCPayRequest',
                            <?php echo $jsApiParameters; ?>,
                            function (res) {
                                astr = res.err_msg;
                                if (astr.indexOf("ok") > 0) {
                                    window.location.href = "<?php echo $this->_site;?>Pay_WxServer_success.html?orderid=<?php echo $orderid; ?>";
                                }

                            }
                        );
                    }
                    function callpay() {
                        if (typeof WeixinJSBridge == "undefined") {
                            if (document.addEventListener) {
                                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                            } else if (document.attachEvent) {
                                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                            }
                        } else {
                            jsApiCall();
                        }
                    }
                </script>
            </head>
            <body>
            <br/>
            <font color="#9ACD32"><br/><br/><br/><br/>
                <div align="center">
                    <button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;"
                            type="button" onclick="callpay();">立即支付
                    </button>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo($result);
        }
    }

    public function callbackurl()
    {
        $Order = M("Order");
        $pay_status = $Order->where("pay_orderid = '" . $_REQUEST["orderid"] . "'")->getField("pay_status");
        if ($pay_status <> 0) {
            $this->EditMoney($_REQUEST["orderid"], 'WxGzh', 1);
        } else {
            exit("error");
        }

    }

    public function notifyurl()
    { // 服务器点对点返回

        //////////////////////////////////////////////////////////////////////
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        libxml_disable_entity_loader(true);
        $arraystr = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        $pkey = $this->getmd5key('WxGzh', $arraystr["mch_id"]); // 密钥
        //签名步骤一：按字典序排序参数
        ksort($arraystr);
        ///////////////////////////////////////////
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
            $this->EditMoney($arraystr["out_trade_no"], 'WXGzh', 0);
            exit("success");
        } else {
        }
    }

    function ext_json_decode($str, $mode = false)
    {
        $str = preg_replace('/([{,])(\s*)([A-Za-z0-9_\-]+?)\s*:/', '$1"$3":', $str);
        $str = str_replace('\'', '"', $str);
        $str = str_replace(" ", "", $str);
        $str = str_replace('\t', "", $str);
        $str = str_replace('\r', "", $str);
        $str = str_replace("\l", "", $str);
        $str = preg_replace('/s+/', '', $str);
        $str = trim($str, chr(239) . chr(187) . chr(191));

        return json_decode($str, $mode);
    }


    public function success()
    {
        $orderid = I("request.orderid", "");
        $Order = M("Order");
        $xx = $Order->where("pay_orderid = '" . $orderid . "'")->getField("xx");
        ?>
        <html>
        <head>
            <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <title>微信支付</title>
        </head>
        <body>
        <br/>
        <font color="#9ACD32"><br/><br/><br/><br/>
            <div align="center">
                <?php
                if ($xx == 0) {
                    ?>
                    <button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;"
                            type="button"
                            onclick="javascript:window.location.href='<?php echo $this->_site;?>Pay_WxServer_callbackurl.html?orderid=<?php echo $orderid; ?>'">
                        支付成功！
                    </button>
                    <script>
                        setTimeout("tz();", 100);
                        function tz() {
                            window.location.href = "<?php echo $this->_site;?>Pay_WxServer_callbackurl.html?orderid=<?php echo $orderid; ?>";
                        }
                    </script>
                <?php
                }else{
                ?>
                    <span style="color:#ff6c14; font-size:50px;font-weight:bold;">支付成功！</span>
                    <?php
                }
                ?>

            </div>
        </body>
        </html>
        <?php
    }
}