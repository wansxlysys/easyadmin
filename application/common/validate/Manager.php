<?php


namespace app\common\validate;


class Manager extends \app\common\validate\Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'id'       => 'require|integer',
        'role_id'  => 'require|integer',
        'avatar'   => 'require',
        'nickname' => 'require|max:32',
        'account'  => 'require|max:32',
        'password' => 'require',
        'status'   => 'require|integer',
        'captcha'  => 'require|captcha:login',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'id.require'       => 'ID不能为空',
        'id.integer'       => 'ID必须为数字',
        'role_id.require'  => '角色ID不能为空',
        'role_id.integer'  => '角色ID必须为数字',
        'avatar.require'   => '头像不能为空',
        'nickname.require' => '昵称不能为空',
        'nickname.max'     => '昵称不能超过32个字符',
        'account.require'  => '账号不能为空',
        'account.max'      => '账号不能超过32个字符',
        'password.require' => '密码不能为空',
        'status.require'   => '状态不能为空',
        'status.integer'   => '状态必须为数字',
        'captcha.require'  => '验证码不能为空',
        'captcha.captcha'  => '验证码错误',
    ];
}