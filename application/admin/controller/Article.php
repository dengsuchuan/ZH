<?php
namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\Article as ArticleModel;
use app\admin\common\model\Cate;
use app\common\model\Comments;
use app\common\model\Fav;
use think\facade\Request;
use think\facade\Session;

class Article extends Base
{
    //渲染登录界面
    public function index(){
        //判断用户是否登录
        $this->isLogin();

        $this->view->assign('title','文章管理');
        return $this->redirect('articleList');
    }

    //文章列表
    public function articleList(){
        //判断用户是否登录
        $this->isLogin();
        //获取当前用户的ID和用户权限
        $userId = Session::get('admin_id');
        $isAdmin = Session::get('admin_level');
        //获取当前用户发布的文章
        $articleList = ArticleModel::where('user_id',$userId)->order('create_time','desc')->paginate(10);
        //管理员获取全部文章
        if($isAdmin == 1){
            $articleList = ArticleModel::order('create_time','desc')->paginate(10);
        }
        //设置必要的模版变量
        $this->view->assign('title','文章管理');
        $this->view->assign('empty','<span style="color: red">没有文章</span>');
        $this->view->assign('articleList',$articleList);
        //渲染分类模版
        return $this->view->fetch('articleList');
    }

    //渲染编辑界面
    public function articleEdit(){
        $articleId = Request::param('id');
        $articleInfo = ArticleModel::where('id',$articleId)->find();
        $cateInfo = Cate::all();


        $this->view->assign('title','修改文章');
        $this->view->assign('cateInfo',$cateInfo);
        $this->view->assign('articleInfo',$articleInfo);
        return $this->view->fetch('articleEdit');
    }

    //保存栏目更新
    public function doSave(){
        $data = Request::param();       //获取所有传递过来的name
        $titleImg = Request::file('new_img');   //获取上传的file文件

        if($titleImg){      //判断是否有文件上传
            $info = $titleImg->validate([
                'size'=>1000000,
                'ext'=>'jpeg,jpg,png,gif',
            ])->move('uploads/');
            $file = 'uploads/'.$data['title_img'];
            //检查文件是否存在
            if(file_exists($file)){
                unlink($file);//删除旧的文件
            }
            $data['title_img'] = $info->getSaveName(); //将新的文件名给数组
        }
        //echo dump($data);
        $res = ArticleModel::where('id',$data['id'])->update($data);


        if($res){
            $this->success('修改成功','admin/article/articleList');
        }


        $this->error('修改失败，请检查输入项');
    }


    //删除文章以及文章图片
    public function del(){
        $artId = Request::param('id');
        $data = ArticleModel::where('id',$artId)->find();//查询文章信息

        //1.删除数据库中的文章
        $res1 = ArticleModel::where('id',$artId)->delete();

        //2.删除文章的标题图片
        $file = 'uploads/'.$data['title_img'];
        //检查文件是否存在
        if(file_exists($file)){
            //echo file_exists($file);
            //echo $file;
            unlink($file);//文件
        }
        //3.删除文章中的所有评论
        Comments::where('art_id',$artId)->delete();
        //4.删除文章的收藏
        Fav::where('art_id',$artId)->delete();

        if($res1){
            return $this->success('删除成功','admin/article/articleList');
        }else{
            return $this->error('删除失败');
        }


    }

}