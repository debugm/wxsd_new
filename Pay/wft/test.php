<?php
$dbhost = 'localhost';
                $dbuser  = 'root';
                $dbpwd   = 'weiwei9527';
                $dbname  = 'payment1';
                $dbprefix = 'lzh';

        $conn = mysql_connect($dbhost,$dbuser,$dbpwd);
        if (!$conn) {
                die('Could not connect: ' . mysql_error());
        }
mysql_select_db($dbname,$conn);
mysql_query("SET NAMES UTF8");
	$oid = "20171227135053";
        $sql = "select * from pay_usercharge where orderid='{$oid}' and status=1";

        $res = mysql_query($sql);
	$ret =  mysql_fetch_array($res) ;
        if($ret)
        {
                exit('success');
        }

?>
