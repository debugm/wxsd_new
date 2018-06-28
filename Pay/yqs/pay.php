<?php
function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
                $xml.="<".$key.">".$val."</".$key.">";
        }
        $xml.="</xml>";
        return $xml;
    }
$key = "0045704bgbf031f63ga71e71b8db3d2c";
$p = array('service' => 'ten.activescan.pay',
	   'mch_id' => '10000074',
	   'goods' => 'charge',
	   'order_no' => date('YmdHis'),
	   'amount' => '10.00',
	   'notify_url' => 'http://localhost',
);
ksort($p);
$str = "";
foreach($p as $k => $v)
{
    $str .= $k ."=". $v ."&"; 
}
$str .= "key=".$key;
echo $str;
$p['sign'] = md5($str);

$xml = arrayToXml($p);
echo $xml;
$url = "https://opay.arsomon.com:28443/vipay/reqctl.do";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
echo $result;

?>
