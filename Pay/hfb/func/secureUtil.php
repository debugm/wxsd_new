<?php
include_once 'HFBConfig.php';
include_once 'HFBCommon.php';
include_once 'log.class.php';

// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
/**
 * 签名
 *
 * @param String $params_str
 */
function sign(&$params) {
	global $log;
	$log->LogInfo ( '=====签名报文开始======' );
	if(isset($params['sign'])){
		unset($params['sign']);
	}
	// 转换成key=val&串
	$params_str = createLinkString ( $params, false );
	$log->LogInfo ( "签名key=val&...串 >" . $params_str );
	
	// 签名证书路径
	$cert_path = HFB_PRIVATE_CERT_PATH;
		
	$private_key = getPrivateKey ( $cert_path );
	// 签名
	$sign_falg = openssl_sign ( $params_str, $sign, $private_key, OPENSSL_ALGO_SHA1 );
	if ($sign_falg) {
		$sign_base64 = base64_encode ( $sign );
		$log->LogInfo ( "签名串为 >" . $sign_base64 );
		$params ['sign'] = $sign_base64;
	} else {
		$log->LogInfo ( ">>>>>签名失败<<<<<<<" );
	}
	$log->LogInfo ( '=====签名报文结束======' );
}

/**
 * 验签
 *
 * @param String $params_str        	
 * @param String $sign_str        	
 */
function verify($params) {
	global $log;
	// 公钥
	$public_key = getPublicKey ( HFB_PUBLIC_CERT_PATH );	
	// 签名串
	$sign_str = $params ['sign'];
	$sign_str = str_replace(" ","+","$sign_str");
	// 转码
	
	unset ( $params ['sign'] );
	$params_str = createLinkString ( $params, false );
	$log->LogInfo ( '报文去[sign] key=val&串>' . $params_str );
	$sign = base64_decode ( $sign_str );
	$isSuccess = openssl_verify ( $params_str, $sign, $public_key);
	$log->LogInfo ( $isSuccess ? '验签成功' : '验签失败' );
	return $isSuccess;
}


/**
 * 取证书公钥 -验签
 *
 * @return string
 */
function getPublicKey($cert_path) {
	return file_get_contents ( $cert_path );
}
/**
 * 返回(签名)证书私钥 -
 *
 * @return unknown
 */
function getPrivateKey($cert_path) {
	$pkcs12 = file_get_contents ( $cert_path );
	openssl_pkcs12_read ( $pkcs12, $certs, HFB_PRIVATE_CERT_PWD );
	return $certs ['pkey'];
}

/**
 * 加密数据
 * @param string $data数据
 * @param string $cert_path 证书配置路径
 * @return unknown
 */
function encryptData($data, $cert_path = HFB_PUBLIC_CERT_PATH) {
	$public_key = getPublicKey ( $cert_path );
	openssl_public_encrypt ( $data, $crypted, $public_key);
	return base64_encode ( $crypted );
}


/**
 * 解密数据
 * @param string $data数据
 * @param string $cert_path 证书配置路径
 * @return unknown
 */
function decryptData($data, $cert_path=HFB_PRIVATE_CERT_PATH) {
	$data = base64_decode ( $data );
	$private_key = getPrivateKey ( $cert_path );
	openssl_private_decrypt ( $data, $crypted, $private_key );
	return $crypted;
}


