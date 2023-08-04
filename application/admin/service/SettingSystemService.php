<?php


namespace app\admin\service;


class SettingSystemService extends \app\common\service\SettingSystemService
{
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