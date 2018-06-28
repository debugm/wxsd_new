<?php
namespace User\Controller;
use Think\Page;

class DailiController extends UserController
{

   
    
    public function tcjl()
    {
        $where = array();
	
	$where['userid'] = session("userid");

	$where['lx'] = 9;

	$list = $this->lists("moneychange", $where);
	$this->assign("list", $list);
        $this->display();

    }

    public function invitecode()
    {
        $where = array();
        $i = 0;
        $invitecodesearch = I("get.invitecodesearch", "");
        $syusernamesearch = I("get.syusernamesearch", "");
        $regtypesearch = I("get.regtypesearch", 0);
        $ztsearch = I("get.ztsearch", "");
        $where[$i] = "fmusernameid = " . session("userid");
        // echo $where[$i];
        $i = $i + 1;
        $where[$i] = "regtype = 4";
        $i = $i + 1;
        if ($invitecodesearch != "") {
            $where[$i] = "invitecode like '%" . $invitecodesearch . "%'";
            $i = $i + 1;
        }
        
        if ($syusernamesearch != "") {
            $User = M("User");
            $syusernameid = $User->where("username = '" . $syusernamesearch . "'")->getField("id");
            
            $where[$i] = "syusernameid = " . $syusernameid;
            
            $i = $i + 1;
        }
        
        if ($ztsearch != "") {
            $where[$i] = "inviteconfigzt = " . $ztsearch;
            
            $i = $i + 1;
        }
        
        $list = $this->lists("Invitecode", $where);
        
        // $list = $Invitecode->order("fbdatetime desc")->select();
        
        $this->assign("list", $list);
        
        $this->display();
    }

    public function createinvite()
    {
        $invitecode = $this->create_invite();
        
        exit($invitecode);
    }

    private function create_invite()
    {
        $invitecodestr = random_str(30);
        
        $Invitecode = M("Invitecode");
        
        $id = $Invitecode->where("invitecode = '" . $invitecodestr . "'")->getField("id");
        
        if (! $id) {
            return $invitecodestr;
        } else {
            $this->create_invite();
        }
    }

    public function addinvitecode()
    {
        if(IS_POST){
            $Inviteconfig = M('Inviteconfig');
            $_inviteconfig = $Inviteconfig->where('id=1')->find();
            $invitezt = $_inviteconfig['invitezt'];
            $invitetype5number = $_inviteconfig["invitetype5number"];
            if (!$invitezt) {
                exit("no");
            } else {
                $Invitecode = M("Invitecode");
                $tjcount = $Invitecode->where("fmusernameid=" . session("userid"))->count();
                if ($invitetype5number < $tjcount) {
                    exit("no");
                }
            }

            $Invitecode = M("Invitecode");
            $data = array();
            $data["fmusernameid"] = session("userid");
            $data["inviteconfigzt"] = 1;
            $data["fbdatetime"] = time();
            $data["invitecode"] = I("post.invitecode");
            $data["yxdatetime"] = strtotime(I("post.yxdatetime"));
            $data["regtype"] = I("post.regtype");
            $Invitecode->add($data);

            $this->ajaxReturn('ok');
        }
    }

