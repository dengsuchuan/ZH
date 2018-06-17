<?php
/**
 * zh_user表 的验证器
 */

namespace app\common\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = [
        'name|姓名' => 'require|length:2,20|chsAlphaNum',
        'email|邮箱' => 'require|email|unique:zh_user',
        'mobile|手机号' => 'require|mobile|unique:zh_user',
        'password|密码' => 'require|length:6,20|alphaNum|confirm',
    ];

        /*'name|姓名'=>[
        'require'       => 'require',
        'length'        => '5,20',
        'chsAlphaNum'   =>'chsAlphaNum',  //仅允许汉字、字母和数字
        ],

        'email|邮箱'=>[
        'require'       => 'require',
        'email'         => 'email',
        'unique'        => 'zh_user',   //该字段在zh_user表中必须是唯一的
        ],

        'mobile|手机号'=>[
        'require'       => 'require',
        'mobile'        => 'mobile',
        'unique'        => 'zh_user',   //该字段在zh_user表中必须是唯一的
        'number'        =>  'number',
        ],

        'password|密码'=>[
        'require'       => 'require',
        'length'        => '6,20',
        'alphaNum'      => 'alphaNum',  //仅允许数字和字母
        'confirm'       => 'confirm',   //自动与password_confirm字段进行自动的相等验证
        ],*/
}