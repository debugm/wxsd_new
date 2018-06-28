<?php
	/*demo 只提供加密以及算法验签流程逻辑参考*/
    /*
     * 平安银行原生支付-微信
     * 刘玉尧
     * 2017年12月22日20:15:06
     */
class PinganPay
{
    public function actionIndex(){
       
        //$openid     = 'b5eb055cd1f7d303da6164eccd36b629';//PID
        $user_seller= '';//商户号
        $url		 = 'https://api.orangebank.com.cn/mct1/payorder';//支付提交地址
        //$openkey     = '890fbfb22d571dc62b83ef5c2f37124a';//KEY
	$openid = $_POST['mid'];
	$openkey = $_POST['key'];
	$amt = $_POST['amt'];
	$oid = $_POST['oid'];
      	$nurl = $_POST['url'];
        $resultData = $this->actionAetPrePayOrder("Weixin","会员账户充值",$oid,$amt,$url,$openkey,$openid,$nurl);
	echo $resultData;	
    }

	/*
	 * 订单核心方法
	 * 如果您是使用微信或者支付宝H5支付请严格按照此方法进行计算	
	 */
    private function   actionAetPrePayOrder($service, $body, $outTradeNo, $totalFee,$url,$openkey,$openid,$nurl){

        $postdata['out_no'] 		 = $outTradeNo;//订单号？
        $postdata['pmt_tag']		 = $service;//估计是充值类型
        $postdata['original_amount'] = $totalFee * 100;//金额估计是以分计算没看手册文档
        $postdata['trade_amount']    = $totalFee * 100;//金额估计是以分计算没看手册文档
        $postdata['ord_name']        = "会员充值";
        $postdata['pmt_name']        = "test";
        $postdata['discount_amount'] = "0";//打折金额
        $postdata['ignore_amount']   = "0";//忽略金额
        $postdata['trade_account']   = "1";//顾客账号
        $postdata['trade_no']        = "123123";//这个也是订单号？
        $postdata['trade_result']    = "test";
        $postdata['remark']          = "test";
        $postdata['tag'] 			 = "123";
        $postdata['auth_code'] 	     = "";//权限代码？
        $postdata['jump_url'] = "http://".$_SERVER['HTTP_HOST']."/pingan/callback";  //页面跳转返回地址
        $postdata['notify_url'] = $nurl;//服务端验签返回地址

        $parameters = [
            'open_id'=>$openid,
            'timestamp'=>time(),
        ];

        $parameters['data'] = $postdata;

        $parameters['data'] = $this->actionPayencrypt(json_encode($postdata), $openkey);

        $parameters['sign'] = $this->actionSigns($parameters, $openkey);

        $result = $this->actionCurl($url, $parameters);

        if(isset($result['data'])){
            // if(self::DEBUG){$this->debug('解密前字符串',$result['data']);}
            $result['data']=$this->actionDecrypt($result['data'], $openkey);
            // if(self::DEBUG){$this->debug('解密后字符串',$result['data']);}
            $result['data']=json_decode($result['data'], true);
            // if(self::DEBUG){if(is_array($result['data'])){$this->debug('JSON转数组成功','成功');}else{$this->debug('JSON转数组成功','失败');}}
        }else{
            return $result;
        }
        unset($result['sign']);

        // var_dump($postdata);
        // var_dump($result);

        // exit();
	$ret = array();
	$ret['code_url'] = $result['data']['jsapi_pay_url'];
	$ret['status'] = 'success';
	
	return json_encode($ret);
    }
    #@todo AES加解密
    #加密
    public function actionPayencrypt($input, $key){
        // dump($input);
        // exit();
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $input = $this->actionPkcs5_pad($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = strtoupper(bin2hex($data));
        return $data;
    }

    public function actionPkcs5_pad ($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    #签名
    public function actionSigns($array, $openkey){
        $signature = array();
        foreach($array as $key=>$value){
            $signature[$key]=$key.'='.$value;
        }
        $signature['open_key']='open_key'.'='.$openkey;
        ksort($signature);
        #先sha1加密 在md5加密
        $sign_str = md5(sha1(implode('&', $signature)));
        return $sign_str;
    }


    #使用post的传输
    public function actionCurl($url,$data){
        //启动一个CURL会话
        $ch = curl_init();
        // 设置curl允许执行的最长秒数
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        //忽略证书
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        // 获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_URL,$url);
        //发送一个常规的POST请求。
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_HEADER,0);//是否需要头部信息（否）
        // 执行操作
        $result = curl_exec($ch);
        // curl_close($ch);

        // if(self::DEBUG){
        //     $this->debug('接口返回数据',$result);
        // }
        if($result){
            curl_close($ch);
            #将返回json转换为数组
            $arr_result=json_decode($result,true);
            if(!is_array($arr_result)){
                $arr_result['errcode']=1;
                $arr_result['msg']='服务器繁忙，请稍候重试';
            }
        }else{
            $err_str=curl_error($ch);
            curl_close($ch);
            $arr_result['errcode']=1;
            $arr_result['msg']='服务器繁忙，请稍候重试';
        }
        #返回数据
        return $arr_result;

    }
    //解密
    public static function actionDecrypt($sStr, $sKey) {
        $sStr=hex2bin($sStr);
        $decrypted= mcrypt_decrypt(
            MCRYPT_RIJNDAEL_128,
            $sKey,
            $sStr,
            MCRYPT_MODE_ECB
        );

        $dec_s = strlen($decrypted);
        $padding = ord($decrypted[$dec_s-1]);
        $decrypted = substr($decrypted, 0, -$padding);
        return $decrypted;
    }
    /*
     * 异步回调
     */
    public  function  actionNotify(){
		
        $this->actionsave_log('log','开始接');
		
        $Data = file_get_contents('php://input');
        $openkey = '7a22cbfe8fdfee528d1';
        $this->actionsave_log('log',$Data);
		// exit;
        $params = explode("&", $Data);

        foreach($params as $key=>$val) {

            $value = explode("=", $val);

            $key = $value[0];

            $resultarr[$key] = $value[1];

        }

        $sign = $resultarr['sign'];

        $resultarr['sign'];

        unset($resultarr['sign']);

        $resultarr['trade_result'] = urldecode($resultarr['trade_result']);

        $signature = array();
        foreach($resultarr as $key=>$value){
            $signature[$key]=$key.'='.$value;
        }
        $signature['open_key']='open_key'.'='.$openkey;
        ksort($signature);
        #先sha1加密 在md5加密
        $sign_str = md5(sha1(implode('&', $signature)));

        $total_fee = number_format($resultarr['amount']/100.0, 2, ".", "");

        if($sign_str == $sign) {
            //成功逻辑--------------------begin--------------------
			echo "notify_success";
			return ;
        }else{
           echo 'notify_fail';
        }

    }
	
	
    public  function  actionCallback(){
        $this->redirect('/user/index');

    }

    /**
     *  作用：以post方式提交data到对应的接口url
     */
    public function actiontoPost($url,$str,$second=30){
        //初始化curl
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
        //运行curl
        $data = curl_exec($ch);
        //返回结果

        if($data){
            curl_close($ch);
            return $data;
        }else{
            $error = curl_errno($ch);
            echo "ERR";
            curl_close($ch);
            return false;
        }
    }

    /**
     * ******************
     * 1、写入内容到文件,追加内容到文件
     * 2、打开并读取文件内容
     * *******************
     */
    public function actionsave_log($path, $msg)
    {
        if (! is_dir($path)) {
            mkdir($path);
        }
        $filename = $path . '/' . date('YmdHi') . '.txt';
        $content = date("Y-m-d H:i:s")."\r\n".$msg."\r\n \r\n \r\n ";
        file_put_contents($filename, $content, FILE_APPEND);
    }
}

$a = new PinganPay();
$a->actionIndex();

?>
