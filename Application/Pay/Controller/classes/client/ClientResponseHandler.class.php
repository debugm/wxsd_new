<?php
/**
 * 后台应答类
 * ============================================================================
 * api说明：
 * getKey()/setKey(),获取/设置密钥
 * getContent() / setContent(), 获取/设置原始内容
 * getParameter()/setParameter(),获取/设置参数值
 * getAllParameters(),获取所有参数
 * isGCSign(),是否国采付签名,true:是 false:否
 * getDebugInfo(),获取debug信息
 * 
 * ============================================================================
 *
 */
class ClientResponseHandler {
	
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
	
	/**
	 * 原始内容
	 */
	var $content;
	
	/**
	 * 加密后的数据
	 */
	var $cipherData;
	
	/**
	 * 加密原串
	 */
	var $signPars;
	function getSignPars() {
		return $this->signPars;
	}
	function setSignPars($signPars) {
		$this->signPars = $signPars;
	}
	function __construct() {
		$this->ClientResponseHandler ();
	}
	function ClientResponseHandler() {
		$this->key = "";
		$this->signPars = "";
		$this->parameters = array ();
		$this->debugInfo = "";
		$this->content = "";
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
	
	// 设置原始内容，确保PHP环境支持simplexml_load_string以及iconv这两个函数才可以
	// 一般PHP5环境下没问题，PHP4需要检测一下环境是否安装了iconv以及simplexml模块
	function setContent($content) {
		$signPars = "";
		$this->content = $content;
		$xml = simplexml_load_string ( $this->content );
		$encode = $this->getXmlEncode ( $this->content );
		
		if ($xml && $xml->children ()) {
			foreach ( $xml->children () as $node ) {
				// 有子节点
				if ($node->children ()) {
					$k = $node->getName ();
					$nodeXml = $node->asXML ();
					$v = substr ( $nodeXml, strlen ( $k ) + 2, strlen ( $nodeXml ) - 2 * strlen ( $k ) - 5 );
				} else {
					$k = $node->getName ();
					$v = ( string ) $node;
				}
				
				if ($encode != "" && $encode != "UTF-8") {
					$k = iconv ( "UTF-8", $encode, $k );
					$v = iconv ( "UTF-8", $encode, $v );
				}
				
				if ($k == "cipher_data") {
					$rsa = new RSA ();
					$cipherData = $rsa->decrypt ( $v );
					echo "<br/>" . "解密结果：" . iconv ( "GBK", "UTF-8", $cipherData ) . "<br/>";
					$tmp_arr = explode ( '&', $cipherData );
					ksort ( $tmp_arr );
					foreach ( $tmp_arr as $pa ) {
						$tmp_arr2 = explode ( "=", $pa, 2 );
						if ("sign" != $tmp_arr2 [0] && "" != $tmp_arr2 [1]) {
							$signPars .= $tmp_arr2 [0] . "=" . $tmp_arr2 [1] . "&";
						}
						$this->setParameter ( $tmp_arr2 [0], $tmp_arr2 [1] );
					}
					$this->setSignPars ( substr ( $signPars, 0, strlen ( $signPars ) - 1 ) );
				}
				
				$this->setParameter ( $k, $v );
			}
		}
	}
	
	// 设置原始内容
	// 解决PHP4老环境下不支持simplexml以及iconv功能的函数
	function setContent_backup($content) {
		$this->content = $content;
		$encode = $this->getXmlEncode ( $this->content );
		$xml = new SofeeXmlParser ();
		$xml->parseFile ( $this->content );
		$tree = $xml->getTree ();
		unset ( $xml );
		foreach ( $tree ['root'] as $key => $value ) {
			if ($encode != "" && $encode != "UTF-8") {
				$k = mb_convert_encoding ( $key, $encode, "UTF-8" );
				$v = mb_convert_encoding ( $value [value], $encode, "UTF-8" );
			} else {
				$k = $key;
				$v = $value [value];
			}
			$this->setParameter ( $k, $v );
		}
	}
	
	// 获取原始内容
	function getContent() {
		return $this->content;
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
	 * 是否国采付签名,规则是:按参数名称a-z排序,遇到空值的参数不参加签名。
	 * true:是
	 * false:否
	 */
	function isGCSign() {
		$signPars = $this->getSignPars ();
		if ($this->getParameter ( "encode_type" ) == "MD5") {
			$signPars .= "key=" . $this->getKey ();
			$sign = strtolower ( md5 ( $signPars ) );
			$GCSign = strtolower ( $this->getParameter ( "sign" ) );
			// debug信息
			$this->_setDebugInfo ( $signPars . " => sign:" . $sign . " gcSign:" . $this->getParameter ( "sign" ) );
			echo "<br/>自签：" . $signPars . " => sign:" . $sign . " <br/><br/>" . "服务端签名:" . $this->getParameter ( "sign" ) . "<br/>";
			return $sign == $GCSign;
		} else {
			$sign = $this->getParameter ( "sign" );
			$rsa = new RSA ();
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
	 * 获取xml编码
	 */
	function getXmlEncode($xml) {
		$ret = preg_match ( "/<?xml[^>]* encoding=\"(.*)\"[^>]* ?>/i", $xml, $arr );
		if ($ret) {
			return strtoupper ( $arr [1] );
		} else {
			return "";
		}
	}
	
	/**
	 * 设置debug信息
	 */
	function _setDebugInfo($debugInfo) {
		$this->debugInfo = $debugInfo;
	}
}
?>