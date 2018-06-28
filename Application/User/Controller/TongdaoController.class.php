<?php
namespace User\Controller;

;

class TongdaoController extends UserController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function wdtongdao()
    {
        /**
         * **********************************************************************************************
         */
        // 可用通道金额
        $Userpayapi = M("Userpayapi");
        $defaultpayapi = $Userpayapi->where("userid=" . session("userid"))->getField("defaultpayapi");
        $this->assign("defaultpayapi", $defaultpayapi);
        $payapicontent = $Userpayapi->where("userid=" . session("userid"))->getField("payapicontent");
        $array = explode("|", $payapicontent);
        $strarray = "";
        foreach ($array as $key => $val) {
            $strarray = "'" . $val . "'," . $strarray;
        }
        $strarray = $strarray . "''";
        $Payapi = M("Payapi");
        $apimoneyarray = $Payapi->field("id,zh_payname,en_payname")
            ->where("en_payname in (" . $strarray . ")")
            ->select();
        $apimoneylist = array();
        $i = 0;
        $Userpayapizhanghao = M("Userpayapizhanghao");
        foreach ($apimoneyarray as $key) {
            
            $find = $Userpayapizhanghao->where("payapiid=" . $key["id"] . " and userid=" . session("userid"))->find();
            if (! $find) {
                // $Userpayapizhanghao->payapiid = $key["id"];
                // $Userpayapizhanghao->userid = session("userid");
                $data["payapiid"] = $key["id"];
                $data["userid"] = session("userid");
                $Userpayapizhanghao->add($data);
                $find = $Userpayapizhanghao->where("payapiid=" . $key["id"] . " and userid=" . session("userid"))->find();
            }
            $apimoneylist[$i]["id"] = $key["id"];
            $apimoneylist[$i]["zh_payname"] = $key["zh_payname"];
            $apimoneylist[$i]["feilv"] = $find["feilv"] == null ? 0 : $find["feilv"];
            $apimoneylist[$i]["fengding"] = $find["fengding"] == null ? 0 : $find["fengding"];
            $apimoneylist[$i]["userid"] = session("userid");
            $apimoneylist[$i]["defaultpayapiuserid"] = $find["defaultpayapiuserid"];
            $apimoneylist[$i]["en_payname"] = $key["en_payname"];
            $i ++;
        }
        /**
         * **********************************************************************************************
         */
        $this->assign("tongdaosxf", $apimoneylist);
        $this->display();
    }
    
    
    public function dftongdao()
    {
        /**
         * **********************************************************************************************
         */
        // 可用通道金额
        $Userpayapi = M("Userpayapi");
        $defaultpayapi = $Userpayapi->where("userid=" . session("userid"))->getField("defaultdfapi");
        $this->assign("defaultpayapi", $defaultpayapi);
        $payapicontent = $Userpayapi->where("userid=" . session("userid"))->getField("payapicontent");
        $array = explode("|", $payapicontent);
        $strarray = "";
        foreach ($array as $key => $val) {
            $strarray = "'" . $val . "'," . $strarray;
        }
        $strarray = $strarray . "''";
        $Payapi = M("Payapi");
        $apimoneyarray = $Payapi->field("id,zh_payname,en_payname")
        ->where("en_payname in (" . $strarray . ")")
        ->select();
        $apimoneylist = array();
        $i = 0;
        $Userpayapizhanghao = M("Userpayapizhanghao");
        foreach ($apimoneyarray as $key) {
    
            $find = $Userpayapizhanghao->where("payapiid=" . $key["id"] . " and userid=" . session("userid"))->find();
            if (! $find) {
                // $Userpayapizhanghao->payapiid = $key["id"];
                // $Userpayapizhanghao->userid = session("userid");
                $data["payapiid"] = $key["id"];
                $data["userid"] = session("userid");
                $Userpayapizhanghao->add($data);
                $find = $Userpayapizhanghao->where("payapiid=" . $key["id"] . " and userid=" . session("userid"))->find();
            }
            $apimoneylist[$i]["id"] = $key["id"];
            $apimoneylist[$i]["zh_payname"] = $key["zh_payname"];
            $apimoneylist[$i]["feilv"] = $find["feilv"] == null ? 0 : $find["feilv"];
            $apimoneylist[$i]["fengding"] = $find["fengding"] == null ? 0 : $find["fengding"];
            $apimoneylist[$i]["userid"] = session("userid");
            $apimoneylist[$i]["defaultpayapiuserid"] = $find["defaultpayapiuserid"];
            $apimoneylist[$i]["en_payname"] = $key["en_payname"];
            $i ++;
        }
        /**
         * **********************************************************************************************
         */
        $this->assign("tongdaosxf", $apimoneylist);
        $this->display();
    }
    

    public function editwdtongdao()
    {
        $defaultpayapi = I("post.defaultpayapi", "");
        $Userpayapi = M("Userpayapi");
        $Userpayapi->defaultpayapi = $defaultpayapi;
        $Userpayapi->where("userid=" . session("userid"))->save();
        exit("默认通道设置成功！");
    }
    
    public function editdftongdao()
    {
        $defaultpayapi = I("post.defaultpayapi", "");
        $Userpayapi = M("Userpayapi");
        $Userpayapi->defaultdfapi = $defaultpayapi;
        $Userpayapi->where("userid=" . session("userid"))->save();
        exit("默认代付通道设置成功！");
    }

    /*
     * public function czsxf(){
     *
     * //可用通道金额
     * $Userpayapi = M("Userpayapi");
     * $defaultpayapi = $Userpayapi->where("userid=".session("userid"))->getField("defaultpayapi");
     * $this->assign("defaultpayapi",$defaultpayapi);
     * $payapicontent = $Userpayapi->where("userid=".session("userid"))->getField("payapicontent");
     * $array = explode("|", $payapicontent);
     * $strarray = "";
     * foreach($array as $key => $val){
     * $strarray = "'".$val."',".$strarray;
     * }
     * $strarray = $strarray."''";
     * $Payapi = M("Payapi");
     * $apimoneyarray = $Payapi->field("id,zh_payname,en_payname")->where("en_payname in (".$strarray.")")->select();
     * $apimoneylist = array();
     * $i = 0;
     * $Userpayapizhanghao = M("Userpayapizhanghao");
     * foreach($apimoneyarray as $key){
     * $find = $Userpayapizhanghao->where("payapiid=".$key["id"]." and userid=".session("userid"))->find();
     * if(!$find){
     * $Userpayapizhanghao->payapiid = $key["id"];
     * $Userpayapizhanghao->userid = session("userid");
     * $Userpayapizhanghao->add();
     * $find = $Userpayapizhanghao->where("payapiid=".$key["id"]." and userid=".session("userid"))->find();
     * }
     * $apimoneylist[$i]["id"] = $key["id"];
     * $apimoneylist[$i]["zh_payname"] = $key["zh_payname"];
     * $apimoneylist[$i]["feilv"] = $find["feilv"]==null?0:$find["feilv"];
     * $apimoneylist[$i]["fengding"] = $find["fengding"]==null?0:$find["fengding"];
     * $apimoneylist[$i]["userid"] = session("userid");
     * $apimoneylist[$i]["defaultpayapiuserid"] = $find["defaultpayapiuserid"];
     * $apimoneylist[$i]["en_payname"] = $key["en_payname"];
     * $i++;
     * }
     *
     * $this->assign("tongdaosxf",$apimoneylist);
     * $this->display();
     * }
     */
    public function tksxf()
    {
        $Userpayapi = M("Userpayapi");
        $payapicontent = $Userpayapi->where("userid=" . session("userid"))->getField("payapicontent");
        $array = explode("|", $payapicontent);
        $strarray = "";
        foreach ($array as $key => $val) {
            $strarray = "'" . $val . "'," . $strarray;
        }
        $strarray = $strarray . "''";
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->field("id,zh_payname")
            ->where("en_payname in (" . $strarray . ")")
            ->select();
        $this->assign("tongdaolist", $tongdaolist);
        $this->display();
    }

    public function tksz()
    {
        $userid = session("userid");
        
        $User = M("User");
        $usertype = $User->where("id=" . $userid)->getField("usertype");
        $useriduserid = $userid;
        /*
         * if($usertype == 2){ //如果用户类型为2 分站管理员
         * $Website = M("Website");
         * $websiteid = $Website->where("userid=".$userid)->getField("id");
         * $userid = 0;
         * }else{
         * $websiteid = 0;
         * }
         */
        $websiteid = session("websiteid");
        
        $Payapiconfig = M("Payapiconfig");
        $disabledpayapiid = $Payapiconfig->field('payapiid')
            ->where("disabled=0")
            ->select(false);
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->where("id not in (" . $disabledpayapiid . ")")->select();
        
        $datetype = array(
            "b",
            "w",
            "j"
        );
        
        $Tikuanmoney = M("Tikuanmoney");
        
        $array = array();
        
        foreach ($tongdaolist as $tongdao) {
            for ($i = 0; $i < 2; $i ++) {
                foreach ($datetype as $val) {
                    $value = $Tikuanmoney->where("t=" . $i . " and userid=" . $userid . " and payapiid=" . $tongdao["id"] . " and websiteid = " . $websiteid . " and datetype = '" . $val . "'")->getField("money");
                    if (! isset($value)) {
                        $Tikuanmoney->t = $i;
                        $Tikuanmoney->datetype = $val;
                        $Tikuanmoney->userid = $userid;
                        $Tikuanmoney->websiteid = $websiteid;
                        $Tikuanmoney->payapiid = $tongdao["id"];
                        $Tikuanmoney->add();
                        $value = "0.00";
                    }
                    
                    if ($value == 0) {
                        $value = $Tikuanmoney->where("t=" . $i . " and userid=0 and payapiid=" . $tongdao["id"] . " and websiteid = " . $websiteid . " and datetype = '" . $val . "'")->getField("money");
                    }
                    $array["form" . $tongdao["id"]]["t" . $i . $val] = $value;
                }
            }
            $array["form" . $tongdao["id"]]["tikuanpayapiid"] = $tongdao["id"];
            $array["form" . $tongdao["id"]]["userid"] = $useriduserid;
        }
        
        $this->ajaxReturn($array, "json");
    }
}