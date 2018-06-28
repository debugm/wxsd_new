<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        logincheck();
        $this->display();
    }

    public function login()
    {
        $this->display();
    }

    public function logindl()
    {
        if(IS_POST) {
            $username = I("post.username", "");
            $loginpassword = I("post.loginpassword", "");
            $verification = I("post.verification", "");
            $verify = new \Think\Verify();
            if (!$verify->check($verification)) {
                exit('verificationerror');
            }
            if (empty($username) || empty($loginpassword)) {
                exit("userpasserror");
            }
            $User = M("User");
            $list = $User->where("username='" . $username . "'")->find();

            if (!$list) {
                exit("userpasserror");  // 账号密码错误
            }

            $Userpassword = M("Userpassword");
            $find = $Userpassword->where("userid=" . $list["id"] . " and loginpassword = '" . md5($loginpassword) . "'")->find();
            if (!$list || !$find) {
                exit("userpasserror");
            } else {
                $usertype = $list["usertype"];
                if ($usertype == 4 || $usertype == 5 || $usertype == 6) {
                    exit("usertypeerror");
                } else {
                    if ($list["status"] != 1) {
                        exit("statuserror");
                    } else {

                        cookie('admin_userid', $list["id"]);
                        cookie('admin_usertype', $list["usertype"]);
                        exit("ok");
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
        header('Content-type:text/html;charset=urf-8;');
        cookie("admin_userid", null);
        cookie("admin_usertype", null);
        session(null);
        header("refresh:3;url=/" . C("LOGINNAME"));
        exit('<div style="width:500px; height:auto; margin:0px auto; margin-top:100px; text-align:center;"><img src="/Public/User/images/exit.jpg"><br>' . iconv("UTF-8", "GB2312//IGNORE", "正在退出登录中......") . '</div>');
    }
}