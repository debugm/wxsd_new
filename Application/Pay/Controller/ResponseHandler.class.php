<?php
namespace Pay\Controller;
class ResponseHandler {
	
	/**
	 * 密钥
	 */
	var $key;
	
	/**
	 * 应答的参数
	 */
	var $parameters;
	
	/**
	 * debug信息
	 */
	var $debugInfo;
	function __construct() {
		$this->ResponseHandler ();
	}
	function ResponseHandler() {
		$this->key = "";
		$this->parameters = array ();
		$this->debugInfo = "";
		
		/* GET */
		foreach ( $_GET as $k => $v ) {
			// $v = iconv ( "utf-8", "gbk", $v );
			log_result($v);
			$this->setParameter ( $v );
		}
		/* POST */
		foreach ( $_POST as $k => $v ) {
			$v = iconv ( "utf-8", "gb2312", $v );
			$this->setParameter ( $v );
		}
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
	function setParameter($parameterValue) {
		// echo "<br/>parameterValue:" . $parameterValue . "<br/>";
		$rsa = new RSA ();
		$cipherData = $rsa->decrypt ( $parameterValue );
		log_result($cipherData);
		$tmp_arr = explode ( '&', $cipherData );
		ksort ( $tmp_arr );
		foreach ( $tmp_arr as $pa ) {
			$tmp_arr2 = explode ( "=", $pa );
			log_result($tmp_arr2 [1]);
			$this->parameters [$tmp_arr2 [0]] = $tmp_arr2 [1];
		}
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
	 * 是否国采付签名,规则是:按参数名称a-z排序,遇到空值的参数不参加签名。
	 * true:是
	 * false:否
	 */
	function isGCSign() {
		$signPars = "";
		ksort ( $this->parameters );
		foreach ( $this->parameters as $k => $v ) {
			if ("sign" != $k && "" != $v) {
				$signPars .= $k . "=" . $v . "&";
			}
		}
		
		if ($this->getParameter ( "encode_type" ) == "MD5") {
			$sign = strtolower ( md5 ( $signPars ) );
			$GCSign = strtolower ( $this->getParameter ( "sign" ) );
			// debug信息
			$this->_setDebugInfo ( $signPars . " => sign:" . $sign . " gcSign:" . $this->getParameter ( "sign" ) );
			return $sign == $GCSign;
		} else {
			$sign = $this->getParameter ( "sign" );
			$rsa = new RSA ();
			$signPars = substr ( $signPars, 0, strlen ( $signPars ) - 1 );
			$this->_setDebugInfo ( $signPars . " => sign:" . $sign . " gcSign:" . $this->getParameter ( "sign" ) );
			return $rsa->verify ( $signPars, $sign );
		}
	}
	
	/**
	 * 获取debug信息
	 */
	function getDebugInfo() {
		return $this->debugInfo;
	}
	
	/**
	 * 是否国采付签名
	 *
	 * @param
	 *        	signParameterArray 签名的参数数组
	 * @return boolean
	 */
	function _isGCSign($signParameterArray) {
		$signPars = "";
		foreach ( $signParameterArray as $k ) {
			$v = $this->getParameter ( $k );
			if ("sign" != $k && "" != $v) {
				$signPars .= $k . "=" . $v . "&";
			}
		}
		$signPars .= "key=" . $this->getKey ();
		
		$sign = strtolower ( md5 ( $signPars ) );
		
		$GCSign = strtolower ( $this->getParameter ( "sign" ) );
		
		// debug信息
		$this->_setDebugInfo ( $signPars . " => sign:" . $sign . " gcSign:" . $this->getParameter ( "sign" ) );
		
		return $sign == $GCSign;
	}
	
	/**
	 * 设置debug信息
	 */
	function _setDebugInfo($debugInfo) {
		$this->debugInfo = $debugInfo;
	}
}

?>