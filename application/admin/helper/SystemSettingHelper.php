<?php


namespace app\admin\helper;


use Exception;

use app\common\helper\ContextHelper;
use app\common\dependency\Dependency;

use app\admin\service\SystemDictDataService;
use app\admin\constant\SystemSettingConstant;

class SystemSettingHelper
{
    /**
     * 获取系统设置
     * @return mixed
     * @throws Exception
     */
    public static function getSystemSetting()
    {
        return ContextHelper::get(SystemSettingConstant::SYSTEM_SETTING, function () {
            return Dependency::getClass(SystemDictDataService::class)->getSystemGlobalSetting();
        });
    }
}