<?php


namespace app\common\service;


use app\common\repository\SystemUploadRepository;

class SystemUploadService extends Service
{
    /**
     * 存储类
     * @var SystemUploadRepository
     */
    protected $SystemUploadRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemUploadRepository = new SystemUploadRepository();
    }
}