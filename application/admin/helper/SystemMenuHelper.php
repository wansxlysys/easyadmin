<?php


namespace app\admin\helper;


use Exception;

use app\admin\service\SystemMenuService;
use app\admin\constant\SystemMenuConstant;

use app\common\helper\ContextHelper;
use app\common\dependency\Dependency;

class SystemMenuHelper
{
    /**
     * 获取当前菜单
     * @return mixed
     * @throws Exception
     */
    public static function getMenu()
    {
        return ContextHelper::get(SystemMenuConstant::CURRENT_MENU, function () {
            return Dependency::getClass(SystemMenuService::class)->getCurrentMenu();
        });
    }
}