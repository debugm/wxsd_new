<?php

namespace Home\Controller;

class IndexController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $userid = cookie("userid");
        $usertype = cookie("usertype");
        if (!empty($userid) || !empty($usertype)) {
            // exit("<script type='text/javascript'>window.location.href='" . U("/User") . "'</script>");
        }
    }

    public function index()
    {
        $this->display();
    }

    public function checkuser()
    {
        $username = I("post.username");
        $User = M("User");
        $userid = $User->where("username='" . $username . "'")->getField("id");
        $valid = true;
        if ($userid) {
            $valid = false;
            echo json_encode(array('valid' => $valid));
        } else {
            echo json_encode(array('valid' => $valid));
        }
    }

    public function checkemail()
    {
        $email = I("post.email");
        $User = M("User");
        $userid = $User->where("email='" . $email . "'")->getField("id");
        $valid = true;
        if ($userid) {
            $valid = false;
            echo json_encode(array('valid' => $valid));
        } else {
            echo json_encode(array('valid' => $valid));
        }
    }

    public function checkinvitecode()
    {
        $invite_code = I("post.invitecode");
        $Invitecode = M("Invitecode");
        $where['invitecode'] = $invite_code;
        //$where['inviteconfigzt'] = 1;
        //$where['yxdatetime'] = array('gt', time());
        $id = $Invitecode->where($where)->getField("id");
        $valid = true;
        if ($id) {
            echo json_encode(array('valid' => $valid));
        } else {
            $valid = false;
            echo json_encode(array('valid' => $valid));
        }
    }

    public function verifycode()
    {
        $config = array(
            'length' => 5, // 验证码位数
            'useNoise' => false, // 关闭验证码杂点
            'useImgBg' => false, // 使用背景图片
            'useZh' => false, // 使用中文验证码
            'useCurve' => false, // 是否画混淆曲线
            'useNoise' => true,// 是否添加杂点
        );
        $verify = new \Think\Verify($config);
        $verify->entry();
    }

    public function checkverify()
    {
        $code = I("request.code", "");
        $verify = new \Think\Verify();
        if ($verify->check($code)) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function register()
    {
        if(IS_POST && $_POST['__hash__']){
            $username = I('post.username');
            $password = I('post.password');
            $confirmpassword = I('post.confirmpassword');
            $email = I('post.email');
            $invitecode = I('post.invitecode');

            $_verfycode = M('Invitecode')->where(array('invitecode'=>$invitecode))->find();
            if(!$_verfycode){
                $this->ajaxReturn(array('errorno'=>10001,'msg'=>'邀请码无效!'));
            }

            $_modeluser = M('User');
            $websiteid = $_modeluser->where("id=" . $_verfycode['fmusernameid'])->getField("websiteid");

            $activate = md5(md5($username) . md5($password)) . md5($email);
            $_userdata = array(
                'username'=>$username,
                'superioruserid'=>$_verfycode['fmusernameid'],
                'websiteid'=>$websiteid,
                'email'=>$email,
                'usertype'=>$_verfycode['regtype'],
                'regdatetime'=>time(),
                'activate'=>$activate,
            );
            $uid = $_modeluser->add($_userdata);

            //密码
            $Userpassword = M("Userpassword");
            $Userpassword->userid = $uid;
            $Userpassword->loginpassword = md5($password);
            $Userpassword->paypassword = md5("123456");
            $Userpassword->add();

            $Userbasicinfo = M("Userbasicinfo");
            $Userbasicinfo->userid = $uid;
            $Userbasicinfo->add();

            $Userverifyinfo = M("Userverifyinfo");
            $Userverifyinfo->userid = $uid;
            $Userverifyinfo->md5key = random_str(30);
            $Userverifyinfo->add();

            if($uid) {
                //银行
                M('Bankcard')->add(array('userid' => $uid));
                //金额
                $moneydata = array('userid' => $uid, 'money' => 0, 'freezemoney' => 0, 'wallet' => 0);
                M('Money')->add($moneydata);
                //默认通道
                $en_payname = M('Payapiconfig')
                    ->join('pay_payapi ON pay_payapi.id = pay_payapiconfig.payapiid')
                    ->where("pay_payapiconfig.default=1")
                    ->getField('pay_payapi.en_payname');
                M('Userpayapi')->add(array('userid' => $uid, 'payapicontent' => $en_payname . '|'));

                $_modelapimoney = M("Apimoney");
                $data = M("Payapi")->select();
                foreach ($data as $val) {
                    $_modelapimoney->add(array('userid' => $uid, 'payapiid' => $val['id']));
                }

                //失效邀请码
                $_failinvitecode = array('syusernameid' => $uid, 'sydatetime' => time(), 'inviteconfigzt' => 2);
                M('Invitecode')->where("invitecode = '" . $invitecode . "'")->save($_failinvitecode);

                //邮件激活
                $ReturnEmail = successregemail($username, $email, $activate, $websiteid);
                $_modelwebconfig = M("Websiteconfig");
                $_webconfig = $_modelwebconfig->where("websiteid = " . $websiteid)->find();
                $tel = $_webconfig["tel"];
                $qqlist = $_webconfig['qq'];
                $mail = explode('@',$email)[1];
                $this->ajaxReturn(array('errorno' => 0, 'msg' => array('tel' => $tel, 'qq' => $qqlist, 'email' => $email,'mail'=>'http://mail.'.$mail)));
            }else{
                $this->ajaxReturn(array('errorno'=>10002,'msg'=>'注册失败'));
            }
        }
    }

    public function login()
    {
        $username = I("post.username", "");
        $password = I("post.password", "");
        $varification = I("post.varification", "");
        $cookiename = I("post.cookiename", "");
        if ($username == "" || $password == "" || $varification == "") {
            $this->assign("t", "no");
            $this->assign("strtitle", "登录失败！");
            $this->assign("strcontent", "用户名或密码或验证码不能为空！");
            $this->display("activate");
        } else {
            $verify = new \Think\Verify();
            if ($verify->check($varification)) {
                $User = M("User");
                $userid = $User->where("username='" . $username . "'")->getField("id");
                $status = $User->where("username='" . $username . "'")->getField("status");
                $usertype = $User->where("username='" . $username . "'")->getField("usertype");
                if ($userid) {
                    if ($status == 0) {
                        $this->assign("t", "no");
                        $this->assign("strtitle", "登录失败！");
                        $this->assign("strcontent", "账号未激活,请激活后再登录！");
                        $this->display("activate");
                    } else {
                        if ($status == 2) {
                            $this->assign("t", "no");
                            $this->assign("strtitle", "登录失败！");
                            $this->assign("strcontent", "账号已被禁用！");
                            $this->display("activate");
                        } else {
                            $Userpassword = M("Userpassword");
                            $number = $Userpassword->where("userid=" . $userid . " and loginpassword = '" . md5($password) . "'")->count();
                            if ($number == 0) {
                                $this->assign("t", "no");
                                $this->assign("strtitle", "登录失败！");
                                $this->assign("strcontent", "密码错误！");
                                $this->display("activate");
                            } else {

                                if ($cookiename) {
                                    cookie('userid', $userid, $cookiename);
                                    cookie('usertype', $usertype, $cookiename);
                                } else {
                                    cookie('userid', $userid);
                                    cookie('usertype', $usertype);
                                }
                                // R("/User");
                                echo "<script type='text/javascript'>window.location.href='" . U("/User") . "'</script>";
                            }
                        }
                    }
                } else {
                    $this->assign("t", "no");
                    $this->assign("strtitle", "登录失败！");
                    $this->assign("strcontent", "用户名不存在！");
                    $this->display("activate");
                }
            } else {
                $this->assign("t", "no");
                $this->assign("strtitle", "登录失败！");
                $this->assign("strcontent", "验证码输入错误！" . $varification);
                $this->display("activate");
            }
        }
    }

    public function excel()
    {

        vendor("PHPExcel.PHPExcel");

        $filePath = "Book1.xls";

        //建立reader对象
        $PHPReader = new \PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($filePath)) {
            $PHPReader = new \PHPExcel_Reader_Excel5();
            if (!$PHPReader->canRead($filePath)) {
                echo 'no Excel';
                return;
            }
        }


        //建立excel对象，此时你即可以通过excel对象读取文件，也可以通过它写入文件
        $PHPExcel = $PHPReader->load($filePath);

        /**读取excel文件中的第一个工作表*/
        $currentSheet = $PHPExcel->getSheet(0);
        /**取得最大的列号*/
        $allColumn = $currentSheet->getHighestColumn();
        /**取得一共有多少行*/
        $allRow = $currentSheet->getHighestRow();

        //循环读取每个单元格的内容。注意行从1开始，列从A开始
        for ($rowIndex = 1; $rowIndex <= $allRow; $rowIndex++) {
            for ($colIndex = 'A'; $colIndex <= $allColumn; $colIndex++) {
                $addr = $colIndex . $rowIndex;
                $cell = $currentSheet->getCell($addr)->getValue();
                if ($cell instanceof PHPExcel_RichText)     //富文本转换字符串
                    $cell = $cell->__toString();

                echo $cell;

            }
            echo "<br>";

        }
    }

    public function check()
    {
        $data = array('errorCode'=>1,'ver'=>'2.1.20','file'=>'http://up.18biz.net/2.1.20.zip');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
}
