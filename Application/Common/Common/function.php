<?php

/**
 * 系统邮件发送函数
 * @param string $SendAddress    接收邮件者邮箱
 * @param string $subject 邮件主题 
 * @param string $MsgHTML    邮件内容
 * @param int $Websiteid  分站ID
 */
function think_send_mail($SendAddress, $Subject = "支付平台", $MsgHTML = "支付平台", $Websiteid = 0)
{
    $Email = M('Email');
    $config = $Email->where("websiteid=" . $Websiteid)->find();
    Vendor('PHPMailer.PHPMailerAutoload');
    $mail = new PHPMailer();
    $mail->SMTPDebug = 0;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $config['smtp_host'];  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->CharSet = 'UTF-8';
    $mail->Username = $config['smtp_user'];                 // SMTP username
    $mail->Password = $config['smtp_pass'];                           // SMTP password
    if($config['smtp_host'] == 'smtp.qq.com' || $config['smtp_port']==465){
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    }
    $mail->Port = $config['smtp_port'];                                    // TCP port to connect to
    $mail->setFrom($config['smtp_email'],$config['smtp_name']);
    $mail->addAddress($SendAddress);               // Name is optional
    $mail->AddReplyTo($config['smtp_email'], $config['smtp_name']);
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body    = $MsgHTML;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    return $mail->Send() ? true : $mail->ErrorInfo;
}

function phpexcelobject()
{
    Vendor('PHPExcel175.PHPExcel');
    $objPHPExcel = new PHPExcel();
    return $objPHPExcel;
}

/**
 * 金额格式化函数
 */
function doFormatMoney($money)
{
    $tmp_money = strrev($money);
    $format_money = "";
    for ($i = 3; $i < strlen($money); $i += 3) {
        $format_money .= substr($tmp_money, 0, 3) . ",";
        $tmp_money = substr($tmp_money, 3);
    }
    $format_money .= $tmp_money;
    $format_money = strrev($format_money);
    return $format_money;
}

function random_str($length = 32)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $str ="";
    for ( $i = 0; $i < $length; $i++ ){
        $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
    }
    return $str;
}

function getusername($id)
{
    if ($id == 0) {
        return "-";
    }

    $User = M("User");
    $username = $User->where("id=" . $id)->getField("username");
    return $username;
}

function successregemail($username, $email, $activate, $websiteid)
{
    $Websiteconfig = M("Websiteconfig");
    $_webconfig = $Websiteconfig->where("websiteid = " . $websiteid)->find();
    $websitename = $_webconfig["websitename"];
    $domain = $_webconfig["domain"];
    $qqlist = $_webconfig["qq"];
    $tel = $Websiteconfig->where("websiteid = 0")->getField("tel");
    
    $contentstr = "亲爱的会员：<span style='color:#F30;'>" . $username . "</span> 您好！ <br />";
    $contentstr = $contentstr . "感谢您注册【" . $websitename . "】！ <br />";
    $contentstr = $contentstr . "您现在可以激活您的账户，激活成功后，您可以使用【" . $websitename . "】提供的各种支付服务。  <br />";
    $contentstr = $contentstr . "<a href='http://" . $domain . "/Activate_" . $activate . ".html' target='_blank'>点此激活支付平台账户 </a> <br />";
    $contentstr = $contentstr . "如果上述文字点击无效，请把下面网页地址复制到浏览器地址栏中打开 <br />";
    $contentstr = $contentstr . "http://" . $domain . "/Activate_" . $activate . ".html <br />";
    $contentstr = $contentstr . "此为系统邮件，请勿回复 <br />";
    $contentstr = $contentstr . "请保管好您的邮箱，避免账户被他人盗用 <br />";
    $contentstr = $contentstr . "如有任何疑问，可查【" . $websitename . "】网站访问 <a href='http://" . $domain . "/' target='_blank'>" . $domain . "</a> <br />";
    
    $qqlist = explode("|", $qqlist);
    $qqstr = "";
    foreach ($qqlist as $key => $val) {
        $qqstr = $qqstr . ' <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=' . $val . '&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:' . $val . ':51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>&nbsp;&nbsp;';
    }
    
    $contentstr = $contentstr . " " . $qqstr . " 联系电话：" . $tel . " <br />";
    
    think_send_mail($email, $websitename . "【账号激活】邮件", $contentstr, $websiteid);
}

