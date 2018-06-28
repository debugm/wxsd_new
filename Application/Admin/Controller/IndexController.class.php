<?php
namespace Admin\Controller;

use Think\Page;

class IndexController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->checklogin();
        $this->display();
    }

    public function defaultindex()
    {
        $this->checklogin();

        //系统公告
        $_articlelist = M('Article')->where('	status=0')->order('id desc')->limit(3)->select();

        //日报
        $_data['today'] = date('Y年m月d日');
        $_data['month'] = date('Y年m月');

        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));

        //实时统计
        $ddata['num'] = M('Order')->where(array('pay_status'=>1,'pay_status'=>2,'pay_successdate'=>array('between',array(strtotime('today'),strtotime('tomorrow')))))->count();
        $ddata['amount'] = M('Order')->where(array('pay_status'=>1,'pay_status'=>2,'pay_successdate'=>array('between',array(strtotime('today'),strtotime('tomorrow')))))->sum('pay_amount');
        $ddata['rate'] = M('Order')->where(array('pay_status'=>1,'pay_status'=>2,'pay_successdate'=>array('between',array(strtotime('today'),strtotime('tomorrow')))))->sum('pay_poundage');
        $ddata['total'] = M('Order')->where(array('pay_status'=>1,'pay_status'=>2,'pay_successdate'=>array('between',array(strtotime('today'),strtotime('tomorrow')))))->sum('pay_actualamount');

        //本月统计
        //$_data['curmonth']['num'] = M('Order')->where(array('pay_status'=>2,'pay_successdate'=>array('between',array($beginThismonth,$endThismonth))))->count();
        //$_data['curmonth']['total'] = M('Order')->where(array('pay_status'=>2,'pay_successdate'=>array('between',array($beginThismonth,$endThismonth))))->sum('pay_amount');
       //$_data['curmonth']['rate'] = M('Order')->where(array('pay_status'=>2,'pay_successdate'=>array('between',array($beginThismonth,$endThismonth))))->sum('pay_poundage');

        //7天统计
        $lastweek = time()-7*86400;
        $sql = "select COUNT(id) as num,SUM(pay_amount) AS amount,SUM(pay_poundage) AS rate,SUM(pay_actualamount) AS total from pay_order where  1=1 and pay_status=1 or pay_status=2 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(pay_successdate,'%Y-%m-%d')) and pay_successdate>=$lastweek; ";
        $wdata = M('Order')->query($sql);

        //按月统计
        $lastyear = strtotime(date('Y-1-1'));
        $sql = "select FROM_UNIXTIME(pay_successdate,'%Y年-%m月') AS month,SUM(pay_amount) AS amount,SUM(pay_poundage) AS rate,SUM(pay_actualamount) AS total from pay_order where  1=1 and pay_status=1 or pay_status=2 and pay_successdate>=$lastyear GROUP BY month;  ";
        $_mdata = M('Order')->query($sql);
        $mdata = [];
        foreach ($_mdata as $item)
        {
            $mdata['amount'][] = $item['amount'] ? $item['amount'] : 0;
            $mdata['mdate'][] = "'".$item['month']."'";
            $mdata['total'][] = $item['total'] ? $item['total'] : 0;
            $mdata['rate'][] = $item['rate'] ? $item['rate'] : 0;
        }

        //交易记录
        $count = M('Order')->where('pay_status!=0')->count();
        $page = new Page($count,10);
        $_orderlist = M('Order')->where('pay_status!=0')->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('ddata',$ddata);
        $this->assign('wdata',$wdata[0]);
        $this->assign('mdata',$mdata);
        $this->assign('page',$page->show());
        $this->assign('gglist',$_articlelist);
        $this->assign('zjbdlist',$_orderlist);
        $this->display();
    }

    public function login()
    {
        $this->display();
    }

    public function logindl()
    {
        if(IS_POST && $_POST['__hash__']) {
            $username = I("post.username");
            $loginpassword = I("post.loginpassword");
            $verification = I("post.verification");
            $verify = new \Think\Verify();
            if (!$verify->check($verification)) {
                echo json_encode(array('errorno'=>1,'msg'=>'验证码输入错误 !'));
                exit();
            }
            if (empty($username) || empty($loginpassword)) {
                echo json_encode(array('errorno'=>1,'msg'=>'账号或密码输入错误！'));
                exit();
            }
            $User = M("User");
            $list = $User->where("username='" . $username . "'")->find();
            if (!$list) {
                echo json_encode(array('errorno'=>1,'msg'=>'你的账号类型不能在此登录！'));
                exit();
            }

            $Userpassword = M("Userpassword");
            $find = $Userpassword->where("userid=" . $list["id"] . " and loginpassword = '" . md5($loginpassword) . "'")->find();
            if (!$list || !$find) {
                echo json_encode(array('errorno'=>1,'msg'=>'账号或密码输入错误！'));
                exit();
            } else {
                $usertype = $list["usertype"];
                if ($usertype == 4 || $usertype == 5 || $usertype == 6) {
                    echo json_encode(array('errorno'=>1,'msg'=>'你的账号类型不能在此登录！'));
                    exit();
                } else {
                    if ($list["status"] != 1) {
                        echo json_encode(array('errorno'=>1,'msg'=>'您的账号已被禁用或激活！'));
                        exit();
                    } else {
                        session("admin_username", $list['username']);
                        session("admin_userid", $list['id']);
                        session("admin_websiteid", $list['websiteid']);
                        session("admin_usertype", $list["usertype"]);

                        // 登录记录
                        $Loginrecord = M("Loginrecord");
                        $Loginrecord->userid = $list['id'];
                        $Loginrecord->logindatetime = date("Y-m-d H:i:s");
                        // $ipaddress = get_client_ip();
                        $Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
                        $location = $Ip->getlocation(); // 获取某个IP地址所在的位置
                        $Loginrecord->loginip = $location['ip'];
                        $Loginrecord->loginaddress = $location['country'] . "-" . $location['area'];
                        $Loginrecord->add();
                        echo json_encode(array('errorno'=>0,'msg'=>'success'));
                        exit();
                    }
                }
            }
        }
    }

    public function verifycode()
    {
        $config = array(
            'length' => 4, // 验证码位数
            'useNoise' => false, // 关闭验证码杂点
            'useImgBg' => false, // 使用背景图片
            'useZh' => false, // 使用中文验证码
            'useCurve' => false, // 是否画混淆曲线
            'useNoise' => false,// 是否添加杂点
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

    public function quit()
    {
        header('Content-type:text/html;charset=utf-8;');
        cookie("admin_userid", null);
        cookie("admin_usertype", null);
        session(null);
        header("refresh:3;url=/" . C("LOGINNAME"));
        exit('<div style="width:500px; height:auto; margin:0px auto; margin-top:100px; text-align:center;"><img src="/Public/User/images/exit.jpg"><br>正在退出登录中......</div>');
    }
}
