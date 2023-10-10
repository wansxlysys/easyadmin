<?php


namespace app\common\service;


use app\common\repository\UploadRepository;

class UploadService extends Service
{
    /**
     * 存储类
     * @var UploadRepository
     */
    protected $UploadRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->UploadRepository = new UploadRepository();
    }
}