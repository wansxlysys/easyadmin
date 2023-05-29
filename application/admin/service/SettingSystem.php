<?php


namespace app\admin\service;


class SettingSystem extends \app\common\service\SettingSystem
{
    /**
     * 系统配置存储类
     * @var \app\admin\repository\SettingSystem
     */
    protected $SettingSystemRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SettingSystemRepository = new \app\admin\repository\SettingSystem();
    }

    /**
     * 获取配置
     * @return mixed
     */
    public function getSetting()
    {
        return $this->SettingSystemRepository->getById(1);
    }

    /**
     * 更新配置
     * @param array $params
     * @return bool
     */
    public function setSetting(array $params)
    {
        return $this->SettingSystemRepository->updateById(1, $params);
    }
}