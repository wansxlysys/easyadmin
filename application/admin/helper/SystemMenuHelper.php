<?php


namespace app\admin\helper;


use app\admin\enum\SystemMenuEnum;
use app\common\helper\StoreHelper;

class SystemMenuHelper
{
    /**
     * 设置当前菜单
     * @param $currentMenu
     */
    public static function setCurrentMenu($currentMenu)
    {
        StoreHelper::set(SystemMenuEnum::CURRENT_MENU, $currentMenu);
    }

    /**
     * 获取当前菜单
     * @return mixed|null
     */
    public static function getCurrentMenu()
    {
        return StoreHelper::get(SystemMenuEnum::CURRENT_MENU);
    }
}