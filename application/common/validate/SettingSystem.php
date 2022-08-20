<?php


namespace app\common\validate;


class SettingSystem extends \app\common\validate\Validate
{
    protected $rule = [
        'name'   => 'require|max:32',
        'slogan' => 'require|max:64',
    ];

    protected $message = [
        'name.require'   => '系统名称不能为空',
        'name.max'       => '系统名称不能超过32个字符',
        'slogan.require' => '系统标语不能为空',
        'slogan.max'     => '系统标语不能超过64个字符',
    ];
}