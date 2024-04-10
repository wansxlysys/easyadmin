<?php


namespace app\common\service;


use app\common\repository\SystemLogRepository;

class SystemLogService extends Service
{
    /**
     * 存储类
     * @var SystemLogRepository
     */
    protected $SystemLogRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemLogRepository = new SystemLogRepository();
    }
}