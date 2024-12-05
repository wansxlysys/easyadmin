<?php


namespace app\common\service;


use app\common\repository\ManagerRepository;

class ManagerService extends Service
{
    /**
     * 存储类
     * @var ManagerRepository
     */
    protected $ManagerRepository;

    /**
     * 初始化
     */
    public function __construct()
    {
        $this->ManagerRepository = new ManagerRepository();
    }
}