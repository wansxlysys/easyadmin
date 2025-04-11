<?php


namespace app\queue\dependency;


use app\common\dependency\Dependency;

use app\queue\service\QueueFailedService;
use app\queue\repository\QueueFailedRepository;

class QueueFailedDependency
{
    /**
     * 获取服务类
     * @return QueueFailedService
     */
    public static function getService()
    {
        return Dependency::getProxy(QueueFailedService::class);
    }

    /**
     * 获取存储类
     * @return QueueFailedRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(QueueFailedRepository::class);
    }
}