<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-05-18
 * Time: 11:33
 */
namespace Pay\Controller;

use Think\Exception;

class AlipayController extends PayController
{
    public function __construct()
    {
        parent::__construct();
    }

    //支付
    public function Pay()
    {
        $orderid = I("request.pay_orderid");
        $paymethod = I('post.pay_tradetype');
        $body = I('request.pay_productname');
        $notifyurl = $this->_site . 'Pay_Alipay_notifyurl.html'; //异步通知
        $callbackurl = $this->_site . 'Pay_Alipay_callbackurl.html'; //返回通知
        $parameter = array(
            'PayName' => 'Alipay', // 通道名称
            'zh_PayName' => '支付宝官方',
            'moneyratio' => 1, // 金额比例
            'tjurl' => '',
            'orderid' => $orderid,
            'body'=>$body,
        );
        // 订单号，可以为空，如果为空，由系统统一的生成
        $return = $this->orderadd($parameter);

        if ($return["status"] == "error") {
            $this->ErrorReturn($return["errorcontent"]);
        }
        $return['subject'] = $body;
        switch ($paymethod)
        {
            case 'alipayPage':
                $this->alipayPage($return);
                break;
            case 'alipayWap':
                $this->alipayWap($return);
                break;
            case 'alipayPrecreate':
                $this->alipayPrecreate($return);
                break;
        }
    }

