<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-03-21
 * Time: 11:18
 */
namespace Pay\Model;
use Think\Model;

class MemberModel extends Model{

    public function get_Userinfo($uid){
        $return = array();
        $_user = $this->where(array('id'=>$uid))->find();
        $_userpayapizhanghao = M('Userpayapizhanghao')->where(array('userid'=>$uid))->field('payapiid,defaultpayapiuserid,feilv,fengding')->select();
        $return = array_merge($_user ,$_user,$_userpayapizhanghao);
        return $return;
    }
}