<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\ManagerService;
use app\admin\validate\ManagerValidate;

class ManagerDependency extends \app\common\dependency\ManagerDependency
{
    /**
     * 获取服务类
     * @return ManagerService
     */
    public static function getService()
    {
        return Dependency::getProxy(ManagerService::class);
    }

    /**
     * 获取验证器
     * @return ManagerValidate
     */
    public static function getValidate()
    {
        return Dependency::getProxy(ManagerValidate::class);
    }
}