<?php


namespace app\common\service;


use app\common\repository\SystemLoginLogRepository;

class SystemLoginLogService extends Service
{
    /**
     * 存储类
     * @var SystemLoginLogRepository
     */
    protected $SystemLoginLogRepository;

    /**
     * 初始化
     */
    public function injectRepostitory(SystemLoginLogRepository $SystemLoginLogRepository)
    {
        $this->SystemLoginLogRepository = $SystemLoginLogRepository;
    }
}