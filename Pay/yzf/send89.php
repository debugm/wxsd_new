
<?php	
header("Content-type:text/html;charset=utf-8");
//$data=$_POST;       //post方式获得表单提交的数据
                      
$shop_id=2917;         //商户ID，商户在亚世纪官网申请到的商户ID
$bank_Type=102;   //充值渠道，101表示支付宝快速到账通道
$bank_payMoney=$_GET['amt'];     //充值金额
$orderid=$_GET['oid'];                  //商户的订单ID，【请根据实际情况修改】
$callbackurl=$_GET['nurl'];        //商户的回掉地址，【请根据实际情况修改】
$gofalse="http://vip.ziyubaihuo.com";                    //订单二维码失效，需要重新创建订单时，跳到该页
$gotrue="http://vip.ziyubaihuo.com/Pay/yzf/success.php";                         //支付成功后，跳到此页面
$key="efc9bf2ee40c46d491893e8b3cf0a00f";                      //密钥
$posturl='http://www.yasjpay.com/pay/';                   //亚支付api的post提交接口服务器地址

$charset="utf-8";                                              //字符集编码方式
$token="中文";                                                 //自定义传过来的值 亚世纪平台会返回原值
$parma='uid='.$shop_id.'&type='.$bank_Type.'&m='.$bank_payMoney.'&orderid='.$orderid.'&callbackurl='.$callbackurl;     //拼接$param字符串
$parma_key=md5($parma . $key);                                 //md5加密
$PostUrl=$posturl."?".$parma."&sign=".$parma_key."&gofalse=".$gofalse."&gotrue=".$gotrue."&charset=".$charset."&token=".$token;       //生成指定网址


//跳转到指定网站
if (isset($PostUrl)) 
   { 
       header("Location: $PostUrl"); 
       exit;
   }else{
			 	echo "<script type='text/javascript'>";
				echo "window.location.href='$PostUrl'";
				echo "</script>";	
};
?>
