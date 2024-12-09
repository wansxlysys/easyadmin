<?php


namespace app\common\service;


use app\common\repository\QueueFailedRepostitory;

class QueueFailedService extends Service
{
    /**
     * 存储类
     * @var QueueFailedRepostitory
     */
    protected $QueueFailedRepostitory;

    /**
     * 初始化
     */
    public function injectRepostitory(QueueFailedRepostitory $QueueFailedRepostitory)
    {
        $this->QueueFailedRepostitory = $QueueFailedRepostitory;
    }
}