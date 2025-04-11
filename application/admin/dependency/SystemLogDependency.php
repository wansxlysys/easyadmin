<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemLogService;
use app\admin\repository\SystemLogRepository;

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