<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemMenuService;
use app\admin\validate\SystemMenuValidate;

class SystemMenuDependency extends \app\common\dependency\SystemMenuDependency
{
    /**
     * 获取服务类
     * @return SystemMenuService
     */
    public static function getService()
    {
        return Dependency::get(SystemMenuService::class);
    }

    /**
     * 获取验证器
     * @return SystemMenuValidate
     */
    public static function getValidate()
    {
        return Dependency::get(SystemMenuValidate::class);
    }
}