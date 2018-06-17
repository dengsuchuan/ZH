<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\facade\Route;

//Route::get('think', function () {
//    return 'hello,ThinkPHP5!';
//});
//
//Route::get('hello/:name', 'index/hello');
//
//return [
//
//];

//首页路由规划
Route::rule('cate/:cate_id','index/index/index','get',['ext'=>'html']);
Route::rule('keyword/:keyword','index/index/index','get',['ext'=>'html']);


//后台路由规划
Route::group('admin', [
    'userList'   => 'admin/user/userList',
    'site'   => 'admin/site/index',
    'cate'   => 'admin/cate/cateList',
    'article'   => 'admin/article/articleList',
    'userEdit/:id'   => 'admin/user/userEdit',
    'cateEdit/:id'   => 'admin/cate/cateEdit',
    'articleEdit/:id'   => 'admin/article/articleEdit',
    'cateAdd'   => 'admin/cate/cateAdd',
    ]
)->ext('html')->pattern(['id' => '\d+']);


Route::group('blog', [

    ':name' => 'Blog/read',
])->ext('html')->pattern(['id' => '\d+']);
