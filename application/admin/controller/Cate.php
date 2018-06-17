<?php
namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\Cate as CateModel;
use think\facade\Request;

class Cate extends Base
{
    //渲染登录界面
    public function index(){
        //判断用户是否登录
        $this->isLogin();

        $this->view->assign('title','分类管理');
        return $this->redirect('cateList');
    }

    //分类列表
    public function cateList(){
        //判断用户是否登录
        $this->isLogin();
        //获取所有分类
        $cateList = CateModel::all();
        //设置必要的模版变量
        $this->view->assign('title','分类管理');
        $this->view->assign('empty','<span style="color: red">没有分类</span>');
        $this->view->assign('cateList',$cateList);
        //渲染分类模版
        return $this->view->fetch('cateList');
    }

    //渲染编辑界面
    public function cateEdit(){
        $cateId = Request::param('id');
        $cateInfo = CateModel::where('id',$cateId)->find();
        $this->view->assign('title','编辑栏目');
        $this->view->assign('cateInfo',$cateInfo);
        return $this->view->fetch('cateEdit');
    }

    //保存栏目更新
    public function doEdit(){
        $data = Request::param();

        $res = CateModel::update($data);
        if($res){
            $this->success('修改成功','admin/cate/cateList');
        }

        $this->error('修改失败，请检查输入项');
    }

    //添加新栏目
    public function cateAdd(){
        $cateList = CateModel::all();
        $this->view->assign('title','添加新栏目');
        $this->view->assign('cateList',$cateList);
        return $this->view->fetch('cateadd');
    }

    //删除栏目
    public function del(){
        $cateId = Request::param('id');
        $res = CateModel::where('id',$cateId)->delete();
        if($res){
            return $this->success('删除成功','admin/cate/cateList');
        }else{
            return $this->error('删除失败');
        }


    }

    //查询该栏目是否存在
    public function doSave(){
        if(Request::isAjax()){
            $cateData = Request::param();
            $cateList = CateModel::where('title',$cateData['title'])->find();
            if($cateList){
                return ['status'=>0,'message'=>'该栏目已存在，无法创建'];
            }else{
                $res = CateModel::create($cateData);
                if($res){
                    return ['status'=>1,'message'=>'创建成功:'.$cateData['title']];
                }else{
                    return ['status'=>-1,'message'=>'创建失败'];
                }
            }
        }
    }


}