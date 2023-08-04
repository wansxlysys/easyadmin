<?php


namespace app\common\service;


use app\common\repository\UploadRepository;

class UploadService extends Service
{
    /**
     * 系统配置存储类
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