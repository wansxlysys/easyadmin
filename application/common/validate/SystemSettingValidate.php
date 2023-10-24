<?php


namespace app\common\validate;


class SystemSettingValidate extends Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'name'    => 'require|max:32',
        'slogan'  => 'require|max:64',
        'content' => 'require',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'name.require'    => '系统名称不能为空',
        'name.max'        => '系统名称不能超过32个字符',
        'slogan.require'  => '系统标语不能为空',
        'slogan.max'      => '系统标语不能超过64个字符',
        'content.require' => '测试内容不能为空',
    ];
}