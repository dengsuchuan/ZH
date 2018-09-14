<?php
namespace app\common\validate;
use think\Validate;

class Comments extends Validate
{
    protected $rule = [
        'art_id|文章编号' => 'require',
        'user_id|用户编号' => 'require',
        'content|评论内容' => 'require|length:5:150',
    ];
}