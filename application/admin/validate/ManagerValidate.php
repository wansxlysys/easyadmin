<?php


namespace app\admin\validate;


class ManagerValidate extends \app\common\validate\ManagerValidate
{
    /**
     * 登录
     * @return ManagerValidate
     */
    public function sceneLogin()
    {
        return $this->only(['account', 'password', 'captcha'])->remove('account', 'unique');
    }

    /**
     * 添加
     * @return ManagerValidate
     */
    public function sceneCreate()
    {
        return $this->only(['role_id', 'avatar', 'real_name', 'account', 'password', 'status']);
    }

    /**
     * 修改
     * @return ManagerValidate
     */
    public function sceneUpdate()
    {
        return $this->only(['id', 'role_id', 'avatar', 'real_name', 'status']);
    }

    /**
     * 删除
     * @return ManagerValidate
     */
    public function sceneDelete()
    {
        return $this->only(['id']);
    }

    /**
     * 个人信息
     * @return ManagerValidate
     */
    public function sceneProfile()
    {
        return $this->only(['avatar', 'real_name']);
    }
}