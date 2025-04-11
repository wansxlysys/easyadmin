<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemManagerService;
use app\admin\validate\SystemManagerValidate;
use app\admin\repository\SystemManagerRepository;

class SystemManagerDependency
{
    /**
     * 获取存储类
     * @return SystemManagerRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(SystemManagerRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemManagerService
     */
    public static function getService()
    {
        return Dependency::getProxy(SystemManagerService::class);
    }

    /**
     * 获取验证器
     * @return SystemManagerValidate
     */
    public static function getValidate()
    {
        return Dependency::getProxy(SystemManagerValidate::class);
    }
}