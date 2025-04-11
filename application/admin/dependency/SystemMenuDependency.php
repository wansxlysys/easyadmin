<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemMenuService;
use app\admin\validate\SystemMenuValidate;
use app\admin\repository\SystemMenuRepository;

class SystemMenuDependency
{
    /**
     * 获取存储类
     * @return SystemMenuRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(SystemMenuRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemMenuService
     */
    public static function getService()
    {
        return Dependency::getProxy(SystemMenuService::class);
    }

    /**
     * 获取验证器
     * @return SystemMenuValidate
     */
    public static function getValidate()
    {
        return Dependency::getProxy(SystemMenuValidate::class);
    }
}