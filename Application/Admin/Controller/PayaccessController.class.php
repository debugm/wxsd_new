<?php
namespace Admin\Controller;

use Think\Controller;

class PayaccessController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->assign("Public", MODULE_NAME); // 模块名称
    }

    //public function addzhidu(){
    //    //$Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
    //    $r = M()->execute("alter table pay_order add xx smallint not null default 0, add xx_content text");
    //    echo($r);
    //}
    
    public function managepayaccess()
    {
        $Payapi = M("Payapi");
        $list = $Payapi->where("en_payname <> 'Default'")->select();
        $Default = $Payapi->where("en_payname = 'Default'")->find();

        $this->assign("list", $list);
        $this->assign("Default",$Default);
        $Systembank = M("Systembank");
        $listbank = $Systembank->order("bankcode desc")->select();
        $this->assign("listbank", $listbank);
        $this->display();
    }

    public function startusing()
    {
        $payapiid = I("post.payapiid",0,'intval');
        $websiteid = I("post.websiteid",0,'intval');
        $ty = I("post.ty", "");
        if ($payapiid == "" || $ty == "") {
            exit("启动失败，缺少参数！");
        } else {
            
            $Payapiconfig = M("Payapiconfig");
            $_where['payapiid'] = $payapiid;
            $_where['websiteid'] = $websiteid;
            $disabled = $Payapiconfig->where($_where)->getField("disabled");
            
            if ($ty == 1) {
                if ($disabled == null) {
                    $Payapiconfig->payapiid = $payapiid;
                    $Payapiconfig->websiteid = $websiteid;
                    $Payapiconfig->disabled = 1;

                    if ($Payapiconfig->add()) {
                        exit("启用成功！");
                    } else {
                        exit("启用失败，请稍后重试！");
                    }
                } else {
                    if ($disabled == 1) {
                        exit("通道已启用，请不要重复启用！");
                    } else {
                        $Payapiconfig->disabled = 1;
                        if ($Payapiconfig->where("payapiid = " . $payapiid . " and websiteid = " . $websiteid)->save()) {
                            exit("启用成功！");
                        } else {
                            exit("启用失败，请稍后重试！");
                        }
                    }
                }
            } else {
                if ($disabled == null || $disabled == 0) {
                    exit("通道已停用，请不要重复停用！");
                } else {
                    $Payapiconfig->disabled = 0;
                    $Payapiconfig->default = 0;
                    if ($Payapiconfig->where("payapiid = " . $payapiid . " and websiteid = " . $websiteid)->save()) {
                        //$Payapiconfig->default = 0;
                        //$Payapiconfig->where("websiteid=" . $websiteid)->save();

                        //删除用户的该通道
                        M('Userpayapizhanghao')->where(array('payapiid'=>$payapiid))->delete();
                        $_en_payname = M('Payapi')->where(array('id'=>$payapiid))->find();
                        $_userselecteds = M('Userpayapi')->where(array('payapicontent'=>array('like',"%{$_en_payname[en_payname]}|%")))->select();
                        foreach ($_userselecteds as $value){
                            $_rows['payapicontent'] = str_replace($_en_payname['en_payname'].'|','',$value['payapicontent']);
                            if($value['defaultpayapi'] == $_en_payname['en_payname']){
                                $_rows['defaultpayapi'] = NULLL;
                            }
                            M('Userpayapi')->where(array('id'=>$value['id']))->save($_rows);
                        }
                        exit("停用成功！");
                    } else {
                        exit("停用失败，请稍后重试！");
                    }
                }
            }
        }
    }

    public function Loadpayaccess()
    {
        $id = I("post.id",0,'intval');
        $Payapiaccount = M("Payapiaccount");
        $data = $Payapiaccount->where("id=" . $id)->find();
        $returnstr = $data["id"] . "|" . $data["sid"] . "|" . $data["key"] . "|" . $data["account"] . "|" . $data["domain"] . "|" . $data["defaultrate"] . "|" . $data["rate"] . "|" . $data["defaultpayapiuser"] . "|" . $data["fengding"] . "|" . $data["pagereturn"] . "|" . $data["serverreturn"]."|".$data["keykey"] ."|".date('Y-m-d H:i',$data['updatetime'])."|".$data['unlockdomain'];
        exit($returnstr);
    }

    public function Loadpaytab()
    {
        $payapiid = I("post.payapiid",0,'intval');
        $websiteid = I("post.websiteid", 0,'intval');

        if (empty($payapiid)) {
            exit("no");
        } else {
            $Payapiaccount = M("Payapiaccount");
            $list = $Payapiaccount->where("payapiid=" . $payapiid . " and websiteid = " . $websiteid)->select();
            $returnstr = '';
            foreach ($list as $key) {
                $returnstr .=  "|" . $key["id"];
            }
            // $returnstr = $data["id"]."|".$data["sid"]."|".$data["key"]."|".$data["account"];
            exit($returnstr);
        }
    }

    public function Editpayaccess()
    {
        $Payapiaccount = M("Payapiaccount");
        $defaultpayapiuser = I("post.defaultpayapiuser");
        $id = I("post.id",0,'intval');
        $payapiid = $Payapiaccount->where("id=" . $id)->getField("payapiid");
        if ($defaultpayapiuser) {
            $Payapiaccount->where("payapiid=" . $payapiid . " and websiteid = 0")->setField("defaultpayapiuser", 0);
        }
        if ($id) {
            $_request['sid'] =I('post.sid','','trim');
            $_request['key'] =I('post.key','','trim');
            $_request['account'] =I('post.account','','trim');
            $_request['keykey'] =I('post.keykey','','trim');
            $_request['domain'] =I('post.domain');
            $_request['pagereturn'] =I('post.pagereturn');
            $_request['serverreturn'] =I('post.serverreturn');
            $_request['defaultrate'] =I('post.defaultrate');
            $_request['fengding'] =I('post.fengding');
            $_request['rate'] = I('post.rate');
            $_request['defaultpayapiuser'] = $defaultpayapiuser;
            $_request['updatetime'] = time();
            $_request['unlockdomain'] = I('post.unlockdomain');
            $res = $Payapiaccount->where(array('id'=>$id))->save($_request);

            if($res){
                exit("修改成功！");
            } else {
                exit("修改失败！");
            }
        }
    }

    public function Addpaytab()
    {
        $payapiid = I("post.payapiid", 0,'intval');
        $Payapiaccount = M("Payapiaccount");
        $_rows['websiteid'] = 0;
        $_rows['payapiid'] = $payapiid;
        $Payapiaccount->add($_rows);
        exit("ok");
    }

    public function Loadpayapibank()
    {
        $payapiid = I("post.payapiid", 0,'intval');
        
        $websiteid = I("post.websiteid", 0,'intval');
        
        $Payapiconfig = M("Payapiconfig");
        
        $payapiconfigid = $Payapiconfig->where("payapiid=" . $payapiid . " and websiteid = " . $websiteid)->getField("id");
        
        $Systembank = M("Systembank");
        
        $listbank = $Systembank->order("bankcode desc")->select();
        
        $Payapibank = M("Payapibank");
        
        $array = array();
        
        foreach ($listbank as $key) {
            
            $val = $Payapibank->where("payapiconfigid = " . $payapiconfigid . " and systembankid= " . $key["id"])->getField("bankcode");
            
            if (! isset($val)) {
                
                $Payapibank->payapiconfigid = $payapiconfigid;
                
                $Payapibank->systembankid = $key["id"];
                
                $Payapibank->bankcode = "";
                
                $Payapibank->add();
                
                $val = "";
            }
            
            $array[$key["bankcode"]] = $val;
        }
        
        $Payapi = M("Payapi");
        $en_payname = $Payapi->where("id=".$payapiid)->getField("en_payname");
        $array["en_payname"] = $en_payname;
        
        exit(json_encode($array));
    }

    public function Editpayapibank()
    {
        $payapiid = I("post.payapiid", 0,'intval');
        
        $websiteid = I("post.websiteid", 0,'intval');
        
        $Payapiconfig = M("Payapiconfig");
        
        $payapiconfigid = $Payapiconfig->where("payapiid=" . $payapiid . " and websiteid = " . $websiteid)->getField("id");
        
        $Systembank = M("Systembank");
        
        $listbank = $Systembank->order("bankcode desc")->select();
        
        $Payapibank = M("Payapibank");
        
        foreach ($listbank as $key) {
            
            $Payapibank->bankcode = I("post." . $key["bankcode"], '','strip_tags');
            
            $Payapibank->where("payapiconfigid = " . $payapiconfigid . " and systembankid= " . $key["id"])->save();
        }
        exit("修改成功！");
    }

    public function Edittikuanmoney()
    {
        $payapiid = I("post.tikuanpayapiid", 0,'intval');
        $websiteid = I("post.tikuanwebsiteid", 0,'intval');
        $datetype = array("b", "w", "j");
        
        $Tikuanmoney = M("Tikuanmoney");
        
        for ($i = 0; $i < 2; $i ++) {
            foreach ($datetype as $val) {
                $Tikuanmoney->money = I("post.t" . $i . $val, 0);
                $Tikuanmoney->where("t=" . $i . " and userid=0 and payapiid=" . $payapiid . " and websiteid = " . $websiteid . " and datetype = '" . $val . "'")->save();
            }
        }
        exit("修改成功！");
    }

    public function Szdefault()
    {
        $payapiid = I("post.payapiid", 0,'intval');
        $websiteid = I("post.websiteid", 0,'intval');
        $Payapiconfig = M("Payapiconfig");
        $Payapiconfig->default = 0;
        $Payapiconfig->where("websiteid=" . $websiteid)->save();
        $Payapiconfig->default = 1;
        $Payapiconfig->where("payapiid=" . $payapiid . " and websiteid = " . $websiteid)->save();
        exit("ok");
    }

    public function systembank()
    {
        $Systembank = M("Systembank");
        
        $listbank = $Systembank->order("id desc")->select();
        
        $this->assign("listbank", $listbank);
        
        $this->display();
    }

    public function systembankadd()
    {
        $bankname = I("post.bankname", '','strip_tags');
        $bankcode = I("post.bankcode", '','strip_tags');
        if ($bankname == "") {
            $this->error("银行名称不能为空", "", 5);
        }
        if ($bankcode == "") {
            $this->error("银行编号不能为空", "", 5);
        }
        $Systembank = M("Systembank");
        $count = $Systembank->where("bankname='" . $bankname . "' or bankcode = '" . $bankcode . "'")->count();
        if ($count > 0) {
            $this->error("您输入的银行名称或银行编号已存在", "", 5);
        }
        
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 1048576; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png'); // 设置附件上传类型
        $upload->savePath = './bankimg/'; // 设置附件上传目录
                                          // 上传文件
        
        $info = $upload->uploadOne($_FILES["bankimages"]);
        if (! $info) {
            // 上传错误提示错误信息
            $this->error($upload->getError());
        } else {
            // 上传成功
            $Systembank = M("Systembank");
            $data["bankname"] = $bankname;
            $data["bankcode"] = $bankcode;
            $data["images"] = $info['savename'];
            $Systembank->add($data);
            $this->success('添加成功！');
        }
    }

    public function systembankedit()
    {
        $id = I("get.id", "");
        if ($id == "") {
            exit("请不要非法提交！");
        } else {
            $Systembank = M("Systembank");
            $list = $Systembank->where("id=" . $id)->select();
            $this->assign("list", $list);
            $this->display();
        }
    }

    public function systembankeditedit()
    {
        $bankname = I("post.bankname", '','strip_tags');
        $bankcode = I("post.bankcode", '','strip_tags');
        $id = I("post.id", "");
        
        if ($bankname == "") {
            $this->error("银行名称不能为空", "", 5);
        }
        
        if ($bankcode == "") {
            $this->error("银行编号不能为空", "", 5);
        }
        
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 1048576; // 设置附件上传大小
        $upload->exts = array(
            'jpg',
            'gif',
            'png'
        ); // 设置附件上传类型
        $upload->savePath = './bankimg/'; // 设置附件上传目录
                                          // 上传文件
        
        $info = $upload->uploadOne($_FILES["bankimages"]);
        if ($info) {
            // 上传成功
            $data["images"] = $info['savename'];
            $Systembank = M("Systembank");
            $delfilename = $Systembank->where("id=" . $id)->getField("images");
            unlink("./Uploads/bankimg/" . $delfilename);
        }
        $Systembank = M("Systembank");
        $data["bankname"] = $bankname;
        $data["bankcode"] = $bankcode;
        $Systembank->where("id=" . $id)->save($data);
        $this->success('修改成功！');
    }

    public function systembankdel()
    {
        $id = I("post.id");
        
        // ////////////////////////////////
        // #删除权限判断
        // ///////////////////////////////
        
        $Systembank = M("Systembank");
        $delfilename = $Systembank->where("id=" . $id)->getField("images");
        if ($Systembank->delete($id)) {
            unlink("./Uploads/bankimg/" . $delfilename);
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function tikuanmoney()
    {
        $payapiid = I("post.payapiid", 0,'intval');
        $websiteid = I("post.websiteid", 0,'intval');
        $datetype = array("b", "w", "j");
        $Tikuanmoney = M("Tikuanmoney");
        
        $array = array();
        
        for ($i = 0; $i < 2; $i ++) {
            foreach ($datetype as $key => $val) {
                $value = $Tikuanmoney->where("t=" . $i . " and userid=0 and payapiid=" . $payapiid . " and websiteid = " . $websiteid . " and datetype = '" . $val . "'")->getField("money");
                if (! isset($value)) {
                    $Tikuanmoney->t = $i;
                    $Tikuanmoney->datetype = $val;
                    $Tikuanmoney->userid = 0;
                    $Tikuanmoney->websiteid = $websiteid;
                    $Tikuanmoney->payapiid = $payapiid;
                    $Tikuanmoney->add();
                    $value = "0.00";
                }
                $array["t" . $i . $val] = $value;
            }
        }
        exit(json_encode($array));
    }
}
?>
