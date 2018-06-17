<?php
namespace app\common\validate;
use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'title|栏目名称' => 'require|length:2,5|chsAlpha',
    ];
}