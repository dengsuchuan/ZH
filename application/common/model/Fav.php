<?php
namespace app\common\model;


use think\Model;

class Fav extends Model
{
    protected $pk = 'id';       //默认主键
    protected $table = 'zh_user_fav';//当前模型绑定的数据表
}