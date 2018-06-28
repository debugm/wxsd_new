<?php

function logincheck()
{
    $userid = cookie("admin_userid");
    $usertype = cookie("admin_usertype");
    if (empty($userid)) {
        exit("<script type='text/javascript'>window.location.href='/" . C("LOGINNAME") . "'</script>");
    } else {
        if (! session("?admin_username")) {
            $User = M("User");
            $userinfo = $User->where(array('id'=>$userid))->find();
            session("admin_username", $userinfo['username']);
            session("admin_userid", $userinfo['id']);
            session("admin_websiteid", $userinfo['websiteid']);
            session("admin_usertype", $usertype);
            
            // 登录记录
            $Loginrecord = M("Loginrecord");
            $Loginrecord->userid = $userid;
            $Loginrecord->logindatetime = date("Y-m-d H:i:s");
            // $ipaddress = get_client_ip();
            $Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
            $location = $Ip->getlocation(); // 获取某个IP地址所在的位置
            $Loginrecord->loginip = $location['ip'];
            $Loginrecord->loginaddress = $location['country'] . "-" . $location['area'];
            $Loginrecord->add();
        }
    }
}

function payaccessdisabled($payapiid = 0, $websiteid = 0, $opposite = 1)
{
    $Payapiconfig = M("Payapiconfig");
    
    $disabled = $Payapiconfig->where("payapiid = " . $payapiid . " and websiteid = " . $websiteid)->getField("disabled");
    
    if (($disabled == null || $disabled == 0) && $opposite == 1) {
        return "disabled";
    } else {
        if ($opposite == 0 && $disabled == 1) {
            return "disabled";
        } else {
            return "";
        }
    }
}

function payaccessdisabledbg($payapiid = 0, $websiteid = 0)
{
    $Payapiconfig = M("Payapiconfig");
    
    $disabled = $Payapiconfig->where("payapiid = " . $payapiid . " and websiteid = " . $websiteid)->getField("disabled");
    
    if ($disabled == null || $disabled == 0) {
        return "#f0ad4e;";
    } else {
        return "#5cb85c;";
    }
}

function payaccessdefault($payapiid = 0, $websiteid = 0)
{
    $Payapiconfig = M("Payapiconfig");
    
    $default = $Payapiconfig->where("payapiid = " . $payapiid . " and websiteid = " . $websiteid)->getField("default");
    
    if ($default == 1) {
        return "defaultclass";
    } else {
        return "";
    }
}

function payaccessdefaultbutton($payapiid = 0, $websiteid = 0)
{
    $Payapiconfig = M("Payapiconfig");
    
    $default = $Payapiconfig->where("payapiid = " . $payapiid . " and websiteid = " . $websiteid)->getField("default");
    
    if ($default == 1) {
        return "  disabled='disabled'>默认通道";
    } else {
        return ">设为默认通道";
    }
}

function zhuangtaiEdit($id)
{
    switch ($id) {
        case 0:
            return '<li style="background-color:#8cbae5; color:#fff;"><a href="#">修改为<strong style="color:#157d17;">已激活</strong></a></li>';
            
            break;
        case 1:
            return '<li style="background-color:#8cbae5; color:#fff;"><a href="#">修改为<strong style="color:#f00;">已禁用</strong></a></li>';
            
            break;
        case 2:
            return '<li style="background-color:#8cbae5; color:#fff;"><a href="#">修改为<strong style="color:#157d17;">已激活</strong></a></li>';
            
            break;
    }
}

