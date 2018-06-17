<?php
namespace app\common\model;

use think\Model;

class Site extends Model
{
    protected $pk = 'id';       //默认主键
    protected $table = 'zh_site';//当前模型绑定的数据表

    protected $autoWriteTimestamp = true;//自动时间粗
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';

}