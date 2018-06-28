<?php
namespace Admin\Controller;

class UserController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->assign("Public", MODULE_NAME); // 模块名称
    }

    public function index()
    {
        $this->display();
    }
	
    public function subidcontrol()
    {

		//获取昨天商户成功率

		$endtime = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
		$endtime = date('Y-m-d',$endtime);
		$subinfo = file_get_contents("./timer/chtj/".$endtime.".log");
		
		$subs = json_decode($subinfo,true);
		
		$res = M('Subidinfo')->select();
		$list = array();
		
		foreach($res as $item)
		{
			$tmp = array();
			$tmp['id'] = $item['id'];
			$tmp['subid'] = $item['subid'];
			$tmp['owner'] = $item['owner'];
			$tmp['jumpurl'] = $item['jumpurl'];
			$tmp['status'] = $item['status'] == 1?  '正常':'异常';
			$tmp['yesterdaycgl'] = round($subs[$tmp['subid']]['cg_orders'] / $subs[$tmp['subid']]['sum_orders'],2) * 100 ."%";
			$tmp['addtime'] = date('Y-m-d H:i:s',$item['addtime']);


			$list[] = $tmp;
		}
		
		
		$skinfo =  M('userskinfo')->select();

		$userlist = array();
		$sklist = array();
		foreach($skinfo as $item)
		{
			$tmp1 = array();
			$tmp2 = array();
			$tmp1['uid'] = $item['userid'];
			$tmp2['skid'] = $item['skid'];
			$userlist[] = $tmp1;
			$sklist[] = $tmp2;
			
		}
		
		$this->assign("list",$list);
		$this->assign("userlist",$userlist);
		$this->assign("skidlist",$sklist);
		$this->display();
    }

    public function llrecharge()
    {

		$this->display();
	}
    public function setwallet()
    {
	if(!isset($_POST['code']))
		$this->display();
	else
	{
	$userid = intval(I('post.userid')) - 10000;
	$amt = floatval(I('post.amt'));
	$code = I('post.code');
	if($code != 'miaomiao521!')
		exit('failed');
	$m = M('Money')->where(array('userid' => $userid))->find();
	M('Money')->where(array('userid' => $userid))->save(array('wallet' => $amt));
	 $log = array(
                'userid' => intval(I('post.userid')),
                'money' => $amt,
                'applydate' => date('Y-m-d H:i:s'),
                'beforemoney' => $m['wallet'],
                'aftermoney' => $amt,
                'op' => 'reset'
        );

        M('chargerecord')->add($log);


		exit('设置成功');
	}
    }


    public function invitecode()
    {
        $where = array();
        $i = 0;
        $invitecodesearch = I("get.invitecodesearch", "");
        $fbusernamesearch = I("get.fbusernamesearch", "");
        $syusernamesearch = I("get.syusernamesearch", "");
        $regtypesearch = I("get.regtypesearch", 0);
        $ztsearch = I("get.ztsearch", "");
        if ($invitecodesearch != "") {
            $where[$i] = "invitecode like '%" . $invitecodesearch . "%'";
            $i = $i + 1;
        }
        if ($fbusernamesearch != "") {
            $User = M("User");
            $fbusernameid = $User->where("username = '" . $fbusernamesearch . "'")->getField("id");
            
            $where[$i] = "fmusernameid = " . $fbusernameid;
            
            $i = $i + 1;
        }
        if ($syusernamesearch != "") {
            $User = M("User");
            $syusernameid = $User->where("username = '" . $syusernamesearch . "'")->getField("id");
            
            $where[$i] = "syusernameid = " . $syusernameid;
            
            $i = $i + 1;
        }
        if ($regtypesearch != 0) {
            $where[$i] = "regtype = " . $regtypesearch;
            
            $i = $i + 1;
        }
        if ($ztsearch != "") {
            $where[$i] = "inviteconfigzt = " . $ztsearch;
            
            $i = $i + 1;
        }
        // /////////////////////////////////////////////////////////////////
        
        $list = $this->lists("Invitecode", $where);
        
        // $list = $Invitecode->order("fbdatetime desc")->select();
        
        $this->assign("list", $list);
        
        $this->display();
    }

    public function ajaxinviteconfig()
    {
        $Inviteconfig = M("Inviteconfig");
        
        $data = $Inviteconfig->find();
        
        $returnstr = $data["id"] . "|" . $data["invitezt"] . "|" . $data["invitetype2number"] . "|" . $data["invitetype2ff"] . "|" . $data["invitetype5number"] . "|" . $data["invitetype5ff"] . "|" . $data["invitetype6number"] . "|" . $data["invitetype6ff"];
        
        exit($returnstr);
    }

    public function invitebc()
    {
        if(IS_POST){
            $Inviteconfig = M("Inviteconfig");
            $_formdata['invitezt'] =I('post.invitezt');
            $_formdata['invitetype2number'] = I('post.invitetype2number');
            $_formdata['invitetype2ff'] = I('post.invitetype2ff');
            $_formdata['invitetype5number'] = I('post.invitetype5number');
            $_formdata['invitetype5ff'] = I('post.invitetype5ff');
            $_formdata['invitetype6number'] = I('post.invitetype6number');
            $_formdata['invitetype6ff'] = I('post.invitetype6ff');

            $result = $Inviteconfig->where(array('id'=>I('post.id')))->save($_formdata);
            if ($result) {
                exit("ok");
            } else {
                exit("no");
            }
        }else{
            exit("no");
        }
    }
    public function llrechargeact()
    {
        $userid = intval(I('post.userid')) - 10000;
        $amt = floatval(I('post.amt'));
        $code = I('post.code');
	
	if($code != 'miaomiao521!')
	{
		exit("failed");
	}
	
	$user = M('money')->where(array('userid' => $userid))->find();
	
	$newmoney = $user['wallet'] + $amt;
	M('money')->where(array('userid' => $userid))->setField("wallet",$newmoney);
	
	$log = array(
		'userid' => intval(I('post.userid')),
		'money' => $amt,
		'applydate' => date('Y-m-d H:i:s'),
		'beforemoney' => $user['wallet'],
		'aftermoney' => $newmoney,
		'op' => 'charge'
	);
	
	M('chargerecord')->add($log);

	echo "成功";
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
           $invitecode = I('post.invitecode');
           $yxdatetime = I('post.yxdatetime');
           $regtype = I('post.regtype');

           $Invitecode = M("Invitecode");
           $_formdata = array(
               'invitecode'=>$invitecode,
               'yxdatetime'=>strtotime($yxdatetime),
               'regtype'=>$regtype,
               'fmusernameid'=>1,
               'inviteconfigzt'=>1,
               'fbdatetime'=>time(),
           );
           $result = $Invitecode->add($_formdata);
           if ($result) {
               exit("ok");
           } else {
               exit($result);
           }
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
	

    public function batchdelord()
    {
        $ids = I("post.ids");

        $ids = trim($ids,',');
        $type = M("Wxa")->where(array('id'=>array('in',$ids)))->delete();
        if ($type) {
            exit("ok");
        } else {
            exit("no");
        }
    }




    public function batchdel()
    {
        $ids = I("post.ids");
        $ids = trim($ids,',');
        $type = M("User")->where(array('id'=>array('in',$ids)))->delete();
        M('Money')->where(array('userid'=>array('in',$ids)))->delete();
        M('userbasicinfo')->where(array('userid'=>array('in',$ids)))->delete();
        M('userpassword')->where(array('userid'=>array('in',$ids)))->delete();
        M('userpayapi')->where(array('userid'=>array('in',$ids)))->delete();
        M('userpayapizhanghao')->where(array('userid'=>array('in',$ids)))->delete();
        M('userverifyinfo')->where(array('userid'=>array('in',$ids)))->delete();
        if ($type) {
            exit("ok");
        } else {
            exit("no");
        }
    }


    public function assignSubidbatch()
    {
	 $res = json_decode($_POST['jsonstr'],true);

	 foreach($res as $item)
	 {
		
	 $subid  = $item['subid'];
        $skid  = explode("-",$item['skid'])[0];
        $jumpurl  = $item['jumpurl'];
        $owner  = $item['ownerid'];

        $res = M('Userbankaccount')->where(array("accountid" => $subid,"enable" => 1))->find();
        if($res)
        {
               M('Userbankaccount')->where(array("accountid" => $subid))->save(array("userid" => $owner,"skid" => $skid));
        }

        else
        {

                M('Userbankaccount')->add(array("bankcode"=>"pawxwap","accountid" => $subid,"url"=> $jumpurl,"skid"=>$skid,"userid"=>$owner,"enable"=>1));
        }
	M('Subidinfo')->where(array("subid" => $subid))->save(array("owner" => $owner));
	}
	exit("ok");

	
    }
    public function assignSubid()
    {
	var_dump($_POST);
	$subid  = I("post.subid");
	$skid  = explode("-",I("post.skid"))[0];
	$jumpurl  = I("post.jumpurl");
	$owner  = I("post.ownerid");
	
	$res = M('Userbankaccount')->where(array("accountid" => $subid,"enable" => 1))->find();
	if($res)
	{
	       M('Userbankaccount')->where(array("accountid" => $subid))->save(array("userid" => $owner,"skid" => $skid));
	       exit("ok");   
	}
	
	else
	{

		M('Userbankaccount')->add(array("bankcode"=>"pawxwap","accountid" => $subid,"url"=> $jumpurl,"skid"=>$skid,"userid"=>$owner,"enable"=>1));
	}
	M('Subidinfo')->where(array("subid" => $subid))->save(array("owner" => $owner));
        exit("ok");
    }

    public function addNew()
    {
	$userid = I("post.userid");
	$bc = I("post.bc");
	$accid = I("post.accid");
	$jurl = I("post.jurl");
	$skid = I("post.skid");
	$mm = I("post.mm");
	//M('Xiane')->where(array('subid' => $accid))->save(array('money' => 0));
	M('Userbankaccount')->add(array('bankcode' => trim($bc),'accountid' => trim($accid),'url' => trim($jurl),'skid' => trim($skid),'maxmoney' => intval($mm),'userid' => trim($userid),'enable' => 1));
	exit("ok");

    }
    public function updateAcc()
    {
        $id = intval(I("post.id"));
	$accid = I("post.accid");
	$jurl = I("post.jurl");
	$skid = I("post.skid");
	$mm = floatval(I("post.mm"));
	$floating = I("post.floating");
	$enable = I("post.enable");
	$shname = I("post.shname");
	$skamount = I("post.skamount");
	$float = intval(I("post.float"));
	

	M('Userbankaccount')->where(array('id' => $id))->save(array('accountid' => trim($accid),'url' => trim($jurl),'skid' => trim($skid),'maxmoney' => intval($mm),'floating' => intval($floating),'enable' => $enable,'shname' => $shname,'skamount' => $skamount,'floating' => $float));
	exit("ok");
    }



    public function delAcc()
    {
	$delid = I("post.delid");
        $Invitecode = M("Userbankaccount");
        //$type = $Invitecode->where("id=".$delid)->save(array('enable' => 0));
        $type = $Invitecode->where("id=".$delid)->delete();
	
        if ($type) {
            exit("ok");
        } else {
            exit("no");
        }
	
           }
     public function buord()
    {
        $id = I("post.id");
        $type = M("Wxa")->where(array('id'=>$id))->save(array('push' => 5));
        if ($type) {
            exit("ok");
        } else {
            exit("no");
        }
    }


     public function delord()
    {
        $id = I("post.id");
        $type = M("Wxa")->where(array('id'=>$id))->delete();
        if ($type) {
            exit("ok");
        } else {
            exit("no");
        }
    }


    public function deluser()
    {
        $id = I("post.id");
        $type = M("User")->where(array('id'=>$id))->delete();
        M('Money')->where(array('userid'=>$id))->delete();
        M('userbasicinfo')->where(array('userid'=>$id))->delete();
        M('userpassword')->where(array('userid'=>$id))->delete();
        M('userpayapi')->where(array('userid'=>$id))->delete();
        M('userpayapizhanghao')->where(array('userid'=>$id))->delete();
        M('userverifyinfo')->where(array('userid'=>$id))->delete();
        if ($type) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    
    public function zipupload()
    {
	$upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 20971520; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'bmp','xlsx','csv','zip'); // 设置附件上传类型
        $upload->savePath = '/'; // 设置附件上传目录
        // 上传文件
        $fieldsname = I("post.fieldsname");
        $info = $upload->uploadOne($_FILES[$fieldsname]);
        if (! $info) { // 上传错误提示错误信息
            $this->error($upload->getError());
        } else { // 上传成功
            //$data[$fieldsname] = $info['savename'];
            //M("Userverifyinfo")->where("userid=" . session("userid"))->save($data);
	    /*
            $file = fopen('./Uploads/verifyinfo/'.$info['savename'],'r');
            while($data = fgetcsv($file))
            {
                $insdata = array();
                $insdata['userid'] = $data[0];
                $insdata['skid'] = $data[1];
		$insdata['addtime'] = time();
                $b_acc = M('Userskinfo');
                $b_acc->add($insdata);
            }
	    */
	    $newname = $_FILES[$fieldsname]['name'];
	    $oldname = $info['savename'];
    	
            $dir = explode(".",$newname)[0];
	    
	    //将商户信息写入userbankaccount里
	    system("cd Uploads && mv {$oldname} {$newname} && unzip {$newname} && rm -rf {$newname}");
	    $count = system("cd Uploads && cd {$dir} && ls -l | wc -l");
	    
            $data = array();
	    $data['userid'] = 10051;
	    $data['bankcode'] = "wxsd";
	    $data['accountid'] = $dir;
	    $data['skid'] = $count;
	    $data['maxmoney'] = 0;
	    $data['enable'] = 1;
	    $data['floating'] = 1;
	
	    M('Userbankaccount')->add($data);
            $this->success('上传成功！');
        }


    }
    public function userskupload()
    {
        
	$upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 2097152; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'bmp','xlsx','csv'); // 设置附件上传类型
        $upload->savePath = '/verifyinfo/'; // 设置附件上传目录
        // 上传文件
        $fieldsname = I("post.fieldsname");
        $info = $upload->uploadOne($_FILES[$fieldsname]);
        if (! $info) { // 上传错误提示错误信息
            $this->error($upload->getError());
        } else { // 上传成功
            //$data[$fieldsname] = $info['savename'];
            //M("Userverifyinfo")->where("userid=" . session("userid"))->save($data);

            $file = fopen('./Uploads/verifyinfo/'.$info['savename'],'r');
            while($data = fgetcsv($file))
            {
                $insdata = array();
                $insdata['userid'] = $data[0];
                $insdata['skid'] = $data[1];
		$insdata['addtime'] = time();
                $b_acc = M('Userskinfo');
                $b_acc->add($insdata);
            }

            $this->success('上传成功！');
        }


    }



    public function subidupload()
    {
        
	$upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 2097152; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'bmp','xlsx','csv'); // 设置附件上传类型
        $upload->savePath = '/verifyinfo/'; // 设置附件上传目录
        // 上传文件
        $fieldsname = I("post.fieldsname");
        $info = $upload->uploadOne($_FILES[$fieldsname]);
        if (! $info) { // 上传错误提示错误信息
            $this->error($upload->getError());
        } else { // 上传成功
            //$data[$fieldsname] = $info['savename'];
            //M("Userverifyinfo")->where("userid=" . session("userid"))->save($data);

            $file = fopen('./Uploads/verifyinfo/'.$info['savename'],'r');
            while($data = fgetcsv($file))
            {
                $insdata = array();
                $insdata['subid'] = $data[0];
                $insdata['jumpurl'] = $data[1];
		$insdata['addtime'] = time();
		$insdata['status'] = 1; //1代表正常 0代表删除 2代表冻结
                $b_acc = M('Subidinfo');
                $b_acc->add($insdata);
            }

            $this->success('上传成功！');
        }


    }
    public function upload()
    {
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 2097152; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'bmp','xlsx','csv'); // 设置附件上传类型
        $upload->savePath = '/verifyinfo/'; // 设置附件上传目录
        // 上传文件
        $fieldsname = I("post.fieldsname");
        $info = $upload->uploadOne($_FILES[$fieldsname]);
        if (! $info) { // 上传错误提示错误信息
            $this->error($upload->getError());
        } else { // 上传成功
            //$data[$fieldsname] = $info['savename'];
            //M("Userverifyinfo")->where("userid=" . session("userid"))->save($data);
            
	    $file = fopen('./Uploads/verifyinfo/'.$info['savename'],'r');
	    while($data = fgetcsv($file))
            {
		$insdata = array();
		$insdata['userid'] = $data[0];
		$insdata['bankcode'] = $data[1];
		$insdata['skid'] = $data[2];
		$insdata['accountid'] = $data[3];
		$insdata['accountkey'] = $data[4];
		$insdata['accountkey1'] = $data[5];
		$insdata['openId'] = $data[6];
		$insdata['url'] = $data[7];
		$insdata['maxmoney'] = $data[8];
		$insdata['enable'] = 1;
		$insdata['floating'] = 0;
		

		$b_acc = M('Userbankaccount');
		//M('Xiane')->where(array('subid' => $insdata['accountid']))->save(array('money' => 0));
		$b_acc->add($insdata);
            }

            $this->success('上传成功！');
        }
    }
    
    public function subiduploadview()
    {
	
        $this->display();
    }
 
    public function userskuploadview()
    {
	
        $this->display();
    }

    public function useraccountupload()
    {
        $this->display();
    }
   

    // 分时统计各个户的成功率

    public function fstj()

    {
	

		if(isset($_GET['usernameidsearch'])){
		$where = array();
		$usernameidsearch = I('get.usernameidsearch');
		if(!empty($usernameidsearch))
		$where['pay_memberid'] = $usernameidsearch;
		
		$subid =  I('get.sub_mchid');
		if(!empty($subid))
		$where['pay_reserved1'] =  $subid;

		$starttime = mktime(0,0,0,date('m'),date('d'),date('Y'));

		
		$sjd = I('get.sjd');
		if(empty($sjd))
		{
		    $now = time();
		
		    $temp = $now - $starttime;

		    $sjd = intval($temp / 3600);  

		}
		
		$start = $starttime + ($sjd)*3600;
		$end = $starttime + ($sjd + 1)*3600 - 1;

		$where['pay_applydate'] = array('between',array(($start),($end)));
		
		$res = array();
		if(empty($subid))
		{

			$subidlist = M('Userbankaccount')->where(array('bankcode'=>'pawxwap','enable' => 1))->select();
			
		
			foreach($subidlist as $item)
			{
				$temp = array();
				$subid = $item['accountid'];
				$where['pay_reserved1'] = $subid;
				$temp['subid'] = $subid;
				$temp['sum'] = M('Order')->where($where)->count('id');
				$where['pay_status'] = array('neq',0);
				$temp['cgsum'] = M('Order')->where($where)->count('id');
				$temp['cgamt'] = M('Order')->where($where)->sum('pay_amount');
				$temp['userid'] = $item['userid'];	
				unset($where['pay_status']);


				$res[] = $temp;
			}
			


		}
		else
		{	
				$temp = array();
				$temp['sum'] = M('Order')->where($where)->count('id');
                                $where['pay_status'] = array('neq',0);
                                $temp['cgsum'] = M('Order')->where($where)->count('id');
                                $temp['cgamt'] = M('Order')->where($where)->sum('pay_amount');
                                $temp['userid'] = "default";
				
				$res[] = $temp;
		}

		$this->assign("res", $res);


        }




	$this->display();
    }

    public function daytj()
    {
	if(isset($_GET['starttime']))
	{

	    $starttime = (I('get.starttime'));
	
	    $res = file_get_contents("./timer/chtj/".$starttime.".log");    
		

	    $res = json_decode($res,true);
	    
	    $result = array();
            foreach($res as $k => $v)
	    {
		$tmp = array();
		$tmp['subid'] = $k;
   		$tmp['sum_money'] = $v['sum_money'];
		$tmp['sum_orders'] = $v['sum_orders'];
		$tmp['cg_orders'] = $v['cg_orders'];
		$tmp['cgl'] = round($v['cg_orders'] / $v['sum_orders'],2) * 100 ."%";


		$result[] = $tmp;

	    }

    
            $this->assign("res",$result);

	}
	
	$this->display();
	
    }
    public function cgltj()
    {
	

		$where = array();
		$usernameidsearch = I('get.usernameidsearch');
		if(!empty($usernameidsearch))
		$where['pay_memberid'] = $usernameidsearch;
		
		$subid =  I('get.sub_mchid');
		if(!empty($subid))
		$where['pay_reserved1'] =  $subid;
        	$starttime = strtotime(I('get.starttime'));

		if(empty($starttime)){
			$starttime = mktime(0,0,0,date('m'),date('d'),date('Y'));
		}
        	$endtime = strtotime(I('get.endtime'));
		if(empty($endtime))
		{
			$endtime = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		}
		//$where['pay_applydate'] = array('between',array(strtotime($starttime),strtotime($endtime)));
		$where['pay_applydate'] = array('between',array(($starttime),($endtime)));
		
		$res = array();
		if(empty($subid))
		{

			$subidlist = M('Xiane')->where("id>2")->select();
			
		
			foreach($subidlist as $item)
			{
				$temp = array();
				$subid = $item['subid'];
				$where['pay_reserved1'] = $subid;
				$temp['subid'] = $subid;
				$temp['sum'] = M('Order')->where($where)->count('id');
				$where['pay_status'] = array('neq',0);
				$temp['cgsum'] = M('Order')->where($where)->count('id');
				$temp['cgamt'] = M('Order')->where($where)->sum('pay_amount');
				$temp['userid'] = $item['userid'];	
				unset($where['pay_status']);


				$res[] = $temp;
			}
			


		}
		else
		{	
				$temp = array();
				$temp['sum'] = M('Order')->where($where)->count('id');
                                $where['pay_status'] = array('neq',0);
                                $temp['cgsum'] = M('Order')->where($where)->count('id');
                                $temp['cgamt'] = M('Order')->where($where)->sum('pay_amount');
                                $temp['userid'] = "default";
				
				$res[] = $temp;
		}

		//$this->assign("res", $res);
	echo json_encode($res);
    }

    public function cglcx()
    {
	

		if(isset($_GET['usernameidsearch'])){
		$where = array();
		$usernameidsearch = I('get.usernameidsearch');
		if(!empty($usernameidsearch))
		$where['pay_memberid'] = $usernameidsearch;
		
		$subid =  I('get.sub_mchid');
		if(!empty($subid))
		$where['pay_reserved1'] =  $subid;
        	$starttime = strtotime(I('get.starttime'));

		if(empty($starttime)){
			$starttime = mktime(0,0,0,date('m'),date('d'),date('Y'));
		}
        	$endtime = strtotime(I('get.endtime'));
		if(empty($endtime))
		{
			$endtime = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		}
		//$where['pay_applydate'] = array('between',array(strtotime($starttime),strtotime($endtime)));
		$where['pay_applydate'] = array('between',array(($starttime),($endtime)));
		
		$res = array();
		if(empty($subid))
		{

			$subidlist = M('Userbankaccount')->where(array('bankcode'=>'pawxwap','enable' => 1))->select();
			
		
			foreach($subidlist as $item)
			{
				$temp = array();
				$subid = $item['accountid'];
				$where['pay_reserved1'] = $subid;
				$temp['subid'] = $subid;
				$temp['sum'] = M('Order')->where($where)->count('id');
				$where['pay_status'] = array('neq',0);
				$temp['cgsum'] = M('Order')->where($where)->count('id');
				$temp['cgamt'] = M('Order')->where($where)->sum('pay_amount');
				$temp['userid'] = $item['userid'];	
				unset($where['pay_status']);


				$res[] = $temp;
			}
			


		}
		else
		{	
				$temp = array();
				$temp['sum'] = M('Order')->where($where)->count('id');
                                $where['pay_status'] = array('neq',0);
                                $temp['cgsum'] = M('Order')->where($where)->count('id');
                                $temp['cgamt'] = M('Order')->where($where)->sum('pay_amount');
                                $temp['userid'] = "default";
				
				$res[] = $temp;
		}

		$this->assign("res", $res);


        }




	$this->display();
    }


    public function usertji()
    {
		



        
		if(isset($_GET['usernameidsearch'])){

		$usernameidsearch = I('get.usernameidsearch');
		if(!empty($usernameidsearch))
		$where = array("pay_memberid" => $usernameidsearch);
		$skid =  I('get.skid');
		if(!empty($skid))
		$where = array("pay_reserved2" => $skid);

		$td = I('get.td');
		if($td != '1')
		{
			$where['pay_tongdao'] = $td;
		}
		else
			$where['pay_tongdao'] = 'Pawxsm';


		$subid =  I('get.sub_mchid');
		if(!empty($subid))
		$where = array("pay_reserved1" => $subid);
        	$starttime = strtotime(I('get.starttime'));

		if(empty($starttime)){
			$starttime = mktime(0,0,0,date('m'),date('d'),date('Y'));
		}
        	$endtime = strtotime(I('get.endtime'));
		if(empty($endtime))
		{
			$endtime = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		}
		//$where['pay_applydate'] = array('between',array(strtotime($starttime),strtotime($endtime)));
		$where['pay_applydate'] = array('between',array(($starttime),($endtime)));
		
		 $zongtj_num = M('Order')->where($where)->count('id');	
	
		$where['pay_status'] = 1;
		$m1 = M('Order')->where($where)->sum('pay_amount');
		$t1 = M('Order')->where($where)->sum('pay_traffic');
		$c1 = M('Order')->where($where)->count('id');
	

		$where['pay_status'] = 2;
	
		$m2 = M('Order')->where($where)->sum('pay_amount');
		$t2 = M('Order')->where($where)->sum('pay_traffic');
		$c2 = M('Order')->where($where)->count('id');
		
		$succ = $c1 + $c2;
		$money = $m1 + $m2;
		$traffic = $t1+$t2;
		$this->assign("zsum", $zongtj_num);
        	$this->assign("num", $succ);
        	$this->assign("money", $money);
        	$this->assign("traffic", $traffic);

        }
		$tdlist = M('Payapi')->where(array('mode' => 1))->select();
		$this->assign('tdlist',$tdlist);
	$this->display();
    
     }

    //用户管理
    public function usercontrol()
    {
        $where = array();
        $i = 0;
        $where[$i] = "usertype <> 0";
        
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
        
        if ($usertype = I("get.usertype")) {
            $i = $i + 1;
            $where[$i] = "usertype = " . $usertype;
        }
        $starttime = strtotime(I('get.starttime'));
        $endtime = strtotime(I('get.endtime'));
        if ($starttime || $endtime) {
            $i = $i + 1;
            $where[$i] = "regdatetime between " . $starttime. ' and '.$endtime;
        }
        
        $list = $this->lists("User", $where);
        $this->assign("list", $list);
        $Systembank = M("Systembank");
        $banklist = $Systembank->select();
        $this->assign("banklist", $banklist);
        
        $Payapiconfig = M("Payapiconfig");
        $disabledpayapiid = $Payapiconfig->field('payapiid')
            ->where("disabled=0")
            ->select(false);
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->where("id not in (" . $disabledpayapiid . ")")->select();
        $this->assign("tongdaolist", $tongdaolist);
        
        $this->display();
    }

    //导出用户
    public function exportuser()
    {
        $usernameidsearch = I("get.usernameidsearch");
        $statussearch = I("get.statussearch");
        $rzsearch = I("get.rzsearch");
        $Userverifyinfo = M("Userverifyinfo");
        $sjusernamesearch = I("get.sjusernamesearch");
        $usertype = I("get.usertype");
        $starttime = strtotime(I('get.starttime'));
        $endtime = strtotime(I('get.endtime'));

        if(intval($usernameidsearch)){
            $map['`pay_user`.id'] = array('eq',intval($usernameidsearch) - 10000);
        }else{
            $map['`pay_user`.username'] = array('like','%'.$usernameidsearch.'%');
        }
        if ($statussearch) {
            $map['`pay_user`.status'] = array('eq',$statussearch);
        }
        if ($rzsearch) {
            $userids = '';
            $list = $Userverifyinfo->where("`pay_user`.status = " . $rzsearch)->getField("`pay_user`.userid", true);
            foreach ($list as $key => $val) {
                $userids .= $val.',';
            }
            $userids = trim($userids,',');
            $map['`pay_user`.id'] = array("in", $userids);
        }
        if ($sjusernamesearch) {
            if(intval($sjusernamesearch)){
                $sjuserid = M('User')->where("`pay_user`.id = " . (intval($sjusernamesearch) - 10000))->getField("id");
            }else{
                $sjuserid = M('User')->where("`pay_user`.username like '%" . $sjusernamesearch . "%'")->getField("id");
            }
            $map['`pay_user`.superioruserid'] = array('eq',$sjuserid);
        }
        if ($starttime || $endtime) {
            $map['`pay_user`.regdatetime'] = array('between',array($starttime,$endtime));
        }

        $map['`pay_user`.usertype'] = $usertype ? array('eq',$usertype) : array('neq',0);

        $title = array('用户名','商户号','用户类型','上级用户名','状态','认证','账户总余额','注册时间');
        $data = M('User')
            ->where($map)
            ->join('LEFT JOIN pay_userverifyinfo uv ON uv.userid = pay_user.id')
            ->field('pay_user.*,uv.status as rzstatus')
            ->select();
        foreach ($data as $item){
            switch ($item['usertype'])
            {
                case 4:
                    $usertypestr = '商户';
                    break;
                case 5:
                    $usertypestr = '代理商';
                    break;
            }
            switch ($item['status'])
            {
                case 0:
                    $userstatus = '未激活';
                    break;
                case 1:
                    $userstatus = '正常';
                    break;
                case 2:
                    $userstatus = '已禁用';
                    break;
            }
            switch ($item['rzstatus'])
            {
                case 1:
                    $rzstauts = '已认证';
                    break;
                case 0:
                    $rzstauts = '未认证';
                    break;
                case 2:
                    $rzstauts = '等待审核';
                    break;
            }
            $list[] = array(
                'username'=>$item['username'],
                'userid'=>$item['id']+10000,
                'usertype'=>$usertypestr,
                'superioruserid'=>sjusername($item['superioruserid'],1),
                'status'=>$userstatus,
                'rzstatus'=>$rzstauts,
                'total'=>zhanghuzongyue($item['id']),
                'regdatetime'=>date('Y-m-d H:i:s',$item['regdatetime'])
            );
        }
        exportCsv($list,$title);
    }
    
    public function acclist()
    {
        $userid = I("get.userid");
	$res = M('Userbankaccount')->where(array('userid'=>$userid+10000))->order('floating desc')->select();
	
	$this->assign('acclist',$res);
	$this->display();
	//$this->ajaxReturn($res,'json');
    }

    public function jbxx()
    {
        $userid = I("post.userid");
        $Userbasicinfo = M("Userbasicinfo");
        $list = $Userbasicinfo->where("userid=" . $userid)->find();
        $list['username'] = M('User')->where(array('id'=>$userid))->getField('username');
        $list['usertype'] = M('User')->where(array('id'=>$userid))->getField('usertype');
        $this->ajaxReturn($list, "json");
    }

    public function editjbxx()
    {
        if(IS_POST){
            $rows['fullname'] = I('post.fullname');
            $rows['sfznumber'] = I('post.sfznumber');
            $rows['birthday'] = I('post.birthday');
            $rows['phonenumber'] = I('post.phonenumber');
            $rows['qqnumber'] = I('post.sfznumber');
            $rows['address'] = I('post.address');
            $rows['sex'] = I('post.sex');
            $usertype = I('post.usertype');
            M('User')->where(array('id'=>I('post.userid')))->save(array('usertype'=>$usertype));
            $returnstr = M("Userbasicinfo")->where(array('id'=>I('post.id')))->save($rows);
            if ($returnstr == 1 || $returnstr == 0) {
                exit("ok");
            } else {
                exit("no");
            }
        }
    }

    public function zhuangtai()
    {
        $userid = I("post.userid");
        $User = M("User");
        $status = $User->where("id=" . $userid)->getField("status");
        exit($status);
    }

    public function xgzhuangtai()
    {
        $userid = I("post.userid");
        $status = I("post.status");
        $User = M("User");
        $data["status"] = $status;
        $returnstr = $User->where("id=" . $userid)->save($data);
        if ($returnstr == 1 || $returnstr == 0) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function renzheng()
    {
        $userid = I("post.userid");
        $Userverifyinfo = M("Userverifyinfo");
        $list = $Userverifyinfo->where("userid=" . $userid)->find();
        $this->ajaxReturn($list, "json");
    }

    public function renzhengedit()
    {
        $userid = I("post.userid");
        $status = I("post.status");
        $Userverifyinfo = M("Userverifyinfo");
        $data["status"] = $status;
        $returnstr = $Userverifyinfo->where("userid=" . $userid)->save($data);
        if ($returnstr == 1 || $returnstr == 0) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function renzhengeditdomain()
    {
        $userid = I("post.userid");
        $domain = I("post.domain");
        $Userverifyinfo = M("Userverifyinfo");
        $data["domain"] = $domain;
        $returnstr = $Userverifyinfo->where("userid=" . $userid)->save($data);
        if ($returnstr == 1 || $returnstr == 0) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function renzhengeditmd5key()
    {
        $userid = I("post.userid");
        $md5key = I("post.md5key");
        $Userverifyinfo = M("Userverifyinfo");
        $data["md5key"] = $md5key;
        $returnstr = $Userverifyinfo->where("userid=" . $userid)->save($data);
        if ($returnstr == 1 || $returnstr == 0) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function editpassword()
    {
        $userid = I("post.userid");
        $passwordstr = I("post.passwordstr");
        $fieldstr = I("post.fieldstr");
        $Userpassword = M("Userpassword");
        $data[$fieldstr] = md5($passwordstr);
        $returnstr = $Userpassword->where("userid=" . $userid)->save($data);
        if ($returnstr == 1 || $returnstr == 0) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function bankcard()
    {
        $userid = I("post.userid");
        $Bankcard = M("Bankcard");
        $list = $Bankcard->where("userid=" . $userid)->find();
        $this->ajaxReturn($list, "json");
    }

    public function editbankcard()
    {
        if (IS_POST){
            $id = I('post.id');
            $rows = [
                'bankname'=>I('post.bankname','','trim'),
                'bankzhiname'=>I('post.bankzhiname','','trim'),
                'banknumber'=>I('post.banknumber','','trim'),
                'bankfullname'=>I('post.bankfullname','','trim'),
                'sheng'=>I('post.sheng','','trim'),
                'shi'=>I('post.shi','','trim'),
            ];
            $returnstr = M("Bankcard")->where(['id'=>$id])->save($rows);
            if ($returnstr == 1 || $returnstr == 0) {
                exit("ok");
            } else {
                exit("no");
            }
        }
    }

    public function suoding()
    {
        $id = I("post.id");
        $disabled = I("post.disabled");
        $data["disabled"] = $disabled;
        if ($disabled == 0) {
            $data["jdatetime"] = date("Y-m-d H:i:s");
        }
        $Bankcard = M("Bankcard");
        $returnstr = $Bankcard->where("id=" . $id)->save($data);
        if ($returnstr == 1 || $returnstr == 0) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function tongdao()
    {
        $userid = I("post.userid");

        $Userpayapi = M("Userpayapi");
        $list = $Userpayapi->where("userid=" . $userid)->find();
        
        if (! $list) {
            $Payapiconfig = M("Payapiconfig");
            $payapiid = $Payapiconfig->where("`default`=1")->getField("payapiid");
            $Payapi = M("Payapi");
            $en_payname = $Payapi->where("id=" . $payapiid)->getField("en_payname");
            $Userpayapi->userid = $userid;
            $Userpayapi->payapicontent = $en_payname . "|";
            $Userpayapi->add();
            $list = $Userpayapi->where("userid=" . $userid)->find();
        }
        $Payapiconfig = M("Payapiconfig");
        $payapiid = $Payapiconfig->where("`default`=1")->getField("payapiid");


        $Payapi = M("Payapi");
        $en_payname = $Payapi->where("id=" . $payapiid)->getField("en_payname");

        $list["disabled"] = $en_payname;
       
        $Payapiconfig = M("Payapiconfig");
        $payapiidstr = $Payapiconfig->field("payapiid")
            ->where("disabled=1")
            ->select(false);
        $Payapi = M("Payapi");
        $listlist = $Payapi->where("id in (" . $payapiidstr . ")")->select();
        $payapiaccountarray = array();
        foreach ($listlist as $key) {
            
            $Userpayapizhanghao = M("Userpayapizhanghao");
            $val = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $key["id"])->getField("defaultpayapiuserid");
            if (! $val) {
                $Payapiaccount = M("Payapiaccount");
                $val = $Payapiaccount->where("payapiid=" . $key["id"] . " and defaultpayapiuser=1")->getField("id");
            }
            $payapiaccountarray[$key["en_payname"] . $key["id"]] = $val;
        }
        
        $obj = array(
            'list' => $list,
            'payapiaccountarray' => $payapiaccountarray
        );
        
        $this->ajaxReturn($obj, "json");
    }

    public function edittongdao()
    {
        $userid = I("post.userid");
        $selecttype = I("post.selecttype");
        $payname = I("post.payname");
        
        $Userpayapi = M("Userpayapi");
        $payapicontent = $Userpayapi->where("userid=" . $userid)->getField("payapicontent");
        if ($selecttype == 1) {
            $payapicontent = str_replace($payname . "|", "", $payapicontent);
        } else {
            $payapicontent = $payapicontent . $payname . "|";
        }
        $data["payapicontent"] = $payapicontent;
        $num = $Userpayapi->where("userid=" . $userid)->save($data);
        if ($num) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function editdefaultpayapiuser()
    {
        $userid = I("post.userid");
        $payapiid = I("post.payapiid");
        $val = I("post.val");
        
        $Userpayapizhanghao = M("Userpayapizhanghao");
        $list = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $payapiid)->select();
        if (! $list) {
            $data["userid"] = $userid;
            $data["payapiid"] = $payapiid;
            $data["defaultpayapiuserid"] = $val;
            $Userpayapizhanghao->add($data);
        } else {
            $data["defaultpayapiuserid"] = $val;
            $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $payapiid)->save($data);
        }
        exit("ok");
    }

    public function feilv()
    {
        $userid = I("post.userid");
        $Payapiconfig = M("Payapiconfig");
        $payapiidstr = $Payapiconfig->field("payapiid")
            ->where("disabled=1")
            ->select(false);
        $Payapi = M("Payapi");
        $listlist = $Payapi->where("id in (" . $payapiidstr . ")")->select();
        $payapiaccountarray = array();
        foreach ($listlist as $key) {
            
            $Userpayapizhanghao = M("Userpayapizhanghao");
            $val = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $key["id"])->getField("feilv");
            if (! $val) {
                $Payapiaccount = M("Payapiaccount");
                $val = $Payapiaccount->where("payapiid=" . $key["id"] . " and defaultpayapiuser=1")->getField("defaultrate");
            }
            
            $val2 = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $key["id"])->getField("fengding");
            if (! $val2) {
                $Payapiaccount = M("Payapiaccount");
                $val2 = $Payapiaccount->where("payapiid=" . $key["id"] . " and defaultpayapiuser=1")->getField("fengding");
            }
            $val3 = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $key["id"])->getField("traffic");
            if (! $val3) {
                $Payapiaccount = M("Payapiaccount");
                $val3 = $Payapiaccount->where("payapiid=" . $key["id"] . " and defaultpayapiuser=1")->getField("traffic");
            }

            $payapiaccountarray[$key["en_payname"] . $key["id"]] = $val . "|" . $val2 ."|" .$val3;
        }
        $this->ajaxReturn($payapiaccountarray, "json");
    }

    public function editfeilv()
    {
        $userid = I("post.userid");
        $payapiid = I("post.payapiid");
        $val1 = I("post.feilvval", "") ? I("post.feilvval", "") : 0;
        $val2 = I("post.fengdingval", "") ? I("post.fengdingval", "") : 0;
        $val3 = I("post.trafficval", "") ? I("post.trafficval", "") : 0;
        $Userpayapizhanghao = M("Userpayapizhanghao");
        $list = $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $payapiid)->select();
        if (! $list) {
            $data["userid"] = $userid;
            $data["payapiid"] = $payapiid;
            $data["feilv"] = $val1;
            $data["fengding"] = $val2;
            $data["traffic"] = $val3;
            $Userpayapizhanghao->add($data);
        } else {
            $data["feilv"] = $val1;
            $data["fengding"] = $val2;
            $data["traffic"] = $val3;
            $Userpayapizhanghao->where("userid=" . $userid . " and payapiid=" . $payapiid)->save($data);
        }
        exit("ok");
    }

    public function tksz()
    {
        $userid = I("post.userid");
        $User = M("User");
        $usertype = $User->where("id=" . $userid)->getField("usertype");
        $websiteid = $User->where("id=" . $userid)->getField("websiteid");
        $useriduserid = $userid;
        $Payapiconfig = M("Payapiconfig");
        $disabledpayapiid = $Payapiconfig->field('payapiid')->where("disabled=0")->select(false);
        $Payapi = M("Payapi");
        $tongdaolist = $Payapi->where("id not in (" . $disabledpayapiid . ")")->select();
        $datetype = array("b", "w", "j");
        $Tikuanmoney = M("Tikuanmoney");
        $array = array();
        foreach ($tongdaolist as $tongdao) {
            // file_put_contents("loguser.txt",$tongdao["id"]."----", FILE_APPEND);
            for ($i = 0; $i < 2; $i ++) {
                // file_put_contents("loguser.txt",$i."----", FILE_APPEND);
                foreach ($datetype as $val) {
                    // file_put_contents("loguser.txt",$val."||".$userid."||".$websiteid."|||||||", FILE_APPEND);
                    $count = $Tikuanmoney->where("t=" . $i . " and userid=" . $userid . " and payapiid=" . $tongdao["id"] . " and websiteid = " . $websiteid . " and datetype = '" . $val . "'")->count();
                    // file_put_contents("loguser.txt",$count."*********", FILE_APPEND);
                    if ($count <= 0) {
                        $Tikuanmoney->t = $i;
                        $Tikuanmoney->datetype = $val;
                        $Tikuanmoney->userid = $userid;
                        $Tikuanmoney->websiteid = $websiteid;
                        $Tikuanmoney->payapiid = $tongdao["id"];
                        $Tikuanmoney->add();
                        $value = "0.00";
                    } else {
                        $value = $Tikuanmoney->where("t=" . $i . " and userid=" . $userid . " and payapiid=" . $tongdao["id"] . " and websiteid = " . $websiteid . " and datetype = '" . $val . "'")->getField("money");
                    }
                    $array["form" . $tongdao["id"]]["t" . $i . $val] = $value;
                }
            }
            $array["form" . $tongdao["id"]]["tikuanpayapiid"] = $tongdao["id"];
            $array["form" . $tongdao["id"]]["userid"] = $useriduserid;
        }
        
        $Tikuanconfig = M("Tikuanconfig");
        $count = $Tikuanconfig->where("websiteid=" . $websiteid . " and userid=" . $userid)->count();
        if ($count <= 0) {
            $data["websiteid"] = $websiteid;
            $data["userid"] = $userid;
            $Tikuanconfig->add($data);
        }
        $tikuanconfiglist = $Tikuanconfig->where("websiteid=" . $websiteid . " and userid=" . $userid)->find();
        $arraystr = array();
        $arraystr["tikuanconfig"] = $tikuanconfiglist;
        $arraystr["tksz"] = $array;
        $this->ajaxReturn($arraystr, "json");
    }

    public function Edittikuanmoney()
    {
        $userid = I("post.userid");
        
        $User = M("User");
        $usertype = $User->where("id=" . $userid)->getField("usertype");
        $websiteid = $User->where("id=" . $userid)->getField("websiteid");
        /*
         * if($usertype == 2){ //如果用户类型为2 分站管理员
         * $Website = M("Website");
         * $websiteid = $Website->where("userid=".$userid)->getField("id");
         * $useriduserid = $userid;
         * $userid = 0;
         *
         * }else{
         * $websiteid = 0;
         * }
         */
        
        $payapiid = I("post.tikuanpayapiid");
        
        $datetype = array(
            "b",
            "w",
            "j"
        );
        
        $Tikuanmoney = M("Tikuanmoney");
        
        for ($i = 0; $i < 2; $i ++) {
            foreach ($datetype as $val) {
                $Tikuanmoney->money = I("post.t" . $i . $val, 0);
                $Tikuanmoney->where("t=" . $i . " and userid=" . $userid . " and payapiid=" . $payapiid . " and websiteid = " . $websiteid . " and datetype = '" . $val . "'")->save();
            }
        }
        exit("修改成功！");
    }

    // 用户金额
    public function usermoney()
    {
        $userid = I("get.userid");
        $User = M("User");
        $username = $User->where("id=" . $userid)->getField("username");
        $this->assign("username", $username);
        
        $Money = M("Money");
        $moneyfind = $Money->where("userid=" . $userid)->find();
        $this->assign("moneyfind", $moneyfind);

        // 可用通道金额
        $Userpayapi = M("Userpayapi");
        $payapicontent = $Userpayapi->where("userid=" . $userid)->getField("payapicontent");
        $array = explode("|", $payapicontent);
        $strarray = "";
        if($array){
            foreach ($array as $key => $val) {
                $strarray .= "'" . $val . "',";
            }
        }
        $strarray = trim($strarray,',');
        $Payapi = M("Payapi");
        $apimoneyarray = $Payapi->field("id,zh_payname")
            ->where("en_payname in (" . $strarray . ")")
            ->select();
        $apimoneylist = array();
        $Apimoney = M("Apimoney");
        foreach ($apimoneyarray as $i=>$key) {
            $find = $Apimoney->where("payapiid=" . $key["id"] . " and userid=" . $userid)->find();
            if (! $find) {
                $data = array();
                $data["userid"] = $userid;
                $data["payapiid"] = $key["id"];
                $Apimoney->add($data);
                $find = $Apimoney->where("payapiid=" . $key["id"] . " and userid=" . $userid)->find();
            }
            $apimoneylist[$i]["id"] = $key["id"];
            $apimoneylist[$i]["zh_payname"] = $key["zh_payname"];
            $apimoneylist[$i]["money"] = $find["money"];
            $apimoneylist[$i]["freezemoney"] = $find["freezemoney"];
            $apimoneylist[$i]["status"] = $find["status"];
        }
        $this->assign("apimoneylist", $apimoneylist);

        $this->display();
    }

    public function loadmoney()
    {
        $userid = I("post.userid", "");
        $tongdaoid = I("post.tongdaoid", "");
        $array = array();
        $Payapi = M("Payapi");
        $tongdaoname = $Payapi->where("id=" . $tongdaoid)->getField("zh_payname");
        $array["tongdaoname"] = $tongdaoname;
        $Apimoney = M("Apimoney");
        $money = $Apimoney->where("userid=" . $userid . " and payapiid=" . $tongdaoid)->getField("money");
        $freezemoney = $Apimoney->where("userid=" . $userid . " and payapiid=" . $tongdaoid)->getField("freezemoney");
        $array["money"] = $money;
        $array["freezemoney"] = $freezemoney;
        $this->ajaxReturn($array);
    }

    public function zjjedit()
    {
        $userid = I("post.userid", "");
        $tongdaoid = I("post.tongdaoid", "");
        $cztype = I("post.cztype", "");
        $bgmoney = I("post.bgmoney", "");
        $contentstr = I("post.contentstr", "");
        $array = array();
        if ($userid == "" || $tongdaoid == "" || $cztype == "" || ($cztype != 3 && $cztype != 4) || $bgmoney == "" || $bgmoney == 0) {
            $array["status"] = "请不要非法提交";
        } else {
            $Apimoney = M("Apimoney");
            $money = $Apimoney->where("userid=" . $userid . " and payapiid=" . $tongdaoid)->getField("money");
            
            if ($money < $bgmoney && $cztype == 4) {
                $array["status"] = "账上余额不足" . $bgmoney . "元，不能完成减金操作";
            } else {
                if ($cztype == 4) {
                    $bgmoney = (- 1) * $bgmoney;
                }
                $data = array();
                $data["money"] = floatval($money) + floatval($bgmoney);
                if ($Apimoney->where("userid=" . $userid . " and payapiid=" . $tongdaoid)->save($data)) {
                    $array["status"] = "ok";
                    $array["money"] = floatval($money) + floatval($bgmoney);
                    // /////////////////////////////////////////////////////////////////////////
                    $ArrayField = array(
                        "userid" => $userid,
                        "ymoney" => $money,
                        "money" => $bgmoney,
                        "gmoney" => floatval($money) + floatval($bgmoney),
                        "datetime" => date("Y-m-d H:i:s"),
                        "tongdao" => $tongdaoid,
                        "transid" => "",
                        "orderid" => "",
                        "lx" => $cztype, // 增减鑫类型
                        "contentstr" => $contentstr
                    );
                    moneychangeadd($ArrayField);
                    // ////////////////////////////////////////////////////////////////////////
                } else {
                    $array["status"] = "金额变更失败，请稍后重试";
                }
            }
        }
        
        $this->ajaxReturn($array);
    }

    public function djjeedit()
    {
        $userid = I("post.userid", "");
        $tongdaoid = I("post.tongdaoid", "");
        $cztype = I("post.cztype", "");
        $bgmoney = I("post.bgmoney", "");
        $contentstr = I("post.contentstr", "");
        $array = array();
        if ($userid == "" || $tongdaoid == "" || $cztype == "" || ($cztype != 7 && $cztype != 8) || $bgmoney == "" || $bgmoney == 0) {
            $array["status"] = "请不要非法提交";
        } else {
            $Apimoney = M("Apimoney");
            $money = $Apimoney->where("userid=" . $userid . " and payapiid=" . $tongdaoid)->getField("money");
            $freezemoney = $Apimoney->where("userid=" . $userid . " and payapiid=" . $tongdaoid)->getField("freezemoney");
            
            if (($money < $bgmoney && $cztype == 7) || ($freezemoney < $bgmoney && $cztype == 8)) {
                $strstrstr = $cztype == 7 ? "冻结" : "解冻";
                $array["status"] = "账上余额不足" . $bgmoney . "元，不能完成" . $strstrstr . "操作";
            } else {
                if ($cztype == 7) {
                    $bgmoney = (- 1) * $bgmoney;
                }
                $data = array();
                $data["money"] = floatval($money) + floatval($bgmoney);
                $data["freezemoney"] = floatval($freezemoney) - floatval($bgmoney);
                if ($Apimoney->where("userid=" . $userid . " and payapiid=" . $tongdaoid)->save($data)) {
                    $array["status"] = "ok";
                    $array["money"] = floatval($money) + floatval($bgmoney);
                    $array["freezemoney"] = floatval($freezemoney) - floatval($bgmoney);
                    // /////////////////////////////////////////////////////////////////////////
                    $ArrayField = array(
                        "userid" => $userid,
                        "ymoney" => $money,
                        "money" => $bgmoney,
                        "gmoney" => floatval($money) + floatval($bgmoney),
                        "datetime" => date("Y-m-d H:i:s"),
                        "tongdao" => $tongdaoid,
                        "transid" => "",
                        "orderid" => "",
                        "lx" => $cztype, // 增减鑫类型
                        "contentstr" => $contentstr
                    );
                    moneychangeadd($ArrayField);
                    // ////////////////////////////////////////////////////////////////////////
                } else {
                    $array["status"] = "金额变更失败，请稍后重试";
                }
            }
        }
        
        $this->ajaxReturn($array);
    }
	

    //切换身份
    public function changeuser()
    {
        $userid = I('get.userid');
        $info = M('User')->where(['id='.$userid])->find();
        if($info){
            cookie('userid',$info['id']);
            cookie('usertype',$info['usertype']);
            header('Location:'.$this->_site.'User.html');
        }
    }
}
?>
