<?php


namespace app\common\validate;


class ManagerValidate extends Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'id'        => 'require|number',
        'role_id'   => 'require|number',
        'avatar'    => 'require',
        'real_name' => 'require|max:32|unique:Manager',
        'account'   => 'require|max:32|unique:Manager',
        'password'  => 'require',
        'status'    => 'require|number',
        'captcha'   => 'require|captcha:login',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'id.require'        => 'ID不能为空',
        'id.number'        => 'ID必须为正整数',
        'role_id.require'   => '角色ID不能为空',
        'role_id.number'   => '角色ID必须为正整数',
        'avatar.require'    => '头像不能为空',
        'real_name.require' => '姓名不能为空',
        'real_name.max'     => '姓名不能超过32个字符',
        'real_name.unique'  => '姓名已存在',
        'account.require'   => '账号不能为空',
        'account.max'       => '账号不能超过32个字符',
        'account.unique'    => '账号已存在',
        'password.require'  => '密码不能为空',
        'status.require'    => '状态不能为空',
        'status.number'    => '状态必须为正整数',
        'captcha.require'   => '验证码不能为空',
        'captcha.captcha'   => '验证码错误',
    ];
}