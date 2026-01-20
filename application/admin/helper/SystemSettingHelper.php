<?php


namespace app\admin\helper;


use Exception;

use app\common\context\ContextHolder;
use app\common\dependency\Dependency;

use app\admin\enum\SystemSettingEnum;
use app\admin\service\SystemDictDataService;

class SystemSettingHelper
{
    /**
     * 获取系统设置
     * @return mixed
     * @throws Exception
     */
    public static function getSystemSetting()
    {
        return ContextHolder::get(SystemSettingEnum::SYSTEM_SETTING, function () {
            return Dependency::getProxy(SystemDictDataService::class)->getSystemGlobalSetting();
        });
    }
}