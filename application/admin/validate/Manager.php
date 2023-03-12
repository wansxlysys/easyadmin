<?php


namespace app\admin\validate;


class Manager extends \app\common\validate\Manager
{
    /**
     * 登录
     * @return Manager
     */
    public function sceneLogin()
    {
        return $this->only(['account', 'password', 'captcha'])->remove('account', 'unique');
    }

    /**
     * 添加
     * @return Manager
     */
    public function sceneCreate()
    {
        return $this->only(['role_id', 'avatar', 'nickname', 'account', 'password', 'status']);
    }

    /**
     * 更新
     * @return Manager
     */
    public function sceneUpdate()
    {
        return $this->only(['id', 'role_id', 'avatar', 'nickname', 'status']);
    }

    /**
     * 删除
     * @return Manager
     */
    public function sceneDelete()
    {
        return $this->only(['id']);
    }

    /**
     * 修改个人信息
     * @return Manager
     */
    public function sceneProfile()
    {
        return $this->only(['avatar', 'nickname']);
    }
}