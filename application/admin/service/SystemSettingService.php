<?php


namespace app\admin\service;


use app\common\exception\SystemException;

class SystemSettingService extends \app\common\service\SystemSettingService
{
    /**
     * 获取配置
     * @return mixed
     * @throws SystemException
     */
    public function getSetting()
    {
        return $this->SystemSettingRepository->getById(1);
    }

    /**
     * 更新配置
     * @param array $params
     * @return bool
     * @throws SystemException
     */
    public function setSetting(array $params)
    {
        return $this->SystemSettingRepository->updateById(1, $params);
    }
}