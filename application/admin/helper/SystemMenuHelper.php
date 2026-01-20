<?php


namespace app\admin\helper;


use Exception;

use app\admin\enum\SystemMenuEnum;
use app\admin\service\SystemMenuService;

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
        return ContextHelper::get(SystemMenuEnum::CURRENT_MENU, function () {
            return Dependency::getProxy(SystemMenuService::class)->getCurrentMenu();
        });
    }
}