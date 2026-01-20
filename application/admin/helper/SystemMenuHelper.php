<?php


namespace app\admin\helper;


use app\admin\enum\SystemMenuEnum;
use app\common\context\ContextHolder;

class SystemMenuHelper
{
    /**
     * 设置当前菜单
     * @param $currentMenu
     */
    public static function setMenu($currentMenu)
    {
        ContextHolder::set(SystemMenuEnum::CURRENT_MENU, $currentMenu);
    }

    /**
     * 获取当前菜单
     * @return mixed|null
     */
    public static function getCurrentMenu()
    {
        return ContextHolder::get(SystemMenuEnum::CURRENT_MENU);
    }
}