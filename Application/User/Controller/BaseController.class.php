<?php
/**
 * Created by PhpStorm.
 * User: gaoxi
 * Date: 2017-04-03
 * Time: 1:56
 */

namespace User\Controller;

use Think\Controller;

class BaseController extends Controller {
    public $_site;
    public function __construct()
    {
        parent::__construct();
        $this->_site = ((is_https()) ? 'https' : 'http') . '://' . C("DOMAIN") . '/';
        $this->assign('siteurl',$this->_site);
        $this->assign('sitename',C('WEB_TITLE'));
    }
}