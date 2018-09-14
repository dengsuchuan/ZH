<?php
/**
 * Created by PhpStorm.
 * User: dengs
 * Date: 2018/5/6 0006
 * Time: 4:03
 */

namespace app\common\validate;


use think\Validate;

class Like extends Validate
{
    protected $rule = [
        'art_id|文章编号' => 'require',
        'user_id|用户编号' => 'require',
//        'art_id|文章编号' => 'require|unique:zh_user_like',
//        'user_id|用户编号' => 'require',
    ];
}