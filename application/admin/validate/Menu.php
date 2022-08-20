<?php


namespace app\admin\validate;


class Menu extends \app\common\validate\Menu
{
    /**
     * 添加菜单
     * @return Menu
     */
    public function sceneCreate()
    {
        return $this->only(['parent_id', 'title', 'icon', 'module', 'controller', 'action', 'params', 'type', 'link', 'target', 'sort']);
    }

    /**
     * 修改菜单
     * @return Menu
     */
    public function sceneUpdate()
    {
        return $this->only(['id', 'parent_id', 'title', 'icon', 'module', 'controller', 'action', 'params', 'type', 'link', 'target', 'sort']);
    }

    /**
     * 删除菜单
     * @return Menu
     */
    public function sceneDelete()
    {
        return $this->only(['id']);
    }

    /**
     * 排序菜单
     * @return Menu
     */
    public function sceneSort()
    {
        return $this->only(['id', 'sort']);
    }
}