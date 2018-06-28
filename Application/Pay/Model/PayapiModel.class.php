<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-03-21
 * Time: 12:25
 */
namespace Pay\Model;
use Think\Model;

class PayapiModel extends Model{

    public function get_payapi($en_payname){
        $return = array();
        $_payapi = $this->where(array('en_payname'=>$en_payname))->find();
        $_payapiconfig = M('Payapiconfig')->where(array('payapiid'=>$_payapi['id']))->find();
        $return = array_merge($_payapi,$_payapiconfig);
        return $return;
    }

    public function get_defaultPayapi(){
        $return = array();
        $_payapiconfig = M('Payapiconfig')->where(array('default'=>1))->find();
        $_payapi = $this->where(array('id'=>$_payapiconfig['payapiid']))->find();
        $return = array_merge($_payapi,$_payapiconfig);
        return $return;
    }
}