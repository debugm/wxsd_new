<?php
/**
 * 请求类
 * ============================================================================
 * api说明：
 * init(),初始化函数，默认给一些参数赋值，如cmdno,date等。
 * getGateURL()/setGateURL(),获取/设置入口地址,不包含参数值
 * getKey()/setKey(),获取/设置密钥
 * getParameter()/setParameter(),获取/设置参数值
 * getAllParameters(),获取所有参数
 * getRequestURL(),获取带参数的请求URL
 * doSend(),重定向到国采付支付
 * getDebugInfo(),获取debug信息
 * 
 * ============================================================================
 *
 */
class RequestHandler {
	
	/**
	 * 网关url地址
	 */
	var $gateUrl;
	
	/**
	 * 密钥
	 */
	var $key;
	
	/**
	 * 请求的参数
	 */
	var $parameters;
	
	/**
	 * debug信息
	 */
	var $debugInfo;
	function __construct() {
		$this->RequestHandler ();
	}
	function RequestHandler() {
		$this->gateUrl = "";
		$this->key = "";
		$this->parameters = array ();
		$this->debugInfo = "";
	}
	
	/**
	 * 初始化函数。
	 */
	function init() {
		// nothing to do
	}
	
	/**
	 * 获取入口地址,不包含参数值
	 */
	function getGateURL() {
		return $this->gateUrl;
	}
	
	/**
	 * 设置入口地址,不包含参数值
	 */
	function setGateURL($gateUrl) {
		$this->gateUrl = $gateUrl;
	}
	
	/**
	 * 获取密钥
	 */
	function getKey() {
		return $this->key;
	}
	
	/**
	 * 设置密钥
	 */
	function setKey($key) {
		$this->key = $key;
	}
	
	/**
	 * 获取参数值
	 */
	function getParameter($parameter) {
		return $this->parameters [$parameter];
	}
	
	/**
	 * 设置参数值
	 */
	function setParameter($parameter, $parameterValue) {
		$this->parameters [$parameter] = $parameterValue;
	}
	
	/**
	 * 获取所有请求的参数
	 *
	 * @return array
	 */
	function getAllParameters() {
		return $this->parameters;
	}
	
	/**
	 * 获取带参数的请求URL
	 */
	function getRequestURL() {
		$this->createSign ();
		
		$reqPar = "";
		ksort ( $this->parameters );
		foreach ( $this->parameters as $k => $v ) {
			if ("" != $v) {
				$reqPar .= $k . "=" . mb_convert_encoding ( $v, 'GBK', 'UTF-8' ) . "&";
			}
		}
		
		// 去掉最后一个&
		$reqPar = substr ( $reqPar, 0, strlen ( $reqPar ) - 1 );
		$m = new RSA ();
		$reqPar = $m->encrypt ( $reqPar );
		$reqPar = urlencode ( mb_convert_encoding ( $reqPar, 'GBK', 'UTF-8' ) );
		$requestURL = $this->getGateURL () . "?" . "cipher_data=" . $reqPar;
		return $requestURL;
	}
	
	/**
	 * 获取debug信息
	 */
	function getDebugInfo() {
		return $this->debugInfo;
	}
	
	/**
	 * 重定向到国采付支付
	 */
	function doSend() {
		header ( "Location:" . $this->getRequestURL () );
		exit ();
	}
	
	/**
	 * 规则是:按参数名称a-z排序,遇到空值的参数不参加签名。
	 */
	function createSign() {
		// 参数原串
		$signPars = "";
		// 按照键名排序
		ksort ( $this->parameters );
		// 生成原串
		foreach ( $this->parameters as $k => $v ) {
			// 值不为空或键不是sign
			if ("" != $v && "sign" != $k) {
				$signPars .= $k . "=" . mb_convert_encoding ( $v, 'GBK', 'UTF-8' ) . "&";
			}
		}
		
		// md5签名
		// 再拼接key字段
		$signPars .= "key=" . $this->getKey ();
		$sign = md5 ( $signPars );
		$this->setParameter ( "sign", $sign );
		
		// debug信息
		$this->_setDebugInfo ( $signPars . " => sign:" . $sign );
	}
	
	/**
	 * 设置debug信息
	 */
	function _setDebugInfo($debugInfo) {
		$this->debugInfo = $debugInfo;
	}
}

?>