<?php
namespace Pay\Controller;
class DefaultController extends PayController{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function Pay(){
        $Payapi = M("Payapi");
        $payapiid = $Payapi->where("en_payname='Default'")->getField("id");
        
        $Systembank = M("Systembank");
        $pay_bankcode = I("request.pay_bankcode","");
        $systembankid = $Systembank->where("bankcode='" . $pay_bankcode . "'")->getField("id");
        $Payapiconfig = M("Payapiconfig");
        $payapiconfigid = $Payapiconfig->where("payapiid=" . $payapiid)->getField("id");
        $Payapibank = M("Payapibank");
        $bankcode = $Payapibank->where("systembankid = " . $systembankid . " and payapiconfigid = " . $payapiconfigid)->getField("bankcode");
        
        

            $Payapi = M("Payapi");
            $en_payname = $Payapi->where("id=".$bankcode)->getField("en_payname");
            if($en_payname){
                $action = U("/Pay/Index");
              $str = '<form  id="Form1" name="Form1"  method="post"  action="'.$action.'">';
                foreach ($_POST as $key => $val){
                    $str = $str.'<input type="hidden" name="'.$key.'" value="'.$val.'">';
                }
                
                $str = $str.'<input type="hidden" name="tongdao" value="'.$en_payname.'">';
                $str = $str.'<input type="hidden" name="defaulttongdao" value="default">';
                $str = $str . '</form>';
                $str = $str . '<script>';
                $str = $str . 'document.Form1.submit();';
                $str = $str . '</script>';
                exit($str);
               // R($en_payname . "/Pay");
            }else{
                exit("银行编码错误 ！");
            }

    }
}
?>