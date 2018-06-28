<?php
namespace Admin\Controller;

use Think\Controller;

class SystemController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->assign("Public", MODULE_NAME); // 模块名称
    }

    public function index(){
    	
    }

	public function Editpassword(){    //修改管理员密码
         $ypassword = I("post.ypassword","");
         $newpassword = I("post.newpassword","");
         $newpasswordok = I("post.newpasswordok","");
         $Userpassword = M("Userpassword");
         $count = $Userpassword->where("userid='".session("admin_userid")."' and loginpassword='".md5($ypassword)."'")->count();
         if($count == 1){
             if($newpassword == "" || $newpasswordok == ""){
                 exit("b");  
             }else{
                 if($newpassword != $newpasswordok){
                     exit("c");
                 }else{
                     if($ypassword == $newpassword){
                         exit("d");
                     }else{
                         $Userpassword->where("userid='".session("admin_userid")."'")->setField("loginpassword",md5($newpassword));
                         exit("ok");
                     }
                     
                 }
             }
         }else{
             exit("a");
         }
    }

    /**
     * 基本设置
     */
    public function jbsz()
    {
        $Websiteconfig = D("Websiteconfig");
        $list = $Websiteconfig->where("websiteid=0")->find();
        $this->assign("vo", $list);
        $this->display();
    }

    public function jbszedit()
    {
        $Websiteconfig = D("Websiteconfig");
        
        if (! $Websiteconfig->create()) {
            exit($Websiteconfig->getError());
        } else {
            if ($Websiteconfig->save() == false) {
                exit("修改失败，请稍后重试！");
            } else {
                $websitename = I("post.websitename");
                $domain = I("post.domain");
                $directory = I("post.directory") == "" ? "Admin" : I("post.directory");
                $login = I("post.login") == "" ? "Login" : I("post.login");
                // //////////////////////////////////////////////////////////////////////
                $str = "";
                
                $str = "<?php \n";
                $str .= "\t\treturn array(\n";
                $str .= "\t\t\t'WEB_TITLE' => '" . $websitename . "',\n";
                $str .= "\t\t\t'DOMAIN' => '" . $domain . "',\n";
                $str .= "\t\t\t'MODULE_ALLOW_LIST'   => array('Home','User','" . $directory . "','Install','Weixin','Pay'),\n";
                if ($directory != "Admin") {
                    $str .= "\t\t\t'URL_MODULE_MAP'  => array('" . $directory . "'=>'admin'),\n";
                }
                $str .= "\t\t\t'LOGINNAME' => '" . $login . "',\n";
                $str .= "\t\t\t'HOUTAINAME' => '" . $directory . "',\n";
                $str .= "\t\t);\n";
                $str .= "?>";
                
                if ($test = fopen("Application/Common/Conf/website.php", "w")) {
                    fwrite($test, $str);
                }
                
                fclose($test);
                // /////////////////////////////////////////////////////////////////////
                exit("修改成功！");
            }
        }
    }

    public function emailsz()
    { // 邮箱设置
        $Email = M("Email");
        $list = $Email->where("websiteid=0")->find();
        $this->assign("vo", $list);
        $this->display();
    }

    public function emailszedit()
    {
        if(IS_POST){
            $_formdata = array(
                'smtp_host'=>I('post.smtp_host'),
                'smtp_port'=>I('post.smtp_port'),
                'smtp_user'=>I('post.smtp_user'),
                'smtp_pass'=>I('post.smtp_pass'),
                'smtp_email'=>I('post.smtp_email'),
                'smtp_name'=>I('post.smtp_name'),
            );
        }
        $Email = M("Email");
        if(I('post.id')){
            $result = $Email->where(array('id'=>I('post.id'),'websiteid'=>0))->save($_formdata);
        }else{
            $_formdata['websiteid'] = 0;
            $result = $Email->add($_formdata);
        }

        if ($result) {
            exit("修改成功！");
        } else {
            exit("修改失败！");
        }
    }

    public function csfamail()
    {
        $cs_email = I('request.cs_text', '');
        if ($cs_email == '') {
            exit("测试收件邮箱地址不能为空");
        } else {
            $ReturnEmail = think_send_mail($cs_email, '测试邮件', '测试邮件', 0);
            if ($ReturnEmail == 1) {
                exit("测试邮件发送成功，请注意查收！");
            } else {
                exit("发送失败，错误信息：" . $ReturnEmail);
            }
            exit($ReturnEmail);
        }
    }

    public function smssz()
    {
        $Sms = M("Sms");
        
        $list = $Sms->where("websiteid=0")->select();
        
        $this->assign("list", $list);
        
        $this->display();
    }

    public function smsszedit()
    {
        $Sms = M("Sms");
        
        $Sms->create();
        
        if ($Sms->save()) {
            exit("修改成功！");
        } else {
            exit("修改失败！");
        }
    }

    public function csfasms()
    {
        $cs_email = I('request.cs_text', '');
        if ($cs_email == '') {
            exit("测试接收手机号不能为空");
        } else {
            $ReturnEmail = PHPFetion($cs_email, "测试短信", 0);
            if ($ReturnEmail == 1) {
                exit("测试短信发送成功，请注意查收！");
            } else {
                exit("发送失败，错误信息：" . $ReturnEmail);
            }
            exit($ReturnEmail);
        }
    }
}
?>
