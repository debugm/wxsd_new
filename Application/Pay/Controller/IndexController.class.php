<?php
namespace Pay\Controller;

class IndexController extends PayController
{
    public function __construct()
    {
        parent::__construct();
        if(empty($_REQUEST)){
            exit(json_encode(['errorno'=>30009,'msg'=>'no data'],JSON_UNESCAPED_UNICODE));
        }
        // 商户编号不存在
        $pay_memberid = trim(I("request.pay_memberid"));
        if (!$pay_memberid) {
            exit(json_encode(['errono'=>30010,'msg'=>"商户编号不存在"],JSON_UNESCAPED_UNICODE));
        }
        // 判断来源域名
        //$this->domaincheck(I('request.pay_memberid')); // 判断来源域名
    }

    public function index()
    {
        $tongdao = I("request.pay_tongdao");
        //file_put_contents("./log.txt", "gggg".$tongdao."\n",FILE_APPEND);
        //检查支付通道状态
        if($tongdao){
            $payapi = D('Payapi')->get_payapi($tongdao);
            $error = true;
            if ($payapi) {
                //是否存在通道文件
                if(!is_file(APP_PATH.'/'.MODULE_NAME.'/Controller/'.$tongdao.'Controller.class.php')){
                    exit(json_encode(['erorno'=>30006,'msg'=>'支付通道不存在'],JSON_UNESCAPED_UNICODE));
                }
                //是否开启通道
                if($payapi['disabled']){
			$str = $this->userinfo['payapicontent'];
                    if(strstr($this->userinfo['payapicontent'],$tongdao)){
                        R($tongdao.'/Pay');
                    }elseif($this->userinfo['defaultpayapi']){
                        R($this->userinfo['defaultpayapi'].'/Pay');
                    }else{
                        exit(json_encode(['erorno'=>30007,'msg'=>'商家支付通道未指定','debug' => $tongdao,'d1' => $str],JSON_UNESCAPED_UNICODE));
                    }
                }else{
                    exit(json_encode(['erorno'=>30008,'msg'=>'支付通道不存在'],JSON_UNESCAPED_UNICODE));
                }
            }
        } 
	/*else {
            if ($this->userinfo['defaultpayapi']) {
                R($this->userinfo['defaultpayapi'] . "/Pay");
            } else {
                $Payapiconfig = M("Payapiconfig");
                $payapiid = $Payapiconfig->where(array('default'=>1))->getField('payapiid');
                $Payapi = M("Payapi");
                $en_payname = $Payapi->where("id=" . $payapiid)->getField("en_payname");
                $_defaultapi = D('Payapi')->get_defaultPayapi();
                R($_defaultapi['en_payname'] . "/Pay");
            }
        }*/
    }

    private function ChoosePayAccess()
    {
        $Payapi = M("Payapi");

        $Payapilist = $Payapi->select();

        $Payapicompatibility = M("Payapicompatibility");

        foreach ($Payapilist as $key) {

            $fieldlist = $Payapicompatibility->where("payapiid = " . $key["id"])->select();

            $i = 0;

            foreach ($fieldlist as $k) {

                $paramstr = I("param." . $k["field"], null);

                if ($paramstr == null) {

                    $i = 1;

                    break;
                }
            }

            if ($i == 1) {

                return $key["en_payname"];
            }
        }
    }
}