function usertype($user_type)
{
    switch ($user_type) {
        case 0:
            return "系统总管理员";
            break;
        case 1:
            return "系统子管理员";
            break;
        case 2:
            return "分站管理员";
            break;
        case 3:
            return "分站子管理员";
            break;
        case 4:
            return "普通商户";
            break;
        case 5:
            return "普通代理商";
            break;
        case 6:
            return "独立代理商";
            break;
    }
}

function sjusertype($id)
{
    $User = M("User");

    $usertype = $User->where("id=" . $id)->getField("usertype");

    switch ($usertype) {
        case 0:
            return "系统总管理员";
            break;
        case 1:
            return "系统子管理员";
            break;
        case 2:
            return "分站管理员";
            break;
        case 3:
            return "分站子管理员";
            break;
        case 4:
            return "普通商户";
            break;
        case 5:
            return "普通代理商";
            break;
        case 6:
            return "独立代理商";
            break;
    }
}

function sjusername($id, $s = 0)
{
    $User = M("User");

    // $username = $User->where("id=".$id)->getField("username");
    if (! $id) {
        return "-";
    }
    $find = $User->where("id=" . $id)->find();

    if ($find["usertype"] == 0) {
        return " 总管理员";
    } else {
        if ($s == 0) {
            return "<a href='?usernameidsearch=" . $find["username"] . "&usertype=" . $find["usertype"] . "'>" . $find["username"] . "</a>";
        } else {
            return $find["username"];
        }
    }

    // return $username;
}

function shanghubianhao($id)
{
    return 10000 + $id;
}

function zhuangtai($id)
{
    switch ($id) {
        case 0:
            return '<span class="label label-default">未激活</span>';
            break;
        case 1:
            return '<span class="label label-success">正常</span>';
            break;
        case 2:
            return '<span class="label label-danger">已禁用</span>';
            break;
    }
}

function renzheng($id)
{
    $Userverifyinfo = M("Userverifyinfo");
    $status = $Userverifyinfo->where("userid=" . $id)->getField("status");
    switch ($status) {
        case 0:
            return '<span class="label label-default">未认证</span>';
            break;
        case 1:
            return '<span class="label label-success">已认证</span>';
            break;
        case 2:
            return '<span class="label label-warning">等待审核</span>';
            break;
    }
}

function liuliangzongyue($id)
{
    $Money = M("Money");
    $summoney = $Money->where("userid=" . $id)->getField("wallet");
    return $summoney ? $summoney : '0.00';
}


function zhanghuzongyue($id)
{
    $Money = M("Money");
    $summoney = $Money->where("userid=" . $id)->getField("money");
    return $summoney ? $summoney : '0.00';
}

function qianbaoyue($id)
{
    $Money = M("Money");
    $wallet = $Money->where("userid=" . $id)->getField("wallet");
    return $wallet;
}

function realityfeilv($payapiid, $userid, $feilv, $defaultpayapiuserid = 0)
{
    if ($feilv != 0) {
        return ($feilv * 1000) . "‰";
    } else {
        if ($defaultpayapiuserid == 0) {
            $Payapiaccount = M("Payapiaccount");
            $feilv = $Payapiaccount->where("payapiid=" . $payapiid . " and defaultpayapiuser=1")->getField("defaultrate");
            return ($feilv * 1000) . "‰";
        } else {
            $Payapiaccount = M("Payapiaccount");
            $feilv = $Payapiaccount->where("id=" . $defaultpayapiuserid)->getField("defaultrate");
            return ($feilv * 1000) . "‰";
        }
    }
}

function realityfengding($payapiid, $userid, $fengding, $defaultpayapiuserid = 0)
{
    if ($fengding != 0) {
        return $fengding;
    } else {
        if ($defaultpayapiuserid == 0) {
            $Payapiaccount = M("Payapiaccount");
            $fengding = $Payapiaccount->where("payapiid=" . $payapiid . " and defaultpayapiuser=1")->getField("fengding");
            return $fengding;
        } else {
            $Payapiaccount = M("Payapiaccount");
            $fengding = $Payapiaccount->where("id=" . $defaultpayapiuserid)->getField("fengding");
            return $fengding;
        }
    }
}
function grmstatus($pay_status)
{
    switch ($pay_status) {
        case 0:
            return "<span style='color:#f00'>未处理</span>";
            break;
        case 1:
            return "<span style='color:#F60'>上分成功</span>";
            break;
        case 2:
            return "<span style='color:#030'>上分失败</span>";
            break;
        case 3:
            return "<span style='color:#030'>补单成功</span>";
            break;
        case 4:
            return "<span style='color:#030'>补单失败</span>";
            break;
        case 5:
            return "<span style='color:#030'>手动补单</span>";
            break;
    }
}

