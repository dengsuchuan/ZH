<?php
namespace app\admin\common\model;

use think\Model;

class Cate extends Model
{
    protected $pk = 'id';
    protected $table = 'zh_article_category';

    protected $autoWriteTimestamp = true;//自动时间粗
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';
}