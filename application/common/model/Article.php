<?php
/**
 * zh_article表 的用户模型
 *
 */

namespace app\common\model;
use think\Model;

class Article extends Model
{
    protected $pk = 'id';       //默认主键
    protected $table = 'zh_article';//当前模型绑定的数据表

    protected $autoWriteTimestamp = true;//自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';

    //开启自动设置
    protected $auto = [];
    //仅新增生效
    protected $insert = ['create_time','status'=>1,'is_top'=>0,'is_host'=>0];
    //仅更新生效
    protected $update = ['update_time'];
}