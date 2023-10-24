<?php


namespace app\admin\validate;


class ManagerRoleValidate extends \app\common\validate\ManagerRoleValidate
{
    /**
     * 添加
     * @return ManagerRoleValidate
     */
    public function sceneCreate()
    {
        return $this->only(['name', 'identify', 'permission']);
    }

    /**
     * 修改
     * @return ManagerRoleValidate
     */
    public function sceneUpdate()
    {
        return $this->only(['id', 'name', 'identify', 'permission']);
    }

    /**
     * 删除
     * @return ManagerRoleValidate
     */
    public function sceneDelete()
    {
        return $this->only(['id'])->remove('id', 'number');
    }
}