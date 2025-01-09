<?php


namespace app\queue\dependency;


use app\common\dependency\Dependency;

use app\queue\service\QueueFailedService;

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
}