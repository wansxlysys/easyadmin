<?php


namespace app\common\service;


use app\common\repository\SystemLoginLogRepository;

class SystemLoginLogService extends Service
{
    /**
     * 系统登录日志
     * @var SystemLoginLogRepository
     */
    protected $SystemLoginLogRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemLoginLogRepository = new SystemLoginLogRepository();
    }
}