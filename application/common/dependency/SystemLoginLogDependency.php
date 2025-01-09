<?php


namespace app\common\dependency;


use app\common\service\SystemLoginLogService;
use app\common\repository\SystemLoginLogRepository;

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