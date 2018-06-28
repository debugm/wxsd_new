<?php
$url = "http://online.atrustpay.com/payment/PayApply.do";
$key = "zjkEdDkbgRse";
$p = array(
		
		'versionId' => '1.0',
		'orderAmount' => '100',
		'orderDate' => date('YmdHis'),
		'currency' => 'RMB',
		'transType' => '008',
		'accountType' => '0',
		'asynNotifyUrl' => 'http://localhost',
		'synNotifyUrl' => 'http://localhost',
		'signType' => 'MD5',
		'merId' => '100520446',
		'prdOrdNo' => date('YmdHis'),
		'payMode' => '00033',
		'tranChannel' => '103',
		'receivableType' => 'D00',
		'prdName' => 'charge',
		'prdDesc' => 'charge',
		'pnum' => '1',
	);
ksort($p);

$s = "";
foreach($p as $k => $v)
{
	$s .= $k ."=". $v . "&";
}
$s .= "key=".$key;

$p['signData'] = strtoupper(md5($s));

$sHtml = "<form id='mobaopaysubmit' name='mobaopaysubmit' action='".$url."' method='post'>";
			foreach($p as $key => $val) {
	            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
			}
			$sHtml.= "</form>";
			$sHtml.= "<script>document.forms['mobaopaysubmit'].submit();</script>";

echo $sHtml;


?>
