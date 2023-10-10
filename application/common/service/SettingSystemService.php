<?php


namespace app\common\service;


use app\common\repository\SettingSystemRepository;

class SettingSystemService extends Service
{
    /**
     * 存储类
     * @var SettingSystemRepository
     */
    protected $SettingSystemRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SettingSystemRepository = new SettingSystemRepository();
    }
}