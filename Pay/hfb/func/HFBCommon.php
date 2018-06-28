<?php
header ( 'Content-type:text/html;charset=utf-8' );
include_once 'HFBConfig.php';
include_once 'log.class.php';
// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );

/**
 * 字符串转换为 数组
 *
 * @param unknown_type $str        	
 * @return multitype:unknown
 */
function convertStringToArray($str) {
	$result = array ();
	
	if (! empty ( $str )) {
		$temp = preg_split ( '/&/', $str );
		if (! empty ( $temp )) {
			foreach ( $temp as $key => $val ) {
				$arr = preg_split ( '/=/', $val, 2 );
				if (! empty ( $arr )) {
					$k = $arr ['0'];
					$v = $arr ['1'];
					$result [$k] = $v;
				}
			}
		}
	}
	return $result;
}


/**
 * 构造自动提交表单
 *
 * @param unknown_type $params        	
 * @param unknown_type $action        	
 * @return string
 */
function create_html($params, $action) {
	$encodeType = isset ( $params ['encoding'] ) ? $params ['encoding'] : 'UTF-8';
	$html = <<<eot
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={$encodeType}" />
</head>
<body onload="javascript:document.pay_form.submit();">
    <form id="pay_form" name="pay_form" action="{$action}" method="post">
	
eot;
	foreach ( $params as $key => $value ) {
		$html .= "    <input type=\"hidden\" name=\"{$key}\" id=\"{$key}\" value=\"{$value}\" />\n";
	}
	$html .= <<<eot
   <!-- <input type="submit" type="hidden">-->
    </form>
</body>
</html>
eot;
	return $html;
}


/**
 * 讲数组转换为string
 *
 * @param $para 数组        	
 * @param $encode 是否需要URL编码        	
 * @return string
 */
function createLinkString($para, $encode) {
	ksort($para);   //排序
	$linkString = "";
	while ( list ( $key, $value ) = each ( $para ) ) {
		if ($encode) {
			$value = urlencode ( $value );
		}
		$linkString .= $key . "=" . $value . "&";
	}
	// 去掉最后一个&字符
	$linkString = substr ( $linkString, 0, count ( $linkString ) - 2 );
	
	return $linkString;
}


/**
 * 后台交易 HttpClient通信
 *
 * @param unknown_type $params        	
 * @param unknown_type $url        	
 * @return mixed
 */
function post($params, $url, &$errmsg) {
	$opts = createLinkString ( $params, false, true );
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // 不验证证书
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false ); // 不验证HOST
	curl_setopt ( $ch, CURLOPT_SSLVERSION, 3 );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
			'Content-type:application/x-www-form-urlencoded;charset=UTF-8' 
	) );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $opts );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	$html = curl_exec ( $ch );
	if(curl_errno($ch)){
		$errmsg = curl_error($ch);
		curl_close ( $ch );
		return false;
	}
    if( curl_getinfo($ch, CURLINFO_HTTP_CODE) != "200"){
		$errmsg = "http状态=" . curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close ( $ch );
		return false;
    }
	curl_close ( $ch );
	return $html;
}

/**
 * 打印请求应答
 *
 * @param
 *        	$url
 * @param
 *        	$req
 * @param
 *        	$resp
 */
function printResult($url, $req, $resp) {
	echo "=============<br>\n";
	echo "地址：" . $url . "<br>\n";
	echo "请求：" . str_replace ( "\n", "\n<br>", htmlentities ( createLinkString ( $req, false, true ) ) ) . "<br>\n";
	echo "应答：" . str_replace ( "\n", "\n<br>", htmlentities ( $resp ) ) . "<br>\n";
	echo "=============<br>\n";
}
?>