    public function delinvitecode()
    {
        $delid = I("post.delid");
        
        $Invitecode = M("Invitecode");
        
        $type = $Invitecode->where("id in (" . $delid . ")")->delete();
        if ($type) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function usercontrol()
    {
        $where = array();
        $i = 0;
        $where[$i] = "usertype = 4";
        $i = $i + 1;
        $where[$i] = "superioruserid = " . session("userid");
        if ($usernameidsearch = I("get.usernameidsearch")) {
            $i = $i + 1;
            $where[$i] = "(id = " . (intval($usernameidsearch) - 10000) . " or username like '%" . $usernameidsearch . "%')";
        }
        $statussearch = I("get.statussearch");
        if ($statussearch != "") {
            $i = $i + 1;
            $where[$i] = "status = " . $statussearch;
        }
        
        $rzsearch = I("get.rzsearch");
        if ($rzsearch != "") {
            $i = $i + 1;
            $listid = "0";
            $Userverifyinfo = M("Userverifyinfo");
            $list = $Userverifyinfo->where("status = " . $rzsearch)->getField("userid", true);
            foreach ($list as $key => $val) {
                $listid = $listid . "," . $val;
            }
            $where[$i] = "id in (" . $listid . ")";
        }
        
        if ($sjusernamesearch = I("get.sjusernamesearch")) {
            $i = $i + 1;
            $User = M("User");
            $sjuserid = $User->where("id = " . (intval($sjusernamesearch) - 10000) . " or username like '%" . $sjusernamesearch . "%'")->getField("id");
            $where[$i] = "superioruserid = " . $sjuserid;
        }
        
        $list = $this->lists("User", $where);
        $this->assign("list", $list);
        
        $Payapiconfig = M("Payapiconfig");
        $disabledpayapiid = $Payapiconfig->field('payapiid')
            ->where("disabled=0")
            ->select(false);
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->where("id not in (" . $disabledpayapiid . ")")->select();
        $this->assign("tongdaolist", $tongdaolist);
        
        $this->display();
    }


    //下级费率
    public function setfeilv()
    {
        $userid = I('get.uid',0,'intval');
        if(IS_POST){
            $_formdata = I('post.feilv');
	    //先获取上级代理的费率
	    $super = M('User')->where("id=".$userid)->find();
	    $sid = $super['superioruserid'];
            if($_formdata){
                foreach ($_formdata as $key=>$value) {
		    $td = M('Userpayapizhanghao')->where(array('id'=>$key))->find();
                    $tdid = $td['payapiid'];
                    $s = M('Userpayapizhanghao')->where(array('userid'=>$sid,'payapiid'=>$tdid))->find();
		    if($s)
		    {
			$s_feilv = floatval($s['feilv']);
			$s_traffic = floatval($s['traffic']);
			if(floatval($value[0]) < $s_feilv || floatval($value[1]) < $s_traffic)
			{
			    $this->error("不允许的操作");

			}
			else

 	                   M('Userpayapizhanghao')->where(array('id'=>$key))->save(array('feilv'=>$value[0],'traffic'=>$value[1]));
		    }
                }
            }
            $this->success('修改成功！');
        }else{
	    /*
            $Payapiconfig = M("Payapiconfig");
            $payapiidstr = $Payapiconfig->field("payapiid")
                ->where("disabled=1")
                ->select(false);
            $Payapi = M("Payapi");
            $listlist = $Payapi->where("id in (" . $payapiidstr . ")")->select();
	    */
	    
	    $userpayapi = M("Userpayapi")->where("userid=".$userid)->find();
	    $userpayapi_str = $userpayapi['payapicontent'];
	    $arr = explode("|",$userpayapi_str);
	    $listlist = array();
            $Payapi = M("Payapi");
	    foreach($arr as $k=>$v)
	    {
	
	    	$listlist[] = $Payapi->where(array('en_payname' => $v))->find();
	    }
            $_tmparray = array();
            foreach ($listlist as $key=>$value) {
                $_zhanghao = array();
                $val = $val2 = '';
                $Userpayapizhanghao = M("Userpayapizhanghao");
                $_zhanghao = $Userpayapizhanghao->where(array('userid'=>$userid,'payapiid'=>$value["id"]))->find();
                if($_zhanghao){
                    $val = $_zhanghao['feilv'];
                    $val2 = $_zhanghao['traffic'];
                    $Payapiaccount = M("Payapiaccount");
		    /*
                    if (! $val) {
                        $val = $Payapiaccount->where("payapiid=" . $key["id"] . " and defaultpayapiuser=1")->getField("defaultrate");
                    }
                    if (! $val2) {
                        $val2 = $Payapiaccount->where("payapiid=" . $key["id"] . " and defaultpayapiuser=1")->getField("fengding");
                    }
		    */
                    $_tmparray[] = array('id'=>$_zhanghao['id'],'en_payname'=>$value['en_payname'],'feilv'=>$val,'fengding'=>$val2,'zh_payname'=>$value['zh_payname']);
                }
            }
            $this->assign('data',$_tmparray);
            $this->display();
        }
    }

    //下级流水
    public function childord()
    {
        $userid = I('get.userid');
        $data = array();
        if($userid){
            $count = M('Order')->where(array('pay_memberid'=>$userid+10000))->count();
            $Page = new Page($count,10);
            $data = M('Order')->where(array('pay_memberid'=>$userid+10000))->limit($Page->firstRow.','.$Page->listRows)->select();
            $show = $Page->show();
        }
        $this->assign('list',$data);
        $this->assign('page',$show);
        $this->display();
    }
}
?>
