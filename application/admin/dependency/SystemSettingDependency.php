<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemSettingService;
use app\admin\validate\SystemSettingValidate;
use app\admin\repository\SystemSettingRepository;

class SystemSettingDependency
{
    /**
     * 获取存储类
     * @return SystemSettingRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(SystemSettingRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemSettingService
     */
    public static function getService()
    {
        return Dependency::getProxy(SystemSettingService::class);
    }

    /**
     * 获取验证器
     * @return SystemSettingValidate
     */
    public static function getValidate()
    {
        return Dependency::getProxy(SystemSettingValidate::class);
    }
}