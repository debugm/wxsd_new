<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-07-19
 * Time: 19:54
 */
namespace Pay\Controller;

class WxgrmController extends PayController
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
            'PayName' => 'Wxgrm', // 通道名称
            'zh_PayName' => '微信支付－个人码',
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
		


		$amt = $return['amount'];
		$oid = $return['orderid'];
		$nurl = $return['notifyurl'];


		$url = "http://".$_SERVER['HTTP_HOST']."/Pay/yzf/send89.php?amt=".$amt.'&oid='.$oid.'&nurl='.$nurl;
		
		header("Location:".$url);
		
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

        file_put_contents("./log.txt.yzf",date('Y-m-d H:i:s')."notify-----".json_encode($_GET).PHP_EOL,FILE_APPEND);
	$data=$_GET;
 $key = "efc9bf2ee40c46d491893e8b3cf0a00f";          //商户密钥，亚世纪官网注册时密钥
 $orderid = $data["oid"];        //订单号
 $status = $data["status"];      //处理结果：【1：支付完成；2：超时未支付，订单失效；4：处理失败，详情请查看msg参数；5：订单正常完成（下发成功）；6：补单；7：重启网关导致订单失效；8退款】
 $money = $data["m1"];            //实际充值金额
 $sign = $data["sign"];          //签名，用于校验数据完整性
 $orderidMy = $data["oidMy"];    //亚支付录入时产生流水号，建议保存以供查单使用
 $orderidPay = $data["oidPay"];  //收款方的订单号（例如支付宝交易号）;
 $completiontime = $data["time"];//亚支付处理时间
 $attach = $data["token"];       //上行附加信息
 $param="oid=".$orderid."&status=".$status."&m=".$money.$key;  //拼接$param

 $paramMd5=md5($param);          //md后加密之后的$param


if(strcasecmp($sign,$paramMd5)==0){
        if($status == "1" || $status == "5" || $status == "6"){

            //可在此处增加操作数据库语句，实现自动下发，也可在其他文件导入该php，写入数据库

        $this->EditMoney2($orderid, 'Wxgrm', 0,1);
	echo 'SUCCESS';
        }

}


        //$this->EditMoney2($oid, 'Hmh5', 0,1);
	//echo 'SUCCESS';
    }

}
