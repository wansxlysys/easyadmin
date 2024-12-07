<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemSettingService;
use app\admin\validate\SystemSettingValidate;

class SystemSettingDependency
{
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