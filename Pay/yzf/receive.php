<?php
 header("Content-type:text/html;charset=utf-8");
 $data=$_GET;
 $key = "请自行配置商户密钥";          //商户密钥，亚世纪官网注册时密钥
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

 		echo "商户收款成功，订单正常完成！";
 	}
 	else if($status == "4"){
 		echo "订单处理失败，因为：" . $msg;
 	}
 	else if ($status == "8")
       {
        echo "订单已经退款！";
       }
 }else{
 	echo "签名无效，视为无效数据!";
 }
?>