<?php
   $ReturnArray = array( // 返回字段
            "memberid" => $_REQUEST["memberid"], // 商户ID
            "orderid" =>  $_REQUEST["orderid"], // 订单号
            "amount" =>  $_REQUEST["amount"], // 交易金额
            "datetime" =>  $_REQUEST["datetime"], // 交易时间
            "returncode" => $_REQUEST["returncode"]
        );
      
        $Md5key = "jn4kqkgo66nl7dxsowbvjdzekllatv";
   
		ksort($ReturnArray);
        reset($ReturnArray);
        $md5str = "";
        foreach ($ReturnArray as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        $sign = strtoupper(md5($md5str . "key=" . $Md5key)); 
        if ($sign == $_REQUEST["sign"]) {
			
            if ($_REQUEST["returncode"] == "00") {
				   $str = "交易成功！订单号：".$_REQUEST["orderid"];
                   file_put_contents("success.txt",$str."\n", FILE_APPEND);
				   exit("ok");
            }
        }


        $dbhost = 'localhost';
    $dbuser  = 'root';
    $dbpwd   = 'ROOTroot123456';
    $dbname  = 'www1ehnet';
    $dbprefix = 'lzh';

    $conn = mysql_connect($dbhost,$dbuser,$dbpwd);
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db($dbname,$conn);
    mysql_query("SET NAMES UTF8");

    $orderId = $order_no;
    $amount = $order_amount;

    $sql = "select * from payorder where ddh = '".$orderId."'";
    $result = mysql_query($sql);
    $rows = mysql_fetch_array($result);

    if(!$rows){
        die('订单不存在！');
    }

    if($rows['status'] == 2){
        echo 'SUCCESS';
        exit;
    }

    $sql = "update payorder set status=2 where ddh='{$orderId}'";
    mysql_query($sql);
    
        
?>