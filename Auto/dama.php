<?php


$damaUrl = 'http://api.woniudama.com/ApiWeb/Create';
$filename = 'a.jpg';  //img.jpg是测试用的打码图片，4位的字母数字混合码,windows下的PHP环境这里需要填写完整路径
$ch = curl_init();
$postFields = array('UserName' => 'a769087777',
                                        'PassWord' => 'a3267388',
                                        'SoftID' => 818,        //改成你自己的软件id
                                        'Image' => '@'.$filename
                                   );
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_URL,$damaUrl);
curl_setopt($ch, CURLOPT_TIMEOUT, 65);  //设置本机的post请求超时时间，如果timeout参数设置60 这里至少设置65
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

$result = curl_exec($ch);

curl_close($ch);

var_dump($result);
?>
