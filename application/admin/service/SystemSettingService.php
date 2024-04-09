<?php


namespace app\admin\service;


use Throwable;

use app\common\enum\SystemSettingEnum;

class SystemSettingService extends \app\common\service\SystemSettingService
{
    /**
     * 获取配置
     * @return mixed
     * @throws Throwable
     */
    public function getSetting()
    {
        return $this->SystemSettingRepository->getById(SystemSettingEnum::ID);
    }

    /**
     * 更新配置
     * @param array $params
     * @return bool
     * @throws Throwable
     */
    public function setSetting(array $params)
    {
        return $this->SystemSettingRepository->updateById(SystemSettingEnum::ID, $params);
    }
}