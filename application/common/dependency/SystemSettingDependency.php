<?php


namespace app\common\dependency;


use app\common\service\SystemSettingService;
use app\common\validate\SystemSettingValidate;
use app\common\repository\SystemSettingRepository;

class SystemSettingDependency
{
    /**
     * 获取存储类
     * @return SystemSettingRepository
     */
    public static function getRepository()
    {
        return Dependency::get(SystemSettingRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemSettingService
     */
    public static function getService()
    {
        return Dependency::get(SystemSettingService::class);
    }

    /**
     * 获取验证器
     * @return SystemSettingValidate
     */
    public static function getValidate()
    {
        return Dependency::get(SystemSettingValidate::class);
    }
}