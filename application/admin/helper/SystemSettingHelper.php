<?php


namespace app\admin\helper;


use app\admin\enum\SystemSettingEnum;
use app\common\context\ContextHolder;

class SystemSettingHelper
{
    /**
     * 设置系统设置
     * @param $systemSetting
     */
    public static function setSystemSetting($systemSetting)
    {
        ContextHolder::set(SystemSettingEnum::SYSTEM_SETTING, $systemSetting);
    }

    /**
     * 获取系统设置
     * @return mixed|null
     */
    public static function getSystemSetting()
    {
        return ContextHolder::get(SystemSettingEnum::SYSTEM_SETTING);
    }
}