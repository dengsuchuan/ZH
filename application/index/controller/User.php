<?php
namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\User as UserModel;
use think\facade\Request;
use think\facade\Session;


class User extends Base
{
    //注册页面
    public function register(){
        $this->view->assign('title','用户注册');
        return $this->view->fetch();
    }

    //处理用户提交的注册信息
    public function insert(){
        if(Request::isAjax()){
            //获取用户通过表单提交过来的数据
            $dataPost = Request::post();
            $validate = 'app\common\validate\User';
            $res = $this->validate($dataPost,$validate);

            if(true !== $res){
                return ['status'=>0,'message'=>'校验失败 '.$res];
            }else{
                if($user = UserModel::create($dataPost)){
                    $res = UserModel::get($user->id);
                    Session::set('user_id',$res->id);
                    Session::set('user_name',$res->name);

                    return ['status'=>1,'message'=>'恭喜，注册成功'];
                }
            }
        }else{
            return $this->error('请求类型错误','register');
        }
    }

    //用户登录页面渲染
    public function login(){
        $this->loginEd();
        return $this->view->fetch('login',['title'=>'用户登录']);
    }

    //用户登录验证和查询
    public function loginCheck(){
        if(Request::isAjax()){
            //验证数据
            $dataPost = Request::post();
            $validate = [
                'email|邮箱'=>'require|email',
                'password|密码'=>'require|alphaNum',
            ];//自定义验证
            $res = $this->validate($dataPost,$validate);

            if(true !== $res){
                return ['status'=>-1,'message'=>'输入格式验证错误 '.$res];
            }else{
                //执行查询
                $result = UserModel::get(function ($query) use ($dataPost){
                    $query->where('email',$dataPost['email'])->where('password',sha1($dataPost['password']));
                });
                if(null == $result){
                    return ['status'=>0,'message'=>'邮箱或密码不正确'];
                }else{
                    //将用户信息写入到Session
                    Session::set('user_id',$result['id']);
                    Session::set('user_name',$result['name']);
                    //判断该用户是不是管理员,如果是这设置admin的session
                    Session::set('admin_id',$result['id']);
                    Session::set('admin_name',$result['name']);
                    if($result['is_admin'] == "管理员" || $result['is_admin'] == 1){
                        Session::set('admin_level',1);
                    }else{
                        Session::set('admin_level',0);
                    }

                    return ['status'=>1,'message'=>'登录成功'];
                }
            }
        }else{
            return $this->error('请求类型错误','login');
        }
    }

    //退出登录状态
    public function loginOut(){
        //删除所有
        Session::clear();

        //单独删除
        Session::delete('user_id');
        Session::delete('user_name');

        $this->success('退出成功，正在跳转到首页','/');
    }















}