<?php


namespace app\common\service;


use app\common\repository\SystemSettingRepository;

class SystemSettingService extends Service
{
    /**
     * 存储类
     * @var SystemSettingRepository
     */
    protected $SystemSettingRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemSettingRepository = new SystemSettingRepository();
    }
}