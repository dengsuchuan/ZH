<?php
namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\common\model\Site as SiteModel;
use think\facade\Request;


class Site extends Base
{
    public function index(){
        $siteInfo = SiteModel::get(['status'=>1]);
        $this->view->assign('siteInfo',$siteInfo);
        return $this->view->fetch('index');
    }

    public function save(){
        if(Request::isPost()){
            $siteList = Request::post();
            $res = SiteModel::update($siteList);
            if($res){
                $this->success('修改成功','admin/site/index');
            }else{
                $this->error('修改失败，请检查输入项');
            }
        }
    }


}