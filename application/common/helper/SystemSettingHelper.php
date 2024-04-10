<?php


namespace app\common\helper;


use app\common\enum\SystemSettingEnum;

class SystemSettingHelper
{
    /**
     * 设置系统设置
     * @param $systemSetting
     */
    public static function setSystemSetting($systemSetting)
    {
        StoreHelper::set(SystemSettingEnum::CONTAINER_SETTING, $systemSetting);
    }

    /**
     * 获取系统设置
     * @return mixed|null
     */
    public static function getSystemSetting()
    {
        return StoreHelper::get(SystemSettingEnum::CONTAINER_SETTING);
    }
}