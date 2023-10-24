<?php


namespace app\admin\service;


class SystemSettingService extends \app\common\service\SystemSettingService
{
    /**
     * 获取配置
     * @return mixed
     */
    public function getSetting()
    {
        return $this->SystemSettingRepository->getById(1);
    }

    /**
     * 更新配置
     * @param array $params
     * @return bool
     */
    public function setSetting(array $params)
    {
        return $this->SystemSettingRepository->updateById(1, $params);
    }
}