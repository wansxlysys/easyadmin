<?php


namespace app\admin\service;


use app\admin\repository\SettingSystemRepository;

class SettingSystemService extends \app\common\service\SettingSystemService
{
    /**
     * 系统配置存储类
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