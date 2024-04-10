<?php


namespace app\common\validate;


class ManagerValidate extends Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'id'       => 'require|number',
        'roleId'   => 'require|number',
        'avatar'   => 'require',
        'realName' => 'require|max:32|unique:Manager',
        'account'  => 'require|max:32|unique:Manager',
        'password' => 'require',
        'status'   => 'require|number',
        'captcha'  => 'require|captcha:login',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'id.require'       => 'ID不能为空',
        'id.number'        => 'ID必须为正整数',
        'roleId.require'   => '角色ID不能为空',
        'roleId.number'    => '角色ID必须为正整数',
        'avatar.require'   => '头像不能为空',
        'realName.require' => '姓名不能为空',
        'realName.max'     => '姓名不能超过32个字符',
        'realName.unique'  => '姓名已存在',
        'account.require'  => '账号不能为空',
        'account.max'      => '账号不能超过32个字符',
        'account.unique'   => '账号已存在',
        'password.require' => '密码不能为空',
        'status.require'   => '状态不能为空',
        'status.number'    => '状态必须为正整数',
        'captcha.require'  => '验证码不能为空',
        'captcha.captcha'  => '验证码错误',
    ];
}