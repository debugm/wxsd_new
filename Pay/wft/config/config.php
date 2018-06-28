<?php
class Config{
    private $cfg = array(
        'url'=>'https://pay.swiftpass.cn/pay/gateway',
        'mchId'=>'399530519723',//测试商户号，商户上线需改为自己正式的
        'key'=>'90d4fb3912f6956b3142b9ed4832b346',//测试密钥，商户上线需改为自己正式的
        'version'=>'2.0',
       );
    
    public function C($cfgName){
        return $this->cfg[$cfgName];
    }
}
?>
