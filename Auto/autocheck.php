<?php
function autosf($user,$amt)
{
$host = "http://csw55.weicai00.com";
$cookie_file = "sfcookie.txt";

$data = array(
                    'amount'               => $amt,
                    'remark'       => 'autosftest',   //存款备注
                    'user'               => json_encode(array('username'=>$user)),
                    'info'    => '129',
                    'type'       => '0',
                    'uniqueId'       => time().(mt_rand(100, 999)),
                );

$form_data = http_build_query($data);

$header = array(
                'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Language:zh-CN,zh;q=0.8',
                'Connection:keep-alive',
                'Content-Type:application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($form_data),
                'Host:'.str_replace(array('http://','https://'), '', $host),
                'Origin:'.$host,
                'Referer:'.$host.'/agent/user/list?type=1&flag=1',
                'X-Requested-With:XMLHttpRequest',
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
            );



$url = "http://csw55.weicai00.com/agent/user/updateBalance";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10) ;
curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$retcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
file_put_contents('./sf.txt',date('Y-m-d H:i:s').'--username---:'.$user.PHP_EOL,FILE_APPEND);
file_put_contents('./sf.txt',date('Y-m-d H:i:s').$result.PHP_EOL,FILE_APPEND);
file_put_contents('./sf.txt',date('Y-m-d H:i:s').'--retcode--:'.$retcode.PHP_EOL,FILE_APPEND);
$res = json_decode($result,true);
return $res;

}

function autologin()
{
	$host = "http://csw55.weicai00.com";
$cookie_file = "sfcookie.txt";
$data = array(
            'type'          => '2',
            'safepassword'         => md5(md5('qaz888999')),
            'account'         => "wxzdrk",
            'password'            => '',
            'code'            => '',
        );
$form_data = http_build_query($data);

$header = array(
                'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Language:zh-CN,zh;q=0.8',
                'Connection:keep-alive',
                'Content-Type:application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($form_data),
                'Host:'.str_replace(array('http://','https://'), '', $host),
                'Origin:'.$host,
                'Referer:'.$host.'/',
                'Upgrade-Insecure-Requests:1',
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
            );



$url = "http://csw55.weicai00.com/login";
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
        file_put_contents(dirname(__FILE__)."/autocheck/check.log.txt".date('Ymd'),date('Y-m-d H:i:s').'######LOGIN CHECK######'.PHP_EOL,FILE_APPEND);
        file_put_contents(dirname(__FILE__)."/autocheck/check.log.txt".date('Ymd'),date('Y-m-d H:i:s').$result.PHP_EOL,FILE_APPEND);
        file_put_contents(dirname(__FILE__)."/autocheck/check.log.txt".date('Ymd'),date('Y-m-d H:i:s').'######END LOGIN CHECK######'.PHP_EOL,FILE_APPEND);
}

$ret = autosf('zdrkcs',0.01);
if(!$ret)
{
    autologin();
}

?>
