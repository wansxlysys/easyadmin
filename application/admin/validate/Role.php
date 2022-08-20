<?php


namespace app\admin\validate;


class Role extends \app\common\validate\Role
{
    /**
     * 添加
     * @return Role
     */
    public function sceneCreate()
    {
        return $this->only(['title', 'name', 'permission']);
    }

    /**
     * 修改
     * @return Role
     */
    public function sceneUpdate()
    {
        return $this->only(['id', 'title', 'name', 'permission']);
    }

    /**
     * 删除
     * @return Role
     */
    public function sceneDelete()
    {
        return $this->only(['id'])->remove('id', 'integer');
    }
}