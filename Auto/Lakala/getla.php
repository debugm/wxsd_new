<?php
function getLaOrders()
{
$start = date('Y-m-d',time());
$data = "cond.beginDate={$start}&cond.endDate={$start}&cond.merId=&cond.posId=&cond.refNo=&cond.respCode=S&cond.userTypeId=20180606234249587-000220ZzkEBCba&cond.orderID=&cond.txnCode=&page=1";
//echo $data;
$host = "https://s.lakala.com";
$cookie_file = dirname(__FILE__)."/laklacookie.txt";

$header = array(
                'Accept:application/json, text/javascript, */*; q=0.01',
                'Accept-Encoding: gzip, deflate, br',
                'Accept-Language:zh-CN,zh;q=0.8',
                'Connection:keep-alive',
                //'Cache-Control: max-age=0',
                'Content-Type:application/x-www-form-urlencoded; charset=UTF-8',
                'Content-Length: ' . strlen($data),
                'Host:'.str_replace(array('http://','https://'), '', $host),
                'Origin:'.$host,
                'Referer:'.$host.'/goPospTxnJnlAction.action;jsessionid=15nyped2yvyhi',
                //'Upgrade-Insecure-Requests:1',
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
		'X-Requested-With: XMLHttpRequest'
            );



$url = $host."/queryPosptxnjnlDetail.action";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10) ;
curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
//curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
return $result;

}
//$res = getLaOrders();
//echo $res;
//file_put_contents(dirname(__FILE__)."/lakalarec/order.log.txt".date('Ymd'),date('Y-m-d H:i:s').$res.PHP_EOL,FILE_APPEND);
?>
