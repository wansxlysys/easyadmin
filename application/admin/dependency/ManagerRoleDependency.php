<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\ManagerRoleService;
use app\admin\validate\ManagerRoleValidate;
use app\admin\repository\ManagerRoleRepository;

class ManagerRoleDependency
{
    /**
     * 获取存储类
     * @return ManagerRoleRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(ManagerRoleRepository::class);
    }

    /**
     * 获取服务类
     * @return ManagerRoleService
     */
    public static function getService()
    {
        return Dependency::getProxy(ManagerRoleService::class);
    }

    /**
     * 获取验证器
     * @return ManagerRoleValidate
     */
    public static function getValidate()
    {
        return Dependency::getProxy(ManagerRoleValidate::class);
    }
}