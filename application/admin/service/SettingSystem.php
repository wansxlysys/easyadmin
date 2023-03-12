<?php


namespace app\admin\service;


class SettingSystem extends \app\common\service\SettingSystem
{
    /**
     * 系统配置存储类
     * @var \app\admin\model\SettingSystem
     */
    protected $SettingSystemModel;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SettingSystemModel = new \app\admin\model\SettingSystem();
    }

    /**
     * 获取配置
     * @return mixed
     */
    public function getSetting()
    {
        return $this->SettingSystemModel->getById(1);
    }

    /**
     * 更新配置
     * @param array $params
     * @return bool
     */
    public function setSetting(array $params = [])
    {
        return $this->SettingSystemModel->updateById($params['id'], $params);
    }
}