<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemLogService;

class SystemLogDependency extends \app\common\dependency\SystemLogDependency
{
    /**
     * 获取服务类
     * @return SystemLogService
     */
    public static function getService()
    {
        return Dependency::get(SystemLogService::class);
    }
}