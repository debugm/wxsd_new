<?php
namespace User\Controller;

class AccountController extends UserController
{

    public function __construct()
    {
        parent::__construct();
        $this->assign("Public", MODULE_NAME); // 模块名称
    }

    public function zqtongdao()
    {
	$Money = M("Money");
        $SumMoney = $Money->where(array('userid'=>session("userid")))->getField("money");
        $Sumfreezemoney = $Money->where("userid=" . session("userid"))->getField("freezemoney");
        $wallet = $Money->where("userid=" . session("userid"))->getField("wallet");

        // 可用通道金额
        $Userpayapi = M("Userpayapi");
        $payapicontent = $Userpayapi->where("userid=" . session("userid"))->getField("payapicontent");
        $array = explode("|", $payapicontent);
        $strarray = "";
        foreach ($array as $key => $val) {
            $strarray = "'" . $val . "'," . $strarray;
        }
        $strarray = $strarray . "''";
        $Payapi = M("Payapi");
        $apimoneyarray = $Payapi->field("id,zh_payname,en_payname")
            ->where("en_payname in (" . $strarray . ") and mode=1")
            ->select();
        $apimoneylist = array();
        $i = 0;
        $Apimoney = M("Apimoney2");
        foreach ($apimoneyarray as $key) {
            $find = $Apimoney->where("payapiid=" . $key["id"] . " and userid=" . session("userid"))->find();
            if (! $find) {
                $data = array();
                $data["userid"] = session("userid");
                $data["payapiid"] = $key["id"];
                $Apimoney->add($data);
                $find = $Apimoney->where("payapiid=" . $key["id"] . " and userid=" . session("userid"))->find();
            }
		$userid = intval(session("userid")) + 10000;
		$starttime = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endtime = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		//$endtime = 1525617756;


	    $apimoneylist[$i]['num'] = M('Order')->where(array('pay_tongdao' => $key['en_payname'] ,'pay_memberid' => $userid,'pay_status'=>1,'pay_successdate'=>array('between',array($starttime,$endtime))))->count();
	    $apimoneylist[$i]['num'] += M('Order')->where(array('pay_tongdao' => $key['en_payname'],'pay_memberid' => $userid ,'pay_status'=>2,'pay_successdate'=>array('between',array($starttime,$endtime))))->count();
            $apimoneylist[$i]['amount'] = M('Order')->where(array('pay_status'=>1,'pay_tongdao' => $key['en_payname'],'pay_memberid' => $userid,'pay_successdate'=>array('between',array($starttime,$endtime))))->sum('pay_amount');
            $apimoneylist[$i]['amount'] += M('Order')->where(array('pay_status'=>2,'pay_tongdao' => $key['en_payname'],'pay_memberid' => $userid,'pay_successdate'=>array('between',array($starttime,$endtime))))->sum('pay_amount');
            $apimoneylist[$i]["id"] = $key["id"];
            $apimoneylist[$i]["zh_payname"] = $key["zh_payname"];
            $apimoneylist[$i]['en_payname'] = $key['en_payname'];
            $apimoneylist[$i]["money"] = $find["money"];
            //$apimoneylist[$i]["freezemoney"] = $find["freezemoney"];
            //$apimoneylist[$i]["status"] = $find["status"];
            $i ++;
        }
        //md5key
        $md5key = M('Userverifyinfo')->where(array('userid'=>session('userid')))->getField('md5key');

        $this->assign('md5key',$md5key);
        $this->assign("SumMoney", $SumMoney);
        $this->assign("Sumfreezemoney", $Sumfreezemoney);
        $this->assign("apimoneylist", $apimoneylist);
        $this->assign("wallet", $wallet);
        
        $this->display();
    }    

    public function basicinfo()
    {
        $Userbasicinfo = M("Userbasicinfo");
        $list = $Userbasicinfo->where("userid=" . session("userid"))->select();
        
        $this->assign("list", $list);
        $this->display();
    }

    public function basicinfoedit()
    {
        $Userbasicinfo = M("Userbasicinfo");
        $Userbasicinfo->create();
        if ($Userbasicinfo->save()) {
            exit("基本信息修改成功！");
        } else {
            exit("基本信息修改失败！");
        }
    }

    public function bankcard()
    {
        $Bankcard = M("Bankcard");
        $list = $Bankcard->where("userid=" . session("userid"))->find();
        $this->assign("list", $list);
        $jdatetime = $list["jdatetime"];

        $disabled = $list["disabled"];
        $this->assign("disabled", $disabled);
        
        if ($jdatetime) {
            if (strtotime($jdatetime) < time()) {
                $xg = 1;
            } else {
                $xg = 0;
            }
        } else {
            $xg = 1;
        }
        if ($disabled == 1) {
            $xg = 0;
        }
        $this->assign("xg", $xg);
        $Systembank = M("Systembank");
        $banklist = $Systembank->select();
        $this->assign("banklist", $banklist);
        $this->display();
    }

