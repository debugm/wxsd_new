<?php
namespace Admin\Controller;

use Think\Controller;

class ContentController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->assign("Public", MODULE_NAME); // 模块名称
    }

    public function articleclassaddadd()
    {
        $Articleclass = M("Articleclass");
        $Articleclass->create();
        if ($Articleclass->add()) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function articleclasslist()
    {
        $Articleclass = M("Articleclass");
        $list = $Articleclass->select();
        $this->assign("list", $list);
        $this->display();
    }

    public function articledel()
    {
        $Articleclass = M("Articleclass");
        $id = I("post.id",0,'intval');
        if (! $id) {
            exit("no");
        } else {
            $count = $Articleclass->where("fatherid=" . $id)->count();
            if ($count > 0) {
                exit("nono");
            } else {
                if ($Articleclass->where("id=" . $id)->delete()) {
                    exit("ok");
                } else {
                    exit("no");
                }
            }
        }
    }

    public function articlclassedit()
    {
        $id = I("get.id",0,'intval');
        $Articleclass = M("Articleclass");
        $find = $Articleclass->where("id=" . $id)->find();
        $this->assign("find", $find);
        $this->display();
    }

    public function articleclasseditedit()
    {
        $Articleclass = M("Articleclass");
        $Articleclass->create();
        if ($Articleclass->save()) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function pduserid()
    {
        $userid = I("post.userid",0,'intval');
        $userid = $userid - 10000;
        $User = M("User");
        $count = $User->where("id=" . $userid)->count();
        if ($count > 0) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function articleaddadd()
    {
        $Article = M("Article");
        $data[title] = I("post.title",'','strip_tags');
        $data["articleclassid"] = I("post.articleclassid");
        $data["status"] = I("post.status");
        $data["jieshouuserlist"] = I("post.jieshouuserlist");
        $data["content"] = I("post.content");
        $data["datetime"] = date("Y-m-d H:i:s");
        $data["userid"] = session("admin_userid");
        if ($id = $Article->add($data)) {
            // exit("ok");
            $Browserecord = M("Browserecord");
            $data = array();
            $data["articleid"] = $id;
            $data["userid"] = 0;
            $data["datetime"] = date("Y-m-d H:i:s");
            $Browserecord->add($data);
           $this->success("文章添加成功！");
        } else {
            // exit("no");
            $this->error('文章添加失败！');
        }
    }

    public function articleeditedit()
    {
        $Article = M("Article");
        $Article->create();
        if ($Article->save()) {
            $this->success("文章修改成功！");
        } else {
            $this->error('文章修改失败！');
        }
    }

    public function articlelist()
    {
        $where = array();
        $i = 0;
        $memberid = I("get.memberid");
        if ($memberid) {
            $where[$i] = "title like '%" . $memberid . "%'";
            $i ++;
        }
        $articleclassid = I("get.articleclassid");
        if ($articleclassid) {
            $where[$i] = "articleclassid = " . $articleclassid;
            $i ++;
        }
        $tjdate_ks = I("get.tjdate_ks");
        if ($tjdate_ks) {
            $where[$i] = " DATEDIFF('" . $tjdate_ks . "',datetime) <= 0";
            ;
            $i ++;
        }
        $tjdate_js = I("get.tjdate_js");
        if ($tjdate_js) {
            $where[$i] = " DATEDIFF('" . $tjdate_js . "',datetime) >= 0";
            ;
            $i ++;
        }
        
        $list = $this->lists("Article", $where);
        $this->assign("list", $list);
        $this->display();
    }

    public function ContentEdit()
    {
        $id = I("get.id");
        $Articleclass = M("Articleclass");
        $find = $Articleclass->where("id=" . $id)->find();
        $this->assign("find", $find);
        $this->display();
    }

    public function ContentEditEdit()
    {
        $id = I("post.id");
        $Articleclass = M("Articleclass");
        $data["content"] = I("post.content");
        if ($Articleclass->where("id=" . $id)->save($data)) {
            exit("ok");
        } else {
            exit("no");
        }
    }

    public function articlecontent()
    {
        $id = I("request.id");
        $Article = M("Article");
        $find = $Article->where("id=" . $id)->find();
        $find["content"] = HTMLHTML($find["content"]);
        $this->ajaxReturn($find);
    }

    public function browsenum()
    {
        $id = I("request.id");
        $Browserecord = M("Browserecord");
        $list = $Browserecord->where("articleid=" . $id)
            ->limit(20)
            ->select();
        $this->ajaxReturn($list);
    }

    public function delaritcle()
    {
        $id = I("request.id",0);
        $Article = M("Article");
        $Article->delete(intval($id));
        exit("ok");
    }

    public function articleedit()
    {
        $id = I("request.id");
        $Article = M("Article");
        $find = $Article->where("id=" . $id)->find();
        if ($find) {
            $this->assign("find", $find);
            $this->display();
        } else {
            exit("请不要非法提交！");
        }
    }
}
?>