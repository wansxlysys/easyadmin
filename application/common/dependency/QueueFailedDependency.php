<?php


namespace app\common\dependency;


use app\common\service\QueueFailedService;

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