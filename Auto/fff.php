<?php

include_once(dirname(__FILE__)."/Sf.php");

function Login($account ,$pwd)
{
	$host = "https://e.51fubei.com";
        $cookie_file = dirname(__FILE__)."/cookie/fbcookie.txt.".$account;
$data = array(
                //'username' => '18754133731',
                //'password' => md5('wc123123'),
		'username' => $account,
		'password' => md5($pwd),
                'is_remember' => 1
        );
$form_data = http_build_query($data);

$header = array(
                'Accept:application/json, text/javascript, */*; q=0.01',
                'Accept-Language:zh-CN,zh;q=0.8',
                'Connection:keep-alive',
                'Content-Type:application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($form_data),
                'Host:'.str_replace(array('http://','https://'), '', $host),
                'Origin:'.$host,
                'Referer:'.$host.'/Index/Login/index',

                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
                'X-Requested-With:XMLHttpRequest',
            );


$url = $host."/Login/handle";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10) ;
curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
var_dump($result).PHP_EOL;

    return json_decode($result,true);
}




// 获取现存所有子商户id


function getFborders($starttime,$endtime,$account)
{
$host = "https://e.51fubei.com";
$cookie_file = dirname(__FILE__)."/cookie/fbcookie.txt.".$account;


$form_data = "draw=3&columns[0][data]=0&columns[0][name]=create_time&columns[0][searchable]=false&columns[0][orderable]=false&columns[0][search][value]=&columns[0][search][regex]=false&columns[1][data]=1&columns[1][name]=trade_no&columns[1][searchable]=false&columns[1][orderable]=false&columns[1][search][value]=&columns[1][search][regex]=false&columns[2][data]=2&columns[2][name]=store_name&columns[2][searchable]=false&columns[2][orderable]=false&columns[2][search][value]=&columns[2][search][regex]=false&columns[3][data]=3&columns[3][name]=pay_type&columns[3][searchable]=false&columns[3][orderable]=false&columns[3][search][value]=&columns[3][search][regex]=false&columns[4][data]=4&columns[4][name]=shishou&columns[4][searchable]=false&columns[4][orderable]=false&columns[4][search][value]=&columns[4][search][regex]=false&columns[5][data]=5&columns[5][name]=pay_status&columns[5][searchable]=false&columns[5][orderable]=false&columns[5][search][value]=&columns[5][search][regex]=false&columns[6][data]=6&columns[6][name]=pay_status&columns[6][searchable]=false&columns[6][orderable]=false&columns[6][search][value]=&columns[6][search][regex]=false&columns[7][data]=7&columns[7][name]=pay_status&columns[7][searchable]=false&columns[7][orderable]=false&columns[7][search][value]=&columns[7][search][regex]=false&order[0][column]=6&order[0][dir]=desc&start=0&length=10&search[value]=&search[regex]=false&storeId[]=&switchOff=1&start_time={$starttime}&end_time={$endtime}&pay_status[]=2&refund_type=&store_id=&pay_type=&searchcashier=&type=&searchkey=&index=0";



$header = array(
                'Accept:application/json, text/javascript, */*; q=0.01',
                'Accept-Language:zh-CN,zh;q=0.8',
                'Connection:keep-alive',
                'Content-Type:application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($form_data),
                'Host:'.str_replace(array('http://','https://'), '', $host),
                'Origin:'.$host,
                'Referer:'.$host.'/User/NewFundManagement/tradestats',
		
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
		'X-Requested-With:XMLHttpRequest',
            );


$url = $host."/User/NewFundManagement/tradestats";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10) ;
curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
//curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
return $result;
}

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



$now = time();
//获取5s前订单
$start = $now - 100;
$starttime = date('Y-m-d H:i:s',$start);
$endtime = date('Y-m-d H:i:s',$now);
    //获取订单

//$sql = "select * from pay_userbankaccount where enable=1 and bankcode='fb'";
//$acclist = mysql_query($sql);
//while($acc = mysql_fetch_assoc($acclist))
{
    //$account = $acc['accountid'];
    //$pwd = $acc['skid'];
    $account = "18476703851";
    $pwd = "qaz888999";
    $result = getFborders($starttime,$endtime,$account);
    echo $result.$account.PHP_EOL;
    //cookie过期,重新登录
    if(!$result)
    {
	echo "relogin".PHP_EOL;
 	$res = Login($account,$pwd);       
        //$result = getFborders($starttime,$endtime,$account);
    }
	//$ret = json_decode($result,true);
    }
}

handle();

?>
