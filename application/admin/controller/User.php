<?php
namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\User as UserModel;
use think\facade\Session;
use think\facade\Request;

class User extends Base
{
    //渲染登录界面
    public function login(){
         $this->view->assign('title','管理员登录');
        return $this->view->fetch();
    }

    //登录
    public function checkLogin(){
        $data = Request::param();
        //查询条件
        $map[] = ['email','=',$data['email']];
        $map[] = ['password','=',sha1($data['password'])];


        $result = UserModel::where($map)->find();

        if($result){
            Session::set('admin_id',$result['id']);
            Session::set('admin_name',$result['name']);
            Session::set('admin_level',$result['is_admin']);
            //设置普通用户状态的session
            Session::set('user_id',$result['id']);
            Session::set('user_name',$result['name']);
            $this->success('登录成功，正在跳转到后台 ','admin/user/userList');
        }

        $this->error('登录失败');

    }

    //退出登录
    public function loginOut(){
        //删除所有
        Session::clear();

        //单独删除
        Session::delete('admin_id');
        Session::delete('admin_name');
        Session::delete('admin_level');

        $this->success('退出成功，正在跳转到首页','/');
    }

    //用户列表
    public function userList(){
        //1.获取当前用户的id和级别is_admin
        $data['admin_id'] = Session::get('admin_id');
        $data['admin_level'] = Session::get('admin_level');

        //2.获取当前用户信息
        $userList = UserModel::where('id',$data['admin_id'])->select();

        //3.如果是超级管理员，获取全部信息
        if($data['admin_level'] ==1){
            $userList = UserModel::select();
        }

        //4.模版赋值
        $this->view->assign('title','用户管理');
        $this->view->assign('empty','<span style="color: red">没有数据</span>');
        $this->view->assign('userList',$userList);

        //5.渲染用户管理模版
        return $this->view->fetch('userList');
    }

    //编辑用户
    public function userEdit(){
        //1.获取用户主键的
        $userId = Request::param('id');
        //2.根据主键进行查询
        $userInfo = UserModel::where('id',$userId)->find();
        //3.设置模版变量
        $this->view->assign('title','编辑用户');
        $this->view->assign('userInfo',$userInfo);
        //渲染模版
        return $this->view->fetch('userEdit');
    }

    //保存用户修改
    public function doEdit(){
        $data = Request::param();
        $dataDb = UserModel::where('id',$data['id'])->find();
        if($data['password'] != $dataDb['password']){
            $data['password'] = sha1($data['password']);
        }

        $res = UserModel::update($data);
        if($res){
            $this->success('修改成功','admin/user/userList');
        }else{
            $this->error('修改失败，请检查输入项');
        }
    }

    //删除用户
    public function del(){
        $id = Request::param('id');
        $res =  UserModel::where('id',$id)->delete();
        if($res){
            $this->success('删除成功','admin/user/userList');
        }else{
            $this->error('删除失败');
        }
    }




}