<?php


namespace app\admin\validate;


class SystemMenuValidate extends \app\common\validate\SystemMenuValidate
{
    /**
     * 添加
     * @return SystemMenuValidate
     */
    public function sceneCreate()
    {
        return $this->only(['parentId', 'name', 'icon', 'module', 'controller', 'action', 'params', 'type', 'link', 'target', 'sort']);
    }

    /**
     * 修改
     * @return SystemMenuValidate
     */
    public function sceneUpdate()
    {
        return $this->only(['id', 'parentId', 'name', 'icon', 'module', 'controller', 'action', 'params', 'type', 'link', 'target', 'sort']);
    }

    /**
     * 删除
     * @return SystemMenuValidate
     */
    public function sceneDelete()
    {
        return $this->only(['id']);
    }

    /**
     * 排序
     * @return SystemMenuValidate
     */
    public function sceneSort()
    {
        return $this->only(['id', 'sort']);
    }
}