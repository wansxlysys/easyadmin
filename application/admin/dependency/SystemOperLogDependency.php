<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemOperLogService;
use app\admin\repository\SystemOperLogRepository;

class SystemOperLogDependency
{
    /**
     * 获取存储类
     * @return SystemOperLogRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(SystemOperLogRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemOperLogService
     */
    public static function getService()
    {
        return Dependency::getProxy(SystemOperLogService::class);
    }
}