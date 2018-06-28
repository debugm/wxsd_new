<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-04-01
 * Time: 22:15
 */
namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller{
    public $_site;
    public function __construct()
    {
        if($_SERVER['HTTP_HOST'] != C('DOMAIN')){
            die("系统升级中...");
        }
        parent::__construct();
        $this->_site = ((is_https()) ? 'https' : 'http') . '://' . C("DOMAIN") . '/';
        $this->assign('siteurl',$this->_site);
        $this->assign('sitename',C('WEB_TITLE'));
    }
}