<?php
/**
 * Created by PhpStorm.
 * User: dengs
 * Date: 2018/5/9 0009
 * Time: 19:40
 */

namespace app\admin\controller;

use app\admin\common\controller\Base;

class Index extends Base
{
    public function index(){
        $this->isLogin();
        return $this->redirect('user/userList');
    }
}