    public function addbankcard(){
        $Systembank = M("Systembank");
        $banklist = $Systembank->select();
        $this->assign("banklist", $banklist);

        if(IS_POST){
            print_r($_POST);
        }

        $this->display();
    }
    public function bankcardedit()
    {
        if(IS_POST){
            $id = I('post.id');
            $Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
            $location = $Ip->getlocation(); // 获取某个IP地址所在的位置

            $Bankcard = M("Bankcard");
            $_formdata = array(
                'userid'=>session("userid"),
                'bankname'=>I('post.bankname'),
                'bankfenname'=>I('post.bankfenname'),
                'bankzhiname'=>I('post.bankzhiname'),
                'banknumber'=>I('post.banknumber'),
                'bankfullname'=>I('post.bankfullname'),
                'sheng'=>I('post.sheng'),
                'shi'=>I('post.shi'),
                'kdatetime'=>date("Y-m-d H:i:s"),
                'jdatetime'=>date("Y-m-d H:i:s", time()+40*3600*24),
                'ip'=>$location['ip'],
                'ipaddress'=>$location['country'] . "-" . $location['area'],
                'disabled'=>1,
            );
            if($id){
                $result = $Bankcard->where(array('id'=>$id))->save($_formdata);
            }else{
                $result = $Bankcard->add($_formdata);
            }
            $Bankcard->getLastSql();
            if ($result) {
                $this->success("银行卡信息修改成功！");
            } else {
                $this->error("银行卡息修改失败！");
            }
        }
    }

    public function bankcarddisabled()
    {
        $Bankcard = M("Bankcard");
        $Bankcard->disabled = 1;
        if ($Bankcard->where("id=" . I("post.id"))->save()) {
            exit("已成功禁止修改银行卡信息！");
        } else {
            exit("禁止修改银行卡信息失败！");
        }
    }

    public function loginrecord()
    {
        $where = array();
        
        $where[0] = "userid = " . session("userid");
        
        $list = $this->lists("loginrecord", $where);
        
        $this->assign("list", $list);
        
        $this->display();
    }

    public function verifyinfo()
    {
        $Userverifyinfo = M("Userverifyinfo");
        
        $uploadsfzzm = $Userverifyinfo->where("userid=" . session("userid"))->getField("uploadsfzzm");
        $uploadsfzbm = $Userverifyinfo->where("userid=" . session("userid"))->getField("uploadsfzbm");
        $uploadscsfz = $Userverifyinfo->where("userid=" . session("userid"))->getField("uploadscsfz");
        $uploadyhkzm = $Userverifyinfo->where("userid=" . session("userid"))->getField("uploadyhkzm");
        $uploadyhkbm = $Userverifyinfo->where("userid=" . session("userid"))->getField("uploadyhkbm");
        $uploadyyzz = $Userverifyinfo->where("userid=" . session("userid"))->getField("uploadyyzz");
        $status = $Userverifyinfo->where("userid=" . session("userid"))->getField("status");
        
        $this->assign("uploadsfzzm", $uploadsfzzm);
        $this->assign("uploadsfzbm", $uploadsfzbm);
        $this->assign("uploadscsfz", $uploadscsfz);
        $this->assign("uploadyhkzm", $uploadyhkzm);
        $this->assign("uploadyhkbm", $uploadyhkbm);
        $this->assign("uploadyyzz", $uploadyyzz);
        $this->assign("status", $status);
        
        $this->display();
    }

