<?php


namespace app\common\helper;


use app\admin\enum\SystemSettingEnum;

class SystemSettingHelper
{
    /**
     * 设置系统设置
     * @param $systemSetting
     */
    public static function setSystemSetting($systemSetting)
    {
        StoreHelper::set(SystemSettingEnum::SYSTEM_SETTING, $systemSetting);
    }

    /**
     * 获取系统设置
     * @return mixed|null
     */
    public static function getSystemSetting()
    {
        return StoreHelper::get(SystemSettingEnum::SYSTEM_SETTING);
    }
}