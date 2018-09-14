<?php
namespace app\common\validate;
use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title|标题' => 'require|length:5,30',
        'content|文章内容' => 'require',
        'user_id|作者编号' => 'require',
        'cate_id|栏目编号' => 'require',
    ];
}