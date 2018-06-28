<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-03-21
 * Time: 11:18
 */
namespace Pay\Model;
use Think\Model;

class UserModel extends Model{


    public function get_Userinfo($uid){
        $return = array();
        $_user = $this->where(array('id'=>$uid))->find();
        $_userbasicinfo = M('Userbasicinfo')->where(array('userid'=>$uid))->field('fullname,sex,birthday,sfznumber,phonenumber,qqnumber,address')->find();
        $_userpassword = M('Userpassword')->where(array('userid'=>$uid))->field('loginpassword,paypassword')->find();
        $_userpayapi = M('Userpayapi')->where(array('userid'=>$uid))->field('payapicontent,defaultpayapi')->find();
        $_userpayapizhanghao = M('Userpayapizhanghao')->where(array('userid'=>$uid))->field('payapiid,defaultpayapiuserid,feilv,fengding')->find();
        $_userverifyinfo = M('Userverifyinfo')->where(array('userid'=>$uid))->field('uploadsfzzm,uploadsfzbm,uploadscsfz,uploadyhkzm,uploadyhkbm,uploadyyzz,status,domain,md5key')->find();
        $_userverifyinfo['rzstatus'] = $_userverifyinfo['status'];
        unset($_userverifyinfo['status']);
        $return = array_merge($_user ,$_user,$_userbasicinfo,$_userpassword,$_userpayapi,$_userpayapizhanghao,$_userverifyinfo);
        return $return;
    }
}