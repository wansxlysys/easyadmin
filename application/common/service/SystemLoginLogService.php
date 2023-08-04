<?php


namespace app\common\service;


use app\common\repository\SystemLoginLogRepository;

class SystemLoginLogService extends Service
{
    /**
     * 登录状态
     */
    const STATUS_SUCCESS = 1; // 登录成功
    const STATUS_ERROR   = 2; // 登录失败

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