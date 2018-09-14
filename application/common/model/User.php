<?php
/**
 * zh_user表 的用户模型
 *
 */

namespace app\common\model;
use think\Model;

class User extends Model
{
    protected $pk = 'id';       //默认主键
    protected $table = 'zh_user';//当前模型绑定的数据表

    protected $autoWriteTimestamp = true;//自动时间粗
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';

    //获取器  明确字段中的值，比如int类型的 ["status"] => string(6)   获取之后是  ["status"] => string(6) "启用"
    public function getStatusAttr($value){
        $status = ['1'=>'启用','0'=>'禁用'];
        return $status[$value];
    }

    public function getIsAdminAttr($value){
        $status = ['1'=>'管理员','0'=>'普通用户'];
        return $status[$value];
    }

    //修改器  用户在写入数据表的时候，修改器实现自动转换
    public function setPasswordAttr($value){
        return sha1($value);
    }


}