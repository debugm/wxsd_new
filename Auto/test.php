<?php
header('Content-Type:image/png');
 function autoauto()
    {

        $host = "https://s.lakala.com";
$cookie_file = dirname(__FILE__)."/laklacookie.txt";

$header = array(
                'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
		'Accept-Encoding: gzip, deflate, br',
                'Accept-Language:zh-CN,zh;q=0.8',
                'Connection:keep-alive',
		'Cache-Control: max-age=0',
                'Content-Type:application/x-www-form-urlencoded',
                //'Content-Length: ' . strlen($form_data),
                'Host:'.str_replace(array('http://','https://'), '', $host),
		
                //'Origin:'.$host,
                //'Referer:'.$host.'/ManualDeal',
                'Upgrade-Insecure-Requests:1',
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
            );



$url = $host."/logout.action";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10) ;
curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
//curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
echo $result.PHP_EOL;
    }

function getYzm()
{
          $host = "https://s.lakala.com";
$cookie_file = dirname(__FILE__)."/laklacookie.txt";

$header = array(
                'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Encoding: gzip, deflate, br',
                'Accept-Language:zh-CN,zh;q=0.8',
                'Connection:keep-alive',
                'Cache-Control: max-age=0',
                'Content-Type:application/x-www-form-urlencoded',
                //'Content-Length: ' . strlen($form_data),
                'Host:'.str_replace(array('http://','https://'), '', $host),

                //'Origin:'.$host,
                'Referer:'.$host.'/logout.action',
                'Upgrade-Insecure-Requests:1',
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',
            );



$url = $host."/rand.action?tempStr=0.31998256698935057";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10) ;
curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);

$damaUrl = 'http://api.woniudama.com/ApiWeb/Create';
$filename = './a.png';	//img.jpg是测试用的打码图片，4位的字母数字混合码,windows下的PHP环境这里需要填写完整路径
$ch = curl_init();
$postFields = array('UserName' => 'a769087777',
					'PassWord' => 'a3267388', 
					'SoftID' => 818,	//改成你自己的软件id 
					'Image' => '@'.$filename
				   );

curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_URL,$damaUrl);
curl_setopt($ch, CURLOPT_TIMEOUT, 65);	//设置本机的post请求超时时间，如果timeout参数设置60 这里至少设置65
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

$result = curl_exec($ch);

curl_close($ch);

var_dump($result);



//echo $result;
//file_put_contents("./a.png",$result);
}

//autoauto();
getYzm();





?>
