<?php

// 请注意服务器是否开通fopen配置
function log_result($word) {
	$fp = fopen ( "d:/log.txt", "a" );
	if (flock ( $fp, LOCK_EX )) {
		fwrite ( $fp, "执行日期：" . strftime ( "%Y%m%d%H%M%S", time () ) . "\n" . $word . "\n\n" );
		// release lock
		flock ( $fp, LOCK_UN );
	} else {
		echo "Error locking file!";
	}
	fclose ( $fp );
}
function parseXml($xml) {
	// 解析结果
	$xmlResult = simplexml_load_string ( $xml );
	
	// foreach循环遍历
	foreach ( $xmlResult->children () as $childItem ) {
		if ($childItem->getName () == "retcode") {
			$retcode = $childItem;
		}
		if ($childItem->getName () == "retmsg") {
			$childItem = iconv ( "utf-8", "gbk", $childItem );
			$retmsg = $childItem;
			setcookie ( 'mycookie', $retmsg );
		}
	}
	return $retcode;
}
function getXmlInfo($xml, $str) {
	// 解析结果
	$xmlResult = simplexml_load_string ( $xml );
	
	// foreach循环遍历
	foreach ( $xmlResult->children () as $childItem ) {
		if ($childItem->getName () == $str) {
			$childItem = iconv ( "utf-8", "gbk", $childItem );
			return $childItem;
			setcookie ( 'mycookie', $childItem );
		}
	}
}
?>