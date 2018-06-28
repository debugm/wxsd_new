<?php
namespace User\Controller;

class IndexController extends UserController
{

    public function __construct()
    {
        parent::__construct();
        $Userverifyinfo = M("Userverifyinfo");
        $rzstatus = $Userverifyinfo->where("userid=" . session("userid"))->getField("status");
        $this->assign("rzstatus", $rzstatus);
        $this->assign("Public", MODULE_NAME); // 模块名称
    }

    public function index()
    {
        $this->display();
    }

    public function defaultindex()
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
            ->where("en_payname in (" . $strarray . ") and mode=0")
            ->select();
        $apimoneylist = array();
        $i = 0;
        $Apimoney = M("Apimoney");
        foreach ($apimoneyarray as $key) {
            $find = $Apimoney->where("payapiid=" . $key["id"] . " and userid=" . session("userid"))->find();
            if (! $find) {
                $data = array();
                $data["userid"] = session("userid");
                $data["payapiid"] = $key["id"];
                $Apimoney->add($data);
                $find = $Apimoney->where("payapiid=" . $key["id"] . " and userid=" . session("userid"))->find();
            }
            $apimoneylist[$i]["id"] = $key["id"];
            $apimoneylist[$i]["zh_payname"] = $key["zh_payname"];
            $apimoneylist[$i]['en_payname'] = $key['en_payname'];
            $apimoneylist[$i]["money"] = $find["money"];
            $apimoneylist[$i]["freezemoney"] = $find["freezemoney"];
            $apimoneylist[$i]["status"] = $find["status"];
            $i ++;
        }

        //md5key
        $md5key = M('Userverifyinfo')->where(array('userid'=>session('userid')))->getField('md5key');

        $this->assign('md5key',$md5key);
        $this->assign("SumMoney", $SumMoney);
        $this->assign("Sumfreezemoney", $Sumfreezemoney);
        $this->assign("apimoneylist", $apimoneylist);
        $this->assign("wallet", $wallet);
        
        // ///////////////////////////公告////////////////////////////////////////
        $Articleclass = M("Articleclass");
        $articleclassid = $Articleclass->where("classname='公告'")->getField("id");
        $Article = M("Article");
        $gglist = $Article->where("articleclassid=" . $articleclassid . " and status = 0 and (jieshouuserlist='0|' or jieshouuserlist like '%" . session("userid") . "|%')")
            ->limit(3)
            ->order("datetime desc")
            ->select();
        $this->assign("gglist", $gglist);
        // ///////////////////////////公告////////////////////////////////////////
        // ///////////////////////资金变动记录/////////////////////////////////////
        $Moneychange = M("Moneychange");
        $zjbdlist = $Moneychange->where("userid=" . session("userid"))
            ->limit(10)
            ->select();
        $this->assign("zjbdlist", $zjbdlist);
        // ///////////////////////资金变动记录/////////////////////////////////////
        $this->display();
    }

    public function quit()
    {
        header('Content-type:text/html;charset=utf-8');
        cookie("userid", null);
        cookie("usertype", null);
        session(null);
        header("refresh:3;url=/");
        exit('<div style="width:500px; height:auto; margin:0px auto; margin-top:100px; text-align:center;"><img src="/Public/User/images/exit.jpg"><br>正在退出登录中......</div>');
    }

    public function showcontent()
    {
        $id = I("get.id");
        $Article = M("Article");
        $find = $Article->where("id=" . $id)->find();
        $this->assign("find", $find);
        $Browserecord = M("Browserecord");
        $data = array();
        $data["articleid"] = $id;
        $data["userid"] = session("userid");
        $data["datetime"] = date("Y-m-d H:i:s");
        $Browserecord->add($data);
        $this->display();
    }

    public function gonggao()
    {
        $Articleclass = M("Articleclass");
        $articleclassid = $Articleclass->where("classname='公告'")->getField("id");
        // $Article = M("Article");
        $where = array();
        $where[0] = "articleclassid=" . $articleclassid . " and status = 0 and (jieshouuserlist='0|' or jieshouuserlist like '%" . session("userid") . "|%')";
        // $gglist = $Article->where("articleclassid=".$articleclassid." and status = 0 and (jieshouuserlist='0|' or jieshouuserlist like '%".session("userid")."|%')")->limit(5)->order("datetime desc")->select();
        $list = $this->lists("Article", $where, "datetime desc");
        $this->assign("list", $list);
        $this->display();
    }
}
