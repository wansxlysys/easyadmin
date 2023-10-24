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
    public function initialize()
    {
        parent::initialize();
        $this->ManagerRepository = new ManagerRepository();
    }
}