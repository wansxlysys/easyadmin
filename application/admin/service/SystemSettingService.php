<?php


namespace app\admin\service;


use Exception;

use app\common\enum\SystemSettingEnum;

class SystemSettingService extends \app\common\service\SystemSettingService
{
    /**
     * 获取配置
     * @return array
     * @throws Exception
     */
    public function getSystemSetting()
    {
        return $this->SystemSettingRepository->getById(SystemSettingEnum::ID);
    }

    /**
     * 更新配置
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function setSystemSetting(array $params)
    {
        return $this->SystemSettingRepository->updateById(SystemSettingEnum::ID, $params);
    }
}