function status($pay_status)
{
    switch ($pay_status) {
        case 0:
            return "<span style='color:#f00'>未处理</span>";
            break;
        case 1:
            return "<span style='color:#F60'>成功,未返回</span>";
            break;
        case 2:
            return "<span style='color:#030'>成功,已返回</span>";
            break;
    }
}

function tongji($id)
{
    if($id){
        $Websiteconfig = D("Websiteconfig");
        $tongji = $Websiteconfig->where("websiteid=0")->getField("tongji");
        $content = str_replace("&lt;", "<", $tongji);
        $content = str_replace("&gt;", ">", $content);
        $content = str_replace("%22", "", $content);
        $content = str_replace("&quot;", '"', $content);
        $content = str_replace("&amp;", "&", $content);

        return '<div style="display:none;">' . $content . '</div>';
    }else{
        return '<div style="display:none;"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id=\'cnzz_stat_icon_1261742514\'%3E%3C/span%3E%3Cscript src=\'" + cnzz_protocol + "s11.cnzz.com/stat.php%3Fid%3D1261742514\' type=\'text/javascript\'%3E%3C/script%3E"));</script></div>';
    }

}

function HTMLHTML($content)
{
     $content = str_replace("&lt;","<",$content);
     $content = str_replace("&gt;",">",$content);
     $content = str_replace("%22","",$content);
     $content = str_replace("&quot;",'"',$content);
     $content=str_replace( "&amp;","&",$content);
    return $content;
}

function browserecord($articleid)
{
    $Browserecord = M("Browserecord");

    $count = $Browserecord->where(array('articleid'=>$articleid,'userid'=>session("userid")))->count();
    $str = "";
    if ($count <= 0) {
        $str = $str . '<img src="/Public/images/new.gif">';
    }
    
    $Article = M("Article");

    $count = $Article->where(array('id'=>$articleid,'jieshouuserlist'=>array('like','%" . session("userid") . "|%')))->count();
    if ($count <= 0) {
        $str = $str . ' <img src="/Public/images/shi.png">';
    }
    
    return $str;
}

function browsenum($articleid)
{
    $Browserecord = M("Browserecord");
    $count = $Browserecord->where("articleid=" . $articleid)->count();
    if ($count > 0) {
        return $count;
    } else {
        return 0;
    }
}

function jieshouuserlist($list)
{
    if ($list == "0|") {
        return "全部";
    } else {
        $array = explode("|", $list);
        $str = "";
        foreach ($array as $key => $val) {
            if ($val) {
                $str = $str . "【" . ($val + 10000) . "】";
            }
        }
        return $str;
    }
}

function zjbdlx($lx, $orderid)
{
    $str = "";
    switch ($lx) {
        case 1:
            $str = "账户充值(<span style='color:#999'>" . $orderid . "</span>)";
            break;
    }
    return $str;
}

function bdje($money)
{
    $strmoney = "";
    if ($money < 0) {
        $strmoney = "<span style='color:#f6a000'>" . $money . "</spa>";
    } else {
        $strmoney = "<span style='color:#53a057'>+" . $money . "</spa>";
    }
    return $strmoney;
}

function huoqutongdaoname($id)
{
    $Payapi = M("Payapi");
    $zh_payname = $Payapi->where(array('id'=>$id))->getField("zh_payname");
    return $zh_payname;
}

function moneychangeadd($ArrayField)
{
    $Moneychange = M("Moneychange");
    foreach ($ArrayField as $key => $val) {
        $data[$key] = $val;
    }
    $Moneychange->add($data);
}

function del0($s)
{ // 去除数字后面的零
    $s = trim(strval($s));
    if (preg_match('#^-?\d+?\.0+$#', $s)) {
        return preg_replace('#^(-?\d+?)\.0+$#', '$1', $s);
    }
    if (preg_match('#^-?\d+?\.[0-9]+?0+$#', $s)) {
        return preg_replace('#^(-?\d+\.[0-9]+?)0+$#', '$1', $s);
    }
    return $s;
}

function huoquddlx($transid){
    $Order = M("Order");
    $ddlx = $Order->where("pay_orderid='".$transid."'")->getField("ddlx");
    $ddlx==0?$lxname="<spans style='color:#060;'>充值订单</span>":$lxname="收款订单";
    return $lxname;
}


function randpw($len=8,$format='ALL'){
    $is_abc = $is_numer = 0;
    $password = $tmp ='';
    switch($format){
        case 'ALL':
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
        case 'CHAR':
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case 'NUMBER':
            $chars='0123456789';
            break;
        default :
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
    }
    mt_srand((double)microtime()*1000000*getmypid());

    while(strlen($password)<$len){

        $tmp =substr($chars,(mt_rand()%strlen($chars)),1);
        if(($is_numer <> 1 && is_numeric($tmp) && $tmp > 0 )|| $format == 'CHAR'){
            $is_numer = 1;
        }
        if(($is_abc <> 1 && preg_match('/[a-zA-Z]/',$tmp)) || $format == 'NUMBER'){
            $is_abc = 1;
        }
        $password.= $tmp;
    }
    if($is_numer <> 1 || $is_abc <> 1 || empty($password) ){
        $password = randpw($len,$format);
    }
    return $password;
}
/*
 * HTTP、HTTPS判断
 */
function is_https(){
    if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return TRUE;
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
        return TRUE;
    } elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return TRUE;
    }
    return FALSE;
}
function arrayToXml($arr)
{
    $xml = "<xml>";
    foreach ($arr as $key=>$val)
    {
        if (is_numeric($val)){
            $xml.="<".$key.">".$val."</".$key.">";
        }else{
            $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
        }
    }
    $xml.="</xml>";
    return $xml;
}

//将XML转为array
function xmlToArray($xml)
{
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $values;
}

function get_requestord()
{
    return date('YmdHis').substr(implode(NULL, array_map('ord', str_split(substr(uniqid('',true), 7, 17), 1))), 0, 6);
}

//判断是否是手机端还是电脑端
function isMobile() {
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
    $mobile_browser = '0';
    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        $mobile_browser++;
    if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
        $mobile_browser++;
    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
        $mobile_browser++;
    if(isset($_SERVER['HTTP_PROFILE']))
        $mobile_browser++;
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
        'wapr','webc','winw','winw','xda','xda-'
    );
    if(in_array($mobile_ua, $mobile_agents))
        $mobile_browser++;
    if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
        $mobile_browser++;
    // Pre-final check to reset everything if the user is on Windows
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
        $mobile_browser=0;
    // But WP7 is also Windows, with a slightly different characteristic
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
        $mobile_browser++;
    if($mobile_browser>0)
        return true;
    else
        return false;
}

//导出CSV
function exportCsv($list,$title){
    $file_name="CSV".date("mdHis",time()).".csv";
    header ( 'Content-Type: application/vnd.ms-excel' );
    header ( 'Content-Disposition: attachment;filename='.$file_name );
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    $file = fopen('php://output',"a");
    $limit=10000;
    $calc=0;
    //列名
    foreach ($title as $v){
        $tit[]=iconv('UTF-8', 'GB2312//IGNORE',$v);
    }
    //将数据通过fputcsv写到文件句柄
    fputcsv($file,$tit);

    foreach ($list as $v){
        $calc++;
        if($limit==$calc){
            ob_flush();
            flush();
            $calc=0;
        }
        foreach ($v as $t){
            $tarr[]=iconv('UTF-8', 'GB2312//IGNORE',$t);
        }
        fputcsv($file,$tarr);
        unset($tarr);
    }
    unset($list);
    fclose($file);
    exit();
}

/**
 *
 */
function sendForm($url,$data,$referer){
    $headers['Content-Type'] = "application/x-www-form-urlencoded; charset=utf-8";
    $headerArr = array();
    foreach( $headers as $n => $v ) {
        $headerArr[] = $n .':' . $v;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArr);
    curl_setopt($ch, CURLOPT_REFERER, "http://".$referer."/");
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

/**
 * 写日志，方便测试（看网站需求，也可以改成把记录存入数据库）
 * 注意：服务器需要开通fopen配置
 * @param $word 要写入日志里的文本内容 默认值：空值
 */
function logResult($word = '') {
    $fp = fopen ( "log.txt", "a" );
    flock ( $fp, LOCK_EX );
    fwrite ( $fp, "执行日期：" . strftime ( "%Y%m%d%H%M%S", time () ) . "\n" . $word . "\n" );
    flock ( $fp, LOCK_UN );
    fclose ( $fp );
}
?>
