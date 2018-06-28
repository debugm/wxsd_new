<?php
include_once(dirname(__FILE__)."/getla.php");
include_once(dirname(__FILE__)."/login.php");
include_once(dirname(__FILE__)."/Sf.php");

function handle()
{
    $dbhost = 'localhost';
    $dbuser  = 'root';
    $dbpwd   = 'weiwei9527';
    $dbname  = 'payment2';

    $conn = mysql_connect($dbhost,$dbuser,$dbpwd);
    if (!$conn) {
            die('Could not connect: ' . mysql_error());
    }
    mysql_select_db($dbname,$conn);
    mysql_query("SET NAMES UTF8");




    $sql = "select * from pay_userbankaccount where enable=1 and bankcode='lakala'";
    $acclist = mysql_query($sql);
    while($acc = mysql_fetch_assoc($acclist))
    {
        $account = $acc['accountid'];
        $pwd = $acc['skid'];

        $result = getLaOrders();
	$ret = json_decode($result,true);
        //cookie过期,重新登录
        if(json_last_error() != JSON_ERROR_NONE)
        {
            file_put_contents(dirname(__FILE__)."/lakalarec/login.log.txt".date('Ymd'),date('Y-m-d H:i:s')."-----------掉线------------".PHP_EOL,FILE_APPEND);
            file_put_contents(dirname(__FILE__)."/lakalarec/login.log.txt".date('Ymd'),date('Y-m-d H:i:s').$result.PHP_EOL,FILE_APPEND);
            //$res = login($account,$pwd);
            //$result = getLaOrders();
	    continue;
        }
            $ret = json_decode($result,true);
            file_put_contents(dirname(__FILE__)."/lakalarec/order.log.txt".date('Ymd'),date('Y-m-d H:i:s')."-----------getlaorders------------count:".count($ret['rows']).PHP_EOL,FILE_APPEND);
            //对获取的结果进行处理
	    $data = $ret['rows'];
	    sort($data);
	    //var_dump($data);exit();
            if(count($data) != 0)
            {
		$now = time(); //  只保留最近三分钟内的订单
                foreach($data as $ord)
                {

                    $payid = $ord['orderID'];
                    $remark = $ord['remark'];
                    $mendian = $ord['posId'];
	            $amt = str_replace(',', '', $ord['txnAmt']);
                    $amt = floatval($amt);

                    $paytime = strtotime($ord['txnTime']);
		    
		    if($now - $paytime > 600)
		    {
   			continue;
		    }

		
     		    $msgid = $ord['logNo'];
                    $sql = "select * from pay_wxa where wxmsgid='{$msgid}'";
                    $db_res = mysql_query($sql);

                    $num_rows = mysql_num_rows($db_res);
                    if(!$num_rows)
                    {
                            //执行插入操作，并执行上分，检查remark是否存在

                            $sql = "insert into pay_wxa(amt,wxname,paytime,wxmsgid,remark,payid,mendian) values({$amt},'lakala',{$paytime},'{$msgid}','{$remark}','{$payid}','{$mendian}')";
			
                            mysql_query($sql);
			    $result = mysql_affected_rows(); 
			    if($result == -1)
				continue;
			    
			    /*
				判断是否限额
			    */			    
			    $sql = "select * from pay_userbankaccount where shname='{$mendian}'";
			    $acc = mysql_fetch_assoc(mysql_query($sql));
			    if($acc['maxmoney'] <= 0)
			    {	
				mysql_query("update pay_userbankaccount set enable=0 where shname='{$mendian}'");
			    }
			    else
			    {
				$newm = $acc['maxmoney'] - $amt;
				mysql_query("update pay_userbankaccount set maxmoney={$newm} where shname='{$mendian}'");
			    }
			    $skm = $acc['skamount'] + $amt;
                            mysql_query("update pay_userbankaccount set skamount={$skm} where shname='{$mendian}'");
		    
			    

                            //判断remark,如果不空则执行上分操作
                            if($remark)
                            {
                                    $ret = autosf($remark,$amt);
                                    if($ret['StrCode'] == '处于未登录状态')
                                    {
                                            autologin();
                                    }

                                    if($ret['Code'] == 1)
                                    {
                                            $push = 1;
                                            $msg = "上分成功";
                                    }
                                    else
                                    {
                                            $push = 2;
                                            $msg = $ret['StrCode'];
                                    }

                                    $sql = "update pay_wxa set push={$push},errmsg='{$msg}' where wxmsgid='{$msgid}'";
                                    mysql_query($sql);
                            }
                    }

                }
            }
        }
}

handle();
?>
