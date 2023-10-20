<?php


namespace app\admin\validate;


class RoleValidate extends \app\common\validate\RoleValidate
{
    /**
     * 添加
     * @return RoleValidate
     */
    public function sceneCreate()
    {
        return $this->only(['name', 'identify', 'permission']);
    }

    /**
     * 修改
     * @return RoleValidate
     */
    public function sceneUpdate()
    {
        return $this->only(['id', 'name', 'identify', 'permission']);
    }

    /**
     * 删除
     * @return RoleValidate
     */
    public function sceneDelete()
    {
        return $this->only(['id'])->remove('id', 'number');
    }
}