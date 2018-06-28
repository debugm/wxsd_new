<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-07-19
 * Time: 19:54
 */
namespace Pay\Controller;

class DingpayController extends PayController
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
        $this->merchant_private_key = 'MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBANg3C6XLoX/T8OuHG6unoa2qBu0TA5E4iwyDAA6nP2bYsMYUasnphaVEItLwU5SUcPmEgETUwYk151HlDrA8A5wejLfCw294/Iyd2ipyeLitbqV50GDZSyMrkBs5fUT8mOwvOch4VBcdLOjlQJ2dkUvPCu1HdTXpqMBI+bwHHZaLAgMBAAECgYEAy/wyyvqwpS7JjwvquSnvyS4uVqCnruyPkwBMn4Z+tIMfU+GTVmcwpVkBGc2OrRDW/TFa6pVm+hKW6JaYIwCbzYP4wqGP3BRMz+HFeBkok/5eXmtQzgeymouLJ1qcTX1lu3EkoldCqhDlkdyDZjUjGY68fmb9LNITbGCFAeDcTHECQQD5mQ3pn82gDeWxI5QlPAGzk0LTQLtJtxaSkyPWq73w4ZGFydjqNOGOi3KZ216glXKaci0yVQHTHOTreiSNn3wnAkEA3cLJsdhLlgDcV2wC065Sd+fFJtVdf+AXK+pDwJMjyRFJwdciAqUN2CpbTIIX4DxejSapVEB5c25Cccnxbdt8/QJAdPd8xZbVzcO1eCWsLybHxVelYUpcelcKhPXfPaKOCGwsvf2xYVAWw64lrmRXG/ntEuOeuo+Lo1tPC+rZZmTu0QJATrZ7HPMnMSExFJ60CirP/tt3cSc+vsrtrprCXbJce1v1kCYqXkHzvgyax3dNvjvvW66jX9JayYwTbYw+c736iQJARX4n1y+OTyZW/EagJSWupDly7+tdsWAPiSOKlBxso3PSXo0XlqAaWFceavlslwG3VqAYDVQRbv8oxWZn898y8Q==';
        $this->merchant_public_key = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDYNwuly6F/0/Drhxurp6GtqgbtEwOROIsMgwAOpz9m2LDGFGrJ6YWlRCLS8FOUlHD5hIBE1MGJNedR5Q6wPAOcHoy3wsNvePyMndoqcni4rW6ledBg2UsjK5AbOX1E/JjsLznIeFQXHSzo5UCdnZFLzwrtR3U16ajASPm8Bx2WiwIDAQAB';
        $this->dinpay_public_key = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCq4NNfo2/cGGkmCgHe8kNaJSVx60PqKof37hMYJmZUawWVgWccWteJrJhAm/7PD2651l9enIzPQAd1qn1noWO3eUbFPNnj0cJJnlJgHLLTnYXHPPF7oQUT9TumcpYa/fCNEqCU68Sm21B2PPRNRXoaenh88NCtsbH3RDyeviqOiQIDAQAB';
    }

    //支付
    public function Pay(){
        $orderid = I("request.pay_orderid", "");
        $paymethod = I('post.pay_tradetype');
        $body = I('request.pay_productname','');
        $notifyurl = $this->_site . 'Pay_Dingpay_notifyurl.html'; //异步通知
        $callbackurl = $this->_site . 'Pay_Dingpay_callbackurl.html'; //返回通知
        $parameter = array(
            'PayName' => 'Dingpay', // 通道名称
            'zh_PayName' => '智付扫码',
            'moneyratio' => 1, // 金额比例
            'tjurl' => '',
            'orderid' => $orderid,
            'body'=>$body,
        );
        // 订单号，可以为空，如果为空，由系统统一的生成
        $return = $this->orderadd($parameter);
        if ($return["status"] == "error") {
            $this->ErrorReturn($return["errorcontent"]);
        }else{

            $Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
            $location = $Ip->getlocation(); // 获取某个IP地址所在的位置
            $ip = $location['ip'];

            $merchant_code = $return["sid"];//商户号，1118004517是测试商户号，调试时要更换商家自己的商户号
            $service_type = $paymethod;//微信：weixin_scan 支付宝：alipay_scan 智汇宝：zhb_scan
            $notify_url = $notifyurl;
            $interface_version = "V3.1";
            $client_ip = $ip;
            $sign_type = "RSA-S";
            $order_no = $return['orderid'];
            $order_time = date('Y-m-d H:i:s');
            $order_amount = $return['amount'];
            $product_name = $body;
            $product_code = $_POST["product_code"];
            $product_num = $_POST["product_num"];
            $product_desc = $_POST["product_desc"];
            $extra_return_param =$_POST["extra_return_param"];
            $extend_param = $_POST["extend_param"];

            //参数组装
            $signStr = "";
            $signStr = $signStr."client_ip=".$client_ip."&";
            if($extend_param != ""){
                $signStr = $signStr."extend_param=".$extend_param."&";
            }
            if($extra_return_param != ""){
                $signStr = $signStr."extra_return_param=".$extra_return_param."&";
            }
            $signStr = $signStr."interface_version=".$interface_version."&";
            $signStr = $signStr."merchant_code=".$merchant_code."&";
            $signStr = $signStr."notify_url=".$notify_url."&";
            $signStr = $signStr."order_amount=".$order_amount."&";
            $signStr = $signStr."order_no=".$order_no."&";
            $signStr = $signStr."order_time=".$order_time."&";
            if($product_code != ""){
                $signStr = $signStr."product_code=".$product_code."&";
            }
            if($product_desc != ""){
                $signStr = $signStr."product_desc=".$product_desc."&";
            }
            $signStr = $signStr."product_name=".$product_name."&";
            if($product_num != ""){
                $signStr = $signStr."product_num=".$product_num."&";
            }
            $signStr = $signStr."service_type=".$service_type;

            //初始化商户私钥
            $merchant_private_key = "-----BEGIN PRIVATE KEY-----"."\r\n".wordwrap(trim($this->merchant_private_key),64,"\r\n",true)."\r\n"."-----END PRIVATE KEY-----";
            $merchant_private_key= openssl_get_privatekey($merchant_private_key);
            openssl_sign($signStr,$sign_info,$merchant_private_key,OPENSSL_ALGO_MD5);
            $sign = base64_encode($sign_info);
            $postdata=array(
                'extend_param'=>$extend_param,
                'extra_return_param'=>$extra_return_param,
                'product_code'=>$product_code,
                'product_desc'=>$product_desc,
                'product_num'=>$product_num,
                'merchant_code'=>$merchant_code,
                'service_type'=>$service_type,
                'notify_url'=>$notify_url,
                'interface_version'=>$interface_version,
                'sign_type'=>$sign_type,
                'order_no'=>$order_no,
                'client_ip'=>$client_ip,
                'sign'=>$sign,
                'order_time'=>$order_time,
                'order_amount'=>$order_amount,
                'product_name'=>$product_name
            );
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,"https://api.dinpay.com/gateway/api/scanpay");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response=curl_exec($ch);
            curl_close($ch);
            $_reponse = xmlToArray($response);
            $_reponse = $_reponse['response'];
            if($_reponse['resp_code'] == "SUCCESS"){
                import("Vendor.phpqrcode.phpqrcode",'',".php");
                $url = urldecode($_reponse['qrcode']);
                $QR = "Uploads/codepay/". $return["orderid"] . ".png";//已经生成的原始二维码图
                \QRcode::png($url, $QR, "L", 20);

                //返回数据
                /*$replydata = [
                    'returnCode'=>"00",
                    'memberid'=>$return['memberid'],
                    'orderid'=>$return['orderid'],
                    'amount'=>$_reponse['order_amount'],
                    'code_url'=>$_reponse['qrcode'],
                    'code_img_url'=>$this->_site.$QR
                ];
                ksort($replydata);
                $signature = "";
                foreach ($replydata as $key => $val) {
                    $signature = $signature . $key . "=" . $val . "&";
                }
                $replydata['sign'] = strtoupper(md5($signature . "key=" . $this->userinfo['md5key']));
                echo json_encode($replydata,JSON_UNESCAPED_UNICODE);*/

                //显示二维码
                $this->assign("imgurl", $this->_site.$QR);
                $this->assign('title',$body);
                $this->assign("ddh", $return["orderid"]);
                $this->assign("money", $return["amount"]);
                $this->display("WeiXin/Pay");
            }else{
                exit(json_encode($_reponse));
            }
        }
    }

    //页面通知
    public function callbackurl()
    {
        $Order = M("Order");
        $pay_status = $Order->where("pay_orderid = '".$_REQUEST['orderid']."'")->getField("pay_status");
        if($pay_status <> 0) {
            $this->EditMoney($_REQUEST['orderid'], 'Dingpay', 1);
            echo "success";
        }

    }

    //服务器通知
    public function notifyurl()
    {
        file_put_contents('d.txt',file_get_contents('php://input'));
        $merchant_code	= $_POST["merchant_code"];
        $interface_version = $_POST["interface_version"];
        $sign_type = $_POST["sign_type"];
        $dinpaySign = base64_decode($_POST["sign"]);
        $notify_type = $_POST["notify_type"];
        $notify_id = $_POST["notify_id"];
        $order_no = $_POST["order_no"];
        $order_time = $_POST["order_time"];
        $order_amount = $_POST["order_amount"];
        $trade_status = $_POST["trade_status"];
        $trade_time = $_POST["trade_time"];
        $trade_no = $_POST["trade_no"];
        $bank_seq_no = $_POST["bank_seq_no"];
        $extra_return_param = $_POST["extra_return_param"];

        //参数组装
        $signStr = "";
        if($bank_seq_no != ""){
            $signStr = $signStr."bank_seq_no=".$bank_seq_no."&";
        }
        if($extra_return_param != ""){
            $signStr = $signStr."extra_return_param=".$extra_return_param."&";
        }
        $signStr = $signStr."interface_version=".$interface_version."&";
        $signStr = $signStr."merchant_code=".$merchant_code."&";
        $signStr = $signStr."notify_id=".$notify_id."&";
        $signStr = $signStr."notify_type=".$notify_type."&";
        $signStr = $signStr."order_amount=".$order_amount."&";
        $signStr = $signStr."order_no=".$order_no."&";
        $signStr = $signStr."order_time=".$order_time."&";
        $signStr = $signStr."trade_no=".$trade_no."&";
        $signStr = $signStr."trade_status=".$trade_status."&";
        $signStr = $signStr."trade_time=".$trade_time;
        //echo $signStr;

        //RSA-S验证
        $dinpay_public_key = "-----BEGIN PUBLIC KEY-----"."\r\n".wordwrap(trim($this->dinpay_public_key),62,"\r\n",true)."\r\n"."-----END PUBLIC KEY-----";
        $dinpay_public_key = openssl_get_publickey($dinpay_public_key);
        $flag = openssl_verify($signStr,$dinpaySign,$dinpay_public_key,OPENSSL_ALGO_MD5);
        //响应"SUCCESS"
        if($flag){
            $this->EditMoney($order_no, 'Dingpay', 0);
            echo"SUCCESS";
        }else{
            echo"Verification Error";
        }

    }
}