function renzhengedit($id)
{
    $Userverifyinfo = M("Userverifyinfo");
    $uploadsfzzm = $Userverifyinfo->where("userid=" . $id)->getField("uploadsfzzm");
    $uploadsfzbm = $Userverifyinfo->where("userid=" . $id)->getField("uploadsfzbm");
    $uploadscsfz = $Userverifyinfo->where("userid=" . $id)->getField("uploadscsfz");
    
    $uploadsfzzm = $uploadsfzzm != '' ? "http://" . C("DOMAIN") . "/Uploads/verifyinfo/" . $uploadsfzzm : "http://" . C("DOMAIN");
    $uploadsfzbm = $uploadsfzbm != '' ? "http://" . C("DOMAIN") . "/Uploads/verifyinfo/" . $uploadsfzbm : "http://" . C("DOMAIN");
    $uploadscsfz = $uploadscsfz != '' ? "http://" . C("DOMAIN") . "/Uploads/verifyinfo/" . $uploadscsfz : "http://" . C("DOMAIN");
    
    $liststr = '<li><a href="' . $uploadsfzzm . '" target="_blank">查看身份证正面</a></li><li class="divider"></li><li><a href="' . $uploadsfzbm . '" target="_blank">查看身份证反面</a></li><li class="divider"></li><li><a href="' . $uploadscsfz . '" target="_blank">查看手持身份证</a></li>';
    
    $Userverifyinfo = M("Userverifyinfo");
    $status = $Userverifyinfo->where("userid=" . $id)->getField("status");
    switch ($status) {
        case 2:
            return '<ul class="dropdown-menu">' . $liststr . '<li class="divider"></li><li class="divider"></li><li style="background-color:#8cbae5; color:#fff;"><a href="javascript:renzheng(' . $id . ');">修改为<strong style="color:#157d17">已认证</strong></a></li><li class="divider"></li><li style="background-color:#8cbae5; color:#fff;"><a href="javascript:weirenzheng(' . $id . ');">修改为<strong style="color:#ccc">未认证</strong></a></li></ul>';
            
            break;
        case 1:
            return ' <ul class="dropdown-menu">' . $liststr . '</ul>';
            break;
    }
}

function getinviteconfigzt($id)
{
    $Invitecode = M("Invitecode");
    $list = $Invitecode->where("id=" . $id)->find();

    switch ($list["inviteconfigzt"]) {
        case 0:
            return '<span style="color:#F00;">禁用</span>';
            break;
        case 1:
            if (time() < $list["yxdatetime"]) {
                return '可以使用';
            } else {
                return '<span style="color:#06C">已过期</span>';
            }
            break;
        case 2:
            return '<span style="color:#060;">已使用</span>';
            break;
    }
}

function payapiaccount($payapiid)
{
    $Payapiaccount = M("Payapiaccount");
    $list = $Payapiaccount->where("payapiid = " . $payapiid)->select();
    $str = "";
    foreach ($list as $key) {
        $str = $str . '<option value="' . $key["id"] . '">商户ID：' . $key['sid'] . '</option>';
    }
    return $str;
}

function articleclasslist($fatherid, $num = 0)
{
    $Articleclass = M("Articleclass");
    $list = $Articleclass->where("fatherid=" . $fatherid . " and status = 0 and type = 0")->select();
    $str = "";
    $f = "";
    $fc = "";
    for ($var = 0; $var < $num; $var ++) {
        $f = $f . "&nbsp;&nbsp;&nbsp;&nbsp;";
        $fc = "color:#06F";
    }
    foreach ($list as $key) {
        $str = $str . '<option value="' . $key["id"] . '" style="font-weight:bold;' . $fc . '">' . $f . $sjname . $key["classname"] . '</option>';
        $str = $str . articleclasslist($key["id"], ++ $num);
    }
    return $str;
}

function getarticleclass($id)
{
    $Articleclass = M("Articleclass");
    $classname = $Articleclass->where("id=" . $id)->getField("classname");
    return $classname;
}

function huoqutktype()
{
    $Tikuanconfig = M("Tikuanconfig");
    $tktype = $Tikuanconfig->where("websiteid=" . session("admin_websiteid") . " and userid = 0")->getField("tktype");
    if ($tktype == 1) {
        $tktypestr = "单笔";
    } else {
        $tktypestr = "比例";
    }
    return $tktypestr;
}

/**
 * 增加日志
 * @param $log
 * @param bool $name
 */
function addlog($log, $name = false)
{
    $Model = M('Updatelog');
    if (!$name) {
        session_start();
        $uid = session('userid');
        if ($uid) {
            $user = M('User')->field('username')->where(array('id' => $uid))->find();
            $data['name'] = $user['username'];
        } else {
            $data['name'] = '';
        }
    } else {
        $data['name'] = $name;
    }
    $data['t'] = time();
    $data['ip'] = $_SERVER["REMOTE_ADDR"];
    $data['log'] = $log;
    $Model->data($data)->add();
}
