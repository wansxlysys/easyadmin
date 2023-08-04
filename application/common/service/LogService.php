<?php


namespace app\common\service;


use app\common\repository\LogRepository;

class LogService extends Service
{
    /**
     * 日志存储类
     * @var LogRepository
     */
    protected $LogRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->LogRepository = new LogRepository();
    }
}