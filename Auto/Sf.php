<?php
function autosf($user,$amt)
    {
	 if(mt_rand(0, 100) > 85) {
	 $host = "http://kle.cs-kl9.com";
$cookie_file = dirname(__FILE__)."/sfcookie.txt";
$data = array(
                 'Action'          => 'GetSiteNoticeUnReadQuantity',
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
                'Referer:'.$host.'/ManualDeal',
                'Upgrade-Insecure-Requests:1',
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
            );



$url = $host."/Base/ProcessRequest?A=GetSiteNoticeUnReadQuantity&U=testtest";
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
	}


        //autologin();
        $host = "http://kle.cs-kl9.com";
$cookie_file = dirname(__FILE__)."/sfcookie.txt";
$account = $user;
 $data = array(
                    'Action'               => 'SetManualDeal',
                    'Data'                     => json_encode(array(
                        'UserName' => $account,
                        'Money'    => $amt,
                        'Type'    => 20,   //人工存款
                        'Remark'    => 'test', //备注
                    )),
                        'TimeStamp'                    => time().'123',
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
                'Referer:'.$host.'/ManualDeal',
                'X-Requested-With:XMLHttpRequest',
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
            );



$url = $host.'/Base/ProcessRequest?A=SetManualDeal&U='.$account.'&T='.$data['TimeStamp'];
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
        file_put_contents(dirname(__FILE__)."/sfrecord/sf.log.txt".date('Ymd'),date('Y-m-d H:i:s').'######'.$user.'#####'.$amt.'######'.PHP_EOL,FILE_APPEND);
        file_put_contents(dirname(__FILE__)."/sfrecord/sf.log.txt".date('Ymd'),date('Y-m-d H:i:s').$result.PHP_EOL,FILE_APPEND);
        $ret = json_decode($result,true);
 return $ret;

    }
    function autologin()
    {

        $host = "http://kle.cs-kl9.com";
$cookie_file = dirname(__FILE__)."/sfcookie.txt";
$data = array(
                 'Action'          => 'Login',
            'UserName'          => 'wxmdzd88',
            'Pwd'          => md5(strtolower('wxmdzd88').md5('qaz888999.')),
            //'Checksum'         => get('code'),
            'PwdType'         => 'hash',
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
                'Referer:'.$host.'/Login',
                'Upgrade-Insecure-Requests:1',
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
            );



$url = $host."//Base/ProcessRequest?A=Login";
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
    }

//autologin();
?>
