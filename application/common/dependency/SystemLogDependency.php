<?php


namespace app\common\dependency;


use app\common\service\SystemLogService;
use app\common\repository\SystemLogRepository;

class SystemLogDependency
{
    /**
     * 获取存储类
     * @return SystemLogRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(SystemLogRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemLogService
     */
    public static function getService()
    {
        return Dependency::getProxy(SystemLogService::class);
    }
}