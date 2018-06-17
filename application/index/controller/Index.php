<?php
namespace app\index\controller;

use app\common\controller\Base; //导入公共控制器
use app\common\model\Category;
use app\common\model\Article;
use app\common\model\Like;
use app\common\model\Fav;
use app\common\model\Comments;
use think\facade\Request;
use think\Db;

class Index extends Base
{
    //首页
    public function index()
    {
        //右边的公共部分
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

        //分类信息获取
        $cateId = Request::param('cate_id');
        //如果存在cate_id  分类ID
        if(isset($cateId)){
            $res = Category::get($cateId);
            $this->view->assign('cateName',$res->title);
        }

        //列表分页显示
        if(isset($cateId)){
            $artList = Db::table('zh_article')
                ->where('status',1)
                ->where('cate_id',$cateId)
                ->order('create_time','desc')
                ->paginate(5);
        }else{
            $artList = Db::table('zh_article')
                ->where('status',1)
                ->order('create_time','desc')
                ->paginate(5);
        }

        //实现搜索功能
        $keyword = Request::param('keyword');
        if(isset($keyword)){
            $map = [];//将所有的查询条件封装到数组中
            $map[] = ['status','=',1];
            $map[] = ['title','like','%'.$keyword.'%'];
            $artList = Db::table('zh_article')
                ->where($map)
                ->order('create_time','desc')
                ->paginate(5);
            $this->assign('artList',$artList);
        }

       //首页模版赋值
       // $this->view->assign('contentList',$contentList);
        $this->view->assign('artList',$artList);

        return $this->view->fetch('index',['title'=>'静影探风·首页','empty'=>'<h1>没有数据</h1>']);
    }

    //发表文章页面生成
    public function insert(){
        //1.用户必须登录才可以发布文章
        $this->isLogin();
        //2.设置页面标题
        //3.获取栏目学习
        $cateList = Category::all();
        if(count($cateList) > 0){
            //将查询到的栏目学校赋值到模版
            $this->assign('cateList',$cateList);
        }else{
            $this->error('栏目不存在，请先添加栏目','index/index');
        }
        //4.渲染模版
        return $this->view->fetch('insert');
    }

    //保存文章
    public function save(){
        if(Request::isPost()){
            $data = Request::post();
            $validate = 'app\common\validate\Article';
            $res = $this->validate($data,$validate);
            if(true !== $res){
                $this->error('文章发表失败: '.$res,null,null,3);
                //halt($res);
            }else{
                $file = Request::file('title_img');
                if($file){
                    $info = $file->validate([
                        'size'=>1000000,
                        'ext'=>'jpeg,jpg,png,gif',
                    ])->move('uploads/');
                }else{
                    $this->error('没有发现上传的文件，请重新选择上传');
                }
                if($info){
                    $data['title_img'] = $info->getSaveName();
                }else{
                    $this->error($file->getError());
                }
                if(Article::create($data)){
                    $this->success('发表成功，正在跳转到首页','index/index');
                }else{
                    $this->error('发表失败');
                }
            }
        }else{
            $this->error('请求类型错误');
        }
    }

    //模态框内评论获取
    public function getModalComments(){
        $id = Request::get();

        $id = $id['artId'];
        $artCommentsList= Db::query("select u.name,c.* 
                                        from zh_user u right outer join zh_user_comments c 
                                        on u.id = c.user_id
                                        where c.art_id = $id 
                                        ORDER BY create_time DESC;
                                    ");

        Article::get(function ($query) use ($id){
           $query->where('id','=',$id)->setInc('pv');
        });

        return $artCommentsList;



    }

    //点赞
    public function like(){
        if(Request::isAjax()){
            $like = Request::get();
            //$validate = 'app\common\validate\Like';
            //$res = $this->validate($like,$validate);
            $artId = $like['art_id'];
            $userId = $like['user_id'];
            $sql = " SELECT * FROM `zh_user_like` WHERE `art_id` = $artId and `user_id` = $userId";
            $res = Db::query($sql);
            //return $sql;
            if(count($res) == 0){
                Like::create($like);
                return 1;
            }else{
                return 0;
            }
        }
    }

    //收藏
    public function fav(){
        if(Request::isAjax()){
            $fav = Request::get();
            $artId = $fav['art_id'];
            $userId = $fav['user_id'];
            $sql = " SELECT * FROM `zh_user_fav` WHERE `art_id` = $artId and `user_id` = $userId";
            $res = Db::query($sql);
            if(count($res) == 0){
                Fav::create($fav);
                return 1;
            }else{
                return 0;
            }
        }
    }

    //保存发表的评论
    public function saveCom(){
        if(Request::isAjax()){
            $getComm = Request::get();
            $res = Comments::create(['user_id'=>$getComm['user_id'],'art_id'=>$getComm['art_id'],'content'=>$getComm['content']]);
            if(!$res){
                return false;
            }else{
                return true;
            }


        }

    }



}
