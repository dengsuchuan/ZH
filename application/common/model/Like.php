<?php
/**
 * Created by PhpStorm.
 * User: dengs
 * Date: 2018/5/6 0006
 * Time: 3:59
 */

namespace app\common\model;


use think\Model;

class Like extends Model
{
    protected $pk = 'id';       //默认主键
    protected $table = 'zh_user_like';//当前模型绑定的数据表
}