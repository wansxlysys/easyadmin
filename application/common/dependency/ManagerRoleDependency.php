<?php


namespace app\common\dependency;


use app\common\service\ManagerRoleService;
use app\common\validate\ManagerRoleValidate;
use app\common\repository\ManagerRoleRepository;

class ManagerRoleDependency
{
    /**
     * 获取存储类
     * @return ManagerRoleRepository
     */
    public static function getRepository()
    {
        return Dependency::get(ManagerRoleRepository::class);
    }

    /**
     * 获取服务类
     * @return ManagerRoleService
     */
    public static function getService()
    {
        return Dependency::get(ManagerRoleService::class);
    }

    /**
     * 获取验证器
     * @return ManagerRoleValidate
     */
    public static function getValidate()
    {
        return Dependency::get(ManagerRoleValidate::class);
    }
}