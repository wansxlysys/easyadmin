<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemManagerRoleService;
use app\admin\validate\SystemManagerRoleValidate;
use app\admin\repository\SystemManagerRoleRepository;

class SystemManagerRoleDependency
{
    /**
     * 获取存储类
     * @return SystemManagerRoleRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(SystemManagerRoleRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemManagerRoleService
     */
    public static function getService()
    {
        return Dependency::getProxy(SystemManagerRoleService::class);
    }

    /**
     * 获取验证器
     * @return SystemManagerRoleValidate
     */
    public static function getValidate()
    {
        return Dependency::getProxy(SystemManagerRoleValidate::class);
    }
}