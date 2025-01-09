<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\ManagerRoleService;
use app\admin\validate\ManagerRoleValidate;

class ManagerRoleDependency extends \app\common\dependency\ManagerRoleDependency
{
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