    public function upload()
    {
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 2097152; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'bmp'); // 设置附件上传类型
        $upload->savePath = '/verifyinfo/'; // 设置附件上传目录
        // 上传文件
        $fieldsname = I("post.fieldsname");
        $info = $upload->uploadOne($_FILES[$fieldsname]);
        if (! $info) { // 上传错误提示错误信息
            $this->error($upload->getError());
        } else { // 上传成功
            //$Website = M("Websiteconfig");
            //$syname = $Website->where("websiteid = " . session("websiteid"))->getField("domain");
            //$image = new \Think\Image();
            // 在图片右下角添加水印文字 ThinkPHP 并保存为new.jpg
            //$image->open('./Uploads/verifyinfo/' . $info['savename'])
            //    ->text($syname, './Public/fonts/1.ttf', 30, '#cccccc', \Think\Image::IMAGE_WATER_CENTER)
             //   ->save('./Uploads/verifyinfo/' . $info['savename']);
            //$Userverifyinfo = M("Userverifyinfo");
            //$delfilename = $Userverifyinfo->where("userid=" . session("userid"))->getField($fieldsname);
            //unlink("./Uploads/verifyinfo/" . $delfilename);
            $data[$fieldsname] = $info['savename'];
            M("Userverifyinfo")->where("userid=" . session("userid"))->save($data);
            $this->success('上传成功！');
        }
    }

    public function verifyinfodel()
    {
        $Userverifyinfo = M("Userverifyinfo");
        $fieldsname = I("get.filename");
        $delfilename = $Userverifyinfo->where("userid=" . session("userid"))->getField($fieldsname);
        $data[$fieldsname] = "";
        $Userverifyinfo->where("userid=" . session("userid"))->save($data);
        unlink("./Uploads/verifyinfo/" . $delfilename);
        $this->success('图片删除成功！');
    }

    public function verifyinfosqsh()
    {
        $Userverifyinfo = M("Userverifyinfo");
        $data["status"] = 2;
        $Userverifyinfo->where("userid=" . session("userid"))->save($data);
        $this->success('已申请认证，请等待审核！');
    }

    public function verifyloginpassword()
    {
        $loginpassword = I("post.loginpassword");
        $Userpassword = M("Userpassword");
        if ($Userpassword->where("userid=" . session("userid") . " and loginpassword = '" . md5($loginpassword) . "'")->select()) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function verifypaypassword()
    {
        $loginpassword = I("post.loginpassword");
        $Userpassword = M("Userpassword");
        if ($Userpassword->where("userid=" . session("userid") . " and paypassword = '" . md5($loginpassword) . "'")->select()) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function editloginpassword()
    {
        $yloginpassword = I("post.yloginpassword");
        $loginpassword = I("post.loginpassword");
        $okloginpassword = I("post.okloginpassword");
        
        if ($yloginpassword == "") {
            $this->error("原密码不能为空！");
        } else {
            $Userpassword = M("Userpassword");
            if ($Userpassword->where("userid=" . session("userid") . " and loginpassword = '" . md5($yloginpassword) . "'")->select()) {
                if ($loginpassword == "") {
                    $this->error("新密码不能为空！");
                } else {
                    if ($loginpassword != $okloginpassword) {
                        $this->error("两次新密码输入不一致！");
                    } else {
                        $Userpassword = M("Userpassword");
                        $Userpassword->loginpassword = md5($loginpassword);
                        $Userpassword->where("userid=" . session("userid"))->save();
                        $this->success("登录密码修改成功,请退出后重新登录", U("Index/quit"));
                    }
                }
            } else {
                $this->error("原密码错误！");
            }
        }
    }

    public function editpaypassword()
    {
        $yloginpassword = I("post.yloginpassword");
        $loginpassword = I("post.loginpassword");
        $okloginpassword = I("post.okloginpassword");
        
        if ($yloginpassword == "") {
            $this->error("原密码不能为空！");
        } else {
            $Userpassword = M("Userpassword");
            if ($Userpassword->where("userid=" . session("userid") . " and paypassword = '" . md5($yloginpassword) . "'")->select()) {
                if ($loginpassword == "") {
                    $this->error("新密码不能为空！");
                } else {
                    if ($loginpassword != $okloginpassword) {
                        $this->error("两次新密码输入不一致！");
                    } else {
                        $Userpassword = M("Userpassword");
                        $Userpassword->paypassword = md5($loginpassword);
                        $Userpassword->where("userid=" . session("userid"))->save();
                        $this->success("支付密码修改成!");
                    }
                }
            } else {
                $this->error("原密码错误！");
            }
        }
    }

    public function zjbdjl()
    { // 资金变动记录
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->select();
        $this->assign("tongdaolist", $tongdaolist); // 通道列表
        $where = array();
        $memberid = session("userid");
        $i = 0;
        $where[$i] = "userid = " . $memberid;
        $i ++;
        
        $orderid = I("get.orderid");
        if ($orderid) {
            $where[$i] = "transid = '" . $orderid . "'";
            $i ++;
        }
        
        $tongdao = I("get.tongdao");
        if ($tongdao) {
            $Payapi = M("Payapi");
            $tongdaoid = $Payapi->where("en_payname='" . $tongdao . "'")->getField("id");
            $where[$i] = "tongdao = " . $tongdaoid;
            $i ++;
        }
        
        $tjdate_ks = I("get.tjdate_ks");
        if ($tjdate_ks) {
            $where[$i] = " DATEDIFF('" . $tjdate_ks . "',datetime) <= 0";
            ;
            $i ++;
        }
        
        $tjdate_js = I("get.tjdate_js");
        if ($tjdate_js) {
            $where[$i] = " DATEDIFF('" . $tjdate_js . "',datetime) >= 0";
            ;
            $i ++;
        }
        
        $bank = I("get.bank");
        if ($bank) {
            $where[$i] = "lx = " . $bank;
            $i ++;
        }
        $list = $this->lists("Moneychange", $where);
        $this->assign("list", $list);
        $this->display();
    }
}
?>
