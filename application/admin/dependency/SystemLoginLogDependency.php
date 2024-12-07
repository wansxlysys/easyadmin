<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemLoginLogService;

class SystemLoginLogDependency extends \app\common\dependency\SystemLoginLogDependency
{
    /**
     * 获取服务类
     * @return SystemLoginLogService
     */
    public static function getService()
    {
        return Dependency::get(SystemLoginLogService::class);
    }
}