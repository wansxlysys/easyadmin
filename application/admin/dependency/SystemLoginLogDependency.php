<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemLoginLogService;
use app\admin\repository\SystemLoginLogRepository;

class SystemLoginLogDependency
{
    /**
     * 获取存储类
     * @return SystemLoginLogRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(SystemLoginLogRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemLoginLogService
     */
    public static function getService()
    {
        return Dependency::getProxy(SystemLoginLogService::class);
    }
}