    protected function alipayPage($params)
    {
        $data = array(
            'out_trade_no'=>$params['orderid'],
            'total_amount'=>$params['amount'],
            'subject'=>$params['subject'],
            'product_code' => "FAST_INSTANT_TRADE_PAY"
        );
        $sysParams = json_encode($data,JSON_UNESCAPED_UNICODE);

        vendor('Alipay.aop.AopClient');
        vendor('Alipay.aop.SignData');
        vendor('Alipay.aop.request.AlipayTradePagePayRequest');
        $aop = new \AopClient();
        $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
        $aop->appId = $params['sid'];
        $aop->rsaPrivateKey = 'MIIEpAIBAAKCAQEAtvDQk9LG+LDpbk6xiecxqjPg9f4BhNYurJDFrVybxISAqCUM5/ofz/mIMTHQJ6mOdjtHG53ux6ADs7GZ+U7Vg5IZUkdkENxd7I0KIoXryQAQFDkDGrOPbaUoD9icpOzE7fm774J6bDh/0oFfB3OojDkjxYN6zObW/PIqU6DrL3S3Ka5b3qEH8NuuiN/f0SFBwE7gYpyPZ/WcuiHjvMkB0mbzGtWYrNXczU1gQ+9c+0v0pjXrddajC8/IlWDgDJCbIM+hgrWG7VieKnp2RnLdGH+Ok2yPdS9c3pEVxzBTcRkt8kvPo522FtoTPtC3cg0AsJsEvNA6A9/AGN2qHxzK2QIDAQABAoIBAQCvJO8MF4gXIIjb6ste09FgujpuSLj7jHMzE4et6jPXeWQTlyU8EuPSIXyaXK6EynhyCV6SuimZRUFGEIrxfOA+DunfNCpBWjkx9/X0B3MuBLlgIxUtwytWNgCc6y1NWMFRdP7Q14KNiaoWx3VLlReQ6EOvHam78mVx1gdf+Xgw/VQ3CCtA+MzH7OiiC9i/bx1EFewzOCNy3+iAXgJ0OXELe5mL4K1zN/XJKRMbc+b35SL6S54iFw/iplDhY74/J6odqvkXIoCRwteIXDD1Xl7mxv4gNwBd9REP7Z+IB3I9Y0I7JtbAiUl6dQPr/rHYsfvZwHfAQVORsbYM+Ehsn1uBAoGBAPJQUheIv7SnuHeBabkJ8+EdUay2gmsjpja6U6Tzbw00aSjnUZUETIpmTS2WwixvvoOHjLe+nOUB/g+ZDxmtSKOSXd7pKEgbH/R8x3n7HYJr6qI/VMzsYuRXOz03l7Q6HA/c8YgC26UTrtFha4m0eIX7rQKOo9U/wxEbBikMD16tAoGBAMFGAMQeX+olv4+esxzXh97gmfks+2ZRrdiydBz2N14fwFb7bhtnn/hoYFb0TesSDCxp5zekVo5PlFgLWQ4jEVqqAUDP8uwG/Lq8iRHUp7BeBkOMHaIBDprH51wcrEMmDvk0v576B6Xe6VR3QJCUJLtq8tVL7+18Lu5BHu6xr75dAoGBAKN3tCnUQx/olfVpBJ2kLTaMxPCzH0CQCC2bfZol76EE3nyNsOfKwqgLY72BmvTHXcr1wuSiXs3PjkmPhDRaRkqzD0i2GkqqoeAZ3ahY1AuMKfnSp66nOf+5KWme+2TGXvAEqZyL8QloQeNWyWlYqoYYxxqWh8fw//OmO32teSDxAoGAGCThlZ5hxwNeMdfWckTugUY3lewrn7WWbRql7LRJaGW5BmS0dZH1ZvfLCTHNxg7kHGxCaS4Lbg28717DikOROG1CaNFRfHDHA6Dn0qVpKVwlliybyxAsveM5IMWoM18+wZz4TyjW6b62EUowc58+E3ehzEmHOHip+DOEZLcnyDUCgYAqKOvH/UkgdNTR5NoQZmLSXuEuYimBiR6sNtV4ggdlAT9/e7ON+PHCg63nW1sULPZMkvtnGgkUg8p6/KCkPJopHzmt+TXqJBdMBI3rHW70QlOB5O0xFEbpYwF6mQ42uVLZY3GTD2qr3ksp/ts/cgjfgtpbfFTH7hEh42ftApD6IQ==';
        $aop->alipayrsaPublicKey= $params['key'];
        $aop->apiVersion = '1.0';
        $aop->signType = 'RSA2';
        $aop->postCharset='UTF-8';
        $aop->format='json';
        $aop->debugInfo=true;
        $request = new \AlipayTradePagePayRequest();
        $request->setBizContent($sysParams);
        $request->setNotifyUrl($params['notifyurl']);
        $request->setReturnUrl($params['callbackurl']);
        $result = $aop->pageExecute($request,'post');
        echo $result;
    }
    protected function alipayWap($params){

        $data = array(
            'out_trade_no'=>$params['orderid'],
            'total_amount'=>$params['amount'],
            'subject'=>$params['subject'],
            'product_code' => "FAST_INSTANT_TRADE_PAY"
        );
        $sysParams = json_encode($data,JSON_UNESCAPED_UNICODE);

        vendor('Alipay.aop.AopClient');
        vendor('Alipay.aop.SignData');
        vendor('Alipay.aop.request.AlipayTradeWapPayRequest');
        $aop = new \AopClient();
        $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
        $aop->appId = $params['sid'];
        $aop->rsaPrivateKey = 'MIIEpAIBAAKCAQEAtvDQk9LG+LDpbk6xiecxqjPg9f4BhNYurJDFrVybxISAqCUM5/ofz/mIMTHQJ6mOdjtHG53ux6ADs7GZ+U7Vg5IZUkdkENxd7I0KIoXryQAQFDkDGrOPbaUoD9icpOzE7fm774J6bDh/0oFfB3OojDkjxYN6zObW/PIqU6DrL3S3Ka5b3qEH8NuuiN/f0SFBwE7gYpyPZ/WcuiHjvMkB0mbzGtWYrNXczU1gQ+9c+0v0pjXrddajC8/IlWDgDJCbIM+hgrWG7VieKnp2RnLdGH+Ok2yPdS9c3pEVxzBTcRkt8kvPo522FtoTPtC3cg0AsJsEvNA6A9/AGN2qHxzK2QIDAQABAoIBAQCvJO8MF4gXIIjb6ste09FgujpuSLj7jHMzE4et6jPXeWQTlyU8EuPSIXyaXK6EynhyCV6SuimZRUFGEIrxfOA+DunfNCpBWjkx9/X0B3MuBLlgIxUtwytWNgCc6y1NWMFRdP7Q14KNiaoWx3VLlReQ6EOvHam78mVx1gdf+Xgw/VQ3CCtA+MzH7OiiC9i/bx1EFewzOCNy3+iAXgJ0OXELe5mL4K1zN/XJKRMbc+b35SL6S54iFw/iplDhY74/J6odqvkXIoCRwteIXDD1Xl7mxv4gNwBd9REP7Z+IB3I9Y0I7JtbAiUl6dQPr/rHYsfvZwHfAQVORsbYM+Ehsn1uBAoGBAPJQUheIv7SnuHeBabkJ8+EdUay2gmsjpja6U6Tzbw00aSjnUZUETIpmTS2WwixvvoOHjLe+nOUB/g+ZDxmtSKOSXd7pKEgbH/R8x3n7HYJr6qI/VMzsYuRXOz03l7Q6HA/c8YgC26UTrtFha4m0eIX7rQKOo9U/wxEbBikMD16tAoGBAMFGAMQeX+olv4+esxzXh97gmfks+2ZRrdiydBz2N14fwFb7bhtnn/hoYFb0TesSDCxp5zekVo5PlFgLWQ4jEVqqAUDP8uwG/Lq8iRHUp7BeBkOMHaIBDprH51wcrEMmDvk0v576B6Xe6VR3QJCUJLtq8tVL7+18Lu5BHu6xr75dAoGBAKN3tCnUQx/olfVpBJ2kLTaMxPCzH0CQCC2bfZol76EE3nyNsOfKwqgLY72BmvTHXcr1wuSiXs3PjkmPhDRaRkqzD0i2GkqqoeAZ3ahY1AuMKfnSp66nOf+5KWme+2TGXvAEqZyL8QloQeNWyWlYqoYYxxqWh8fw//OmO32teSDxAoGAGCThlZ5hxwNeMdfWckTugUY3lewrn7WWbRql7LRJaGW5BmS0dZH1ZvfLCTHNxg7kHGxCaS4Lbg28717DikOROG1CaNFRfHDHA6Dn0qVpKVwlliybyxAsveM5IMWoM18+wZz4TyjW6b62EUowc58+E3ehzEmHOHip+DOEZLcnyDUCgYAqKOvH/UkgdNTR5NoQZmLSXuEuYimBiR6sNtV4ggdlAT9/e7ON+PHCg63nW1sULPZMkvtnGgkUg8p6/KCkPJopHzmt+TXqJBdMBI3rHW70QlOB5O0xFEbpYwF6mQ42uVLZY3GTD2qr3ksp/ts/cgjfgtpbfFTH7hEh42ftApD6IQ==';
        $aop->alipayrsaPublicKey= $params['key'];
        $aop->apiVersion = '1.0';
        $aop->signType = 'RSA2';
        $aop->postCharset='UTF-8';
        $aop->format='json';
        $request = new \AlipayTradeWapPayRequest ();
        $request->setBizContent($sysParams);
        $request->setNotifyUrl($params['notifyurl']);
        $request->setReturnUrl($params['callbackurl']);
        $result = $aop->pageExecute ( $request,"post");
        echo $result;
    }

