<?php


namespace app\admin\validate;


use app\common\validate\Validate;

class SystemManagerValidate extends Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'managerId' => 'require|number',
        'roleId'    => 'require|number',
        'avatar'    => 'require',
        'realName'  => 'require|max:32|single:system_manager,managerId,isDelete=N',
        'account'   => 'require|max:32|single:system_manager,managerId,isDelete=N',
        'password'  => 'require',
        'status'    => 'require|number',
        'captcha'   => 'require|captcha:login',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'managerId.require' => 'ID不能为空',
        'managerId.number'  => 'ID必须为正整数',
        'roleId.require'    => '角色ID不能为空',
        'roleId.number'     => '角色ID必须为正整数',
        'avatar.require'    => '头像不能为空',
        'realName.require'  => '姓名不能为空',
        'realName.max'      => '姓名不能超过32个字符',
        'realName.single'   => '姓名已存在',
        'account.require'   => '账号不能为空',
        'account.max'       => '账号不能超过32个字符',
        'account.single'    => '账号已存在',
        'password.require'  => '密码不能为空',
        'status.require'    => '状态不能为空',
        'status.number'     => '状态必须为正整数',
        'captcha.require'   => '验证码不能为空',
        'captcha.captcha'   => '验证码错误',
    ];

    /**
     * 登录
     * @return SystemManagerValidate
     */
    public function sceneLogin()
    {
        return $this->only(['account', 'password', 'captcha'])->remove('account', 'single');
    }

    /**
     * 添加
     * @return SystemManagerValidate
     */
    public function sceneCreate()
    {
        return $this->only(['roleId', 'avatar', 'realName', 'account', 'password', 'status']);
    }

    /**
     * 修改
     * @return SystemManagerValidate
     */
    public function sceneUpdate()
    {
        return $this->only(['managerId', 'roleId', 'avatar', 'realName', 'account', 'status']);
    }

    /**
     * 删除
     * @return SystemManagerValidate
     */
    public function sceneDelete()
    {
        return $this->only(['managerId']);
    }

    /**
     * 个人信息
     * @return SystemManagerValidate
     */
    public function sceneProfile()
    {
        return $this->only(['avatar', 'realName']);
    }
}