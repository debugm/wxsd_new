<?php
namespace Home\Controller;


use Think\Action;

class EmptyController extends BaseController
{

    public function index()
    {
        switch (strtolower(CONTROLLER_NAME)) {
            case strtolower(C("LOGINNAME")):
                $userid = $_SESSION["admin_userid"];
                if (empty($userid)) {
                    $this->display("Application/Admin/View/Index/login.tpl");
                } else {
                    $this->success('正在跳转......!',U('Admin/Index/index'));
                }
                break;
            default:
                $this->display("Index/sls");
        }
    }

    public function _empty()
    {
        $controllername = CONTROLLER_NAME;
        if ($controllername == "Activate") {
            echo $Activate = explode('_',$_SERVER['PATH_INFO'])[1];
            $User = M("User");
            $_userdata = $User->where("activate='" . $Activate . "'")->find();
            if ($_userdata['username']) {
                $status = $_userdata["status"];
                $activatedatetime = $_userdata["activatedatetime"];
                $usertype = $_userdata["usertype"];
                switch ($usertype) {
                    case 1:
                        $user_type = "系统子管理员";
                        break;
                    case 2:
                        $user_type = "分站管理员";
                        break;
                    case 3:
                        $user_type = "分站子管理员";
                        break;
                    case 4:
                        $user_type = "普通商户";
                        break;
                    case 5:
                        $user_type = "普通代理商";
                        break;
                    case 6:
                        $user_type = "独立代理商";
                        break;
                }
                if ($status == 0) {
                    $activatedatetime = date("Y-m-d H:i:s");
                    $User->status = 1;
                    $User->activatedatetime = $activatedatetime;
                    $User->where("activate='" . $Activate . "'")->save();
                    $this->assign("t", "ok");
                    $this->assign("strtitle", "账号激活成功！");
                    $this->assign("strcontent", "激活账号：【" . $_userdata['username'] . "】<br> 用户类型：【" . $user_type . "】<br> 激活时间：【" . $activatedatetime . "】");
                } else {
                    $this->assign("t", "no");
                    $this->assign("strtitle", "账号激活失败！");
                    $this->assign("strcontent", $_userdata['username']  . " 账号已激活，激活时间：" . $activatedatetime . " 请不要重复激活！");
                }
            } else {
                $this->assign("t", "no");
                $this->assign("strtitle", "账号激活失败！");
                $this->assign("strcontent", "激活账号不存在！");
                // ///////////
            }
        } else {
            $this->assign("t", "no");
            $this->assign("strtitle", "非法操作");
            $this->assign("strcontent", "请不要非法操作！");
        }
        $this->display("/Index/activate");
    }
}
?>