    protected function alipayPrecreate($params)
    {
        //组装系统参数
        $data = array(
            'out_trade_no'=>$params['orderid'],
            'total_amount'=>$params['amount'],
            'subject'=>$params['subject'],
        );
        $sysParams = json_encode($data,JSON_UNESCAPED_UNICODE);

        vendor('Alipay.aop.AopClient');
        vendor('Alipay.aop.SignData');
        vendor('Alipay.aop.request.AlipayTradePrecreateRequest');
        $aop = new \AopClient();
        $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
        $aop->appId = $params['sid'];
        $aop->rsaPrivateKey = 'MIIEpAIBAAKCAQEAtvDQk9LG+LDpbk6xiecxqjPg9f4BhNYurJDFrVybxISAqCUM5/ofz/mIMTHQJ6mOdjtHG53ux6ADs7GZ+U7Vg5IZUkdkENxd7I0KIoXryQAQFDkDGrOPbaUoD9icpOzE7fm774J6bDh/0oFfB3OojDkjxYN6zObW/PIqU6DrL3S3Ka5b3qEH8NuuiN/f0SFBwE7gYpyPZ/WcuiHjvMkB0mbzGtWYrNXczU1gQ+9c+0v0pjXrddajC8/IlWDgDJCbIM+hgrWG7VieKnp2RnLdGH+Ok2yPdS9c3pEVxzBTcRkt8kvPo522FtoTPtC3cg0AsJsEvNA6A9/AGN2qHxzK2QIDAQABAoIBAQCvJO8MF4gXIIjb6ste09FgujpuSLj7jHMzE4et6jPXeWQTlyU8EuPSIXyaXK6EynhyCV6SuimZRUFGEIrxfOA+DunfNCpBWjkx9/X0B3MuBLlgIxUtwytWNgCc6y1NWMFRdP7Q14KNiaoWx3VLlReQ6EOvHam78mVx1gdf+Xgw/VQ3CCtA+MzH7OiiC9i/bx1EFewzOCNy3+iAXgJ0OXELe5mL4K1zN/XJKRMbc+b35SL6S54iFw/iplDhY74/J6odqvkXIoCRwteIXDD1Xl7mxv4gNwBd9REP7Z+IB3I9Y0I7JtbAiUl6dQPr/rHYsfvZwHfAQVORsbYM+Ehsn1uBAoGBAPJQUheIv7SnuHeBabkJ8+EdUay2gmsjpja6U6Tzbw00aSjnUZUETIpmTS2WwixvvoOHjLe+nOUB/g+ZDxmtSKOSXd7pKEgbH/R8x3n7HYJr6qI/VMzsYuRXOz03l7Q6HA/c8YgC26UTrtFha4m0eIX7rQKOo9U/wxEbBikMD16tAoGBAMFGAMQeX+olv4+esxzXh97gmfks+2ZRrdiydBz2N14fwFb7bhtnn/hoYFb0TesSDCxp5zekVo5PlFgLWQ4jEVqqAUDP8uwG/Lq8iRHUp7BeBkOMHaIBDprH51wcrEMmDvk0v576B6Xe6VR3QJCUJLtq8tVL7+18Lu5BHu6xr75dAoGBAKN3tCnUQx/olfVpBJ2kLTaMxPCzH0CQCC2bfZol76EE3nyNsOfKwqgLY72BmvTHXcr1wuSiXs3PjkmPhDRaRkqzD0i2GkqqoeAZ3ahY1AuMKfnSp66nOf+5KWme+2TGXvAEqZyL8QloQeNWyWlYqoYYxxqWh8fw//OmO32teSDxAoGAGCThlZ5hxwNeMdfWckTugUY3lewrn7WWbRql7LRJaGW5BmS0dZH1ZvfLCTHNxg7kHGxCaS4Lbg28717DikOROG1CaNFRfHDHA6Dn0qVpKVwlliybyxAsveM5IMWoM18+wZz4TyjW6b62EUowc58+E3ehzEmHOHip+DOEZLcnyDUCgYAqKOvH/UkgdNTR5NoQZmLSXuEuYimBiR6sNtV4ggdlAT9/e7ON+PHCg63nW1sULPZMkvtnGgkUg8p6/KCkPJopHzmt+TXqJBdMBI3rHW70QlOB5O0xFEbpYwF6mQ42uVLZY3GTD2qr3ksp/ts/cgjfgtpbfFTH7hEh42ftApD6IQ==';
        $aop->alipayrsaPublicKey= $params['key'];
        $aop->apiVersion = '1.0';
        $aop->signType = 'RSA2';
        $aop->postCharset='UTF-8';
        $aop->format='json';
        $request = new \AlipayTradePrecreateRequest ();
        $request->setBizContent($sysParams);
        $request->setNotifyUrl($params['notifyurl']);
        $result = $aop->execute ( $request);

        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $resultCode = $result->$responseNode->code;

        if(!empty($resultCode)&&$resultCode == 10000){
            import("Vendor.phpqrcode.phpqrcode",'',".php");
            $url = urldecode($result->$responseNode->qr_code);
            $QR = "Uploads/codepay/". $params["orderid"] . ".png";//已经生成的原始二维码图
            $delqr = $QR;
            \QRcode::png($url, $QR, "L", 20);
            //$this->assign("imgurl", $this->_site.$QR);
            //$this->assign("ddh", $result->$responseNode->out_trade_no);
            //$this->assign("money", $params["amount"] / 100);
            //$this->display("WeiXin/Pay");
            echo json_encode(array('status'=>1,'codeurl'=>$this->_site.$QR));
            exit();
        } else {
            echo "失败";
        }
        exit();
    }
    //同步通知
    public function callbackurl()
    {
        $response = $_GET;
        $sign = $response['sign'];
        $sign_type = $response['sign_type'];
        unset($response['sign']);
        unset($response['sign_type']);
        $publiKey =  $this->getmd5key('Alipay', $response["app_id"]); // 密钥

        ksort($response);
        $signData = '';
        foreach ($response as $key=>$val){
            $signData .= $key .'='.$val."&";
        }
        $signData = trim($signData,'&');
        //$checkResult = $aop->verify($signData,$sign,$publiKey,$sign_type);
        $res = "-----BEGIN PUBLIC KEY-----\n" . wordwrap($publiKey, 64, "\n", true) . "\n-----END PUBLIC KEY-----";
        $result = (bool)openssl_verify($signData, base64_decode($sign), $res, OPENSSL_ALGO_SHA256);

        if($result){
            $this->EditMoney($response['out_trade_no'], 'Alipay', 1);
        }else{
            exit('error:check sign Fail!');
        }

    }

    //异步通知
    public function notifyurl()
    {
        $response = $_POST;
        $sign = $response['sign'];
        $sign_type = $response['sign_type'];
        unset($response['sign']);
        unset($response['sign_type']);
        $publiKey =  $this->getmd5key('Alipay', $response["app_id"]); // 密钥

        ksort($response);
        $signData = '';
        foreach ($response as $key=>$val){
            $signData .= $key .'='.$val."&";
        }
        $signData = trim($signData,'&');
        //$checkResult = $aop->verify($signData,$sign,$publiKey,$sign_type);
        $res = "-----BEGIN PUBLIC KEY-----\n" . wordwrap($publiKey, 64, "\n", true) . "\n-----END PUBLIC KEY-----";
        $result = (bool)openssl_verify($signData, base64_decode($sign), $res, OPENSSL_ALGO_SHA256);

        if($result){
            if($response['trade_status'] == 'TRADE_SUCCESS' || $response['trade_status'] == 'TRADE_FINISHED'){
                $this->EditMoney($response['out_trade_no'], 'Alipay', 0);
                exit("success");
            }
        }else{
            exit('error:check sign Fail!');
       }

    }

    /** *利用google api生成二维码图片
     * $content：二维码内容参数
     * $size：生成二维码的尺寸，宽度和高度的值
     * $lev：可选参数，纠错等级
     * $margin：生成的二维码离边框的距离
     */
    function create_erweima($content, $size = '200', $lev = 'L', $margin= '0') {
        $content = urlencode($content);
        $image = 'http://chart.apis.google.com/chart?chs='.$size.'x'.$size.'&amp;cht=qr&chld='.$lev.'|'.$margin.'&amp;chl='.$content;
        return $image;
    }
}