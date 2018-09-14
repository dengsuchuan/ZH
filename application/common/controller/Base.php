<?php
/**
 * 基础控制器
 * 必须基础自 think\Controller.php
 */
namespace app\common\controller;

use think\Controller;
use think\facade\Session;
use app\common\model\Category;
use think\Db;
use app\common\model\Site;
use think\facade\Request;

class Base extends Controller
{
    /**
     * 初始化方法
     * 创建常量，公共方法
     * 在所有的方法之前被调用
     */
    protected function initialize()
    {
        $this->showNav();
        $this->getFav();
        $this->articleCount();
        $this->is_open();
    }

    //检查用户是否已经登录
    public function loginEd(){
        if(Session::has('user_id')){
            $this->error('客官，不能重复登录哟！','index/index');
        }
    }

    //检查用户是否未登陆
    public function isLogin(){
        if(!Session::has('user_id')){
            $this->error('客官，你还没有登录哟！','user/login');
        }
    }

    //显示全局分类导航
    protected function showNav(){
        //查询栏目表，获取所有的栏目信息
        $cateList = Category::all(function ($query){
            $query->where('status',1)->order('sort','asc');
        });
        //分类信息赋值给模版  nav.html
        $this->assign('cateList',$cateList);
    }

    //右边的内容
    protected function getFav(){
        //热门排行
        $pv = Db::table('zh_article')
            ->where('status',1)
            ->order('pv','desc')
            ->paginate(6);
        $this->view->assign('pv',$pv);
        //最新评论
        $comments = Db::table('zh_user_comments')
            ->where('status',1)
            ->order('create_time','desc')
            ->paginate(6);
        $this->view->assign('comments',$comments);
        $this->view->assign('empty','暂无信息');
    }

    //获得文章统计信息
    protected  function articleCount(){
        $articleCount = Db::query("select c.title,count(a.id) as count
                    from zh_article a right outer join zh_article_category c
                    on a.cate_id = c.id
                    group by a.cate_id;");
        $this->view->assign('articleCount',$articleCount);
    }

    //检查站点是否关闭
    public function is_open(){
        //1.获取当前站点状态
        $isOpen = Site::where('status',1)->value('is_open');

        //2.如果站点已经关闭，那么只允许关闭前台
        if($isOpen == 0 && Request::module() == 'index'){
            $this->view->assign('title','站点已关闭 · 静影探风');
            //关闭网站
            $info = <<<'INFO'
<head>
    <title>站点关闭</title>
</head>
<body style="background-color: #0f0f0f">
    <center>
        <h1 style="color: white;font-size: 60px;margin-top: 400px;">
            【站点已关闭，暂时无法访问】
        </h1>
        <h2 style="color: red;font-size: 50px;">
            ###  预计维护时长:12小时  ###
        </h2>
    </center>
</body>
INFO;
            exit($info);
        }

    }



}