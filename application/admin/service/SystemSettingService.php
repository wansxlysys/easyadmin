<?php


namespace app\admin\service;


use Exception;

use app\admin\enum\SystemSettingEnum;
use app\admin\repository\SystemSettingRepository;

class SystemSettingService
{
    /**
     * 存储类
     * @var SystemSettingRepository
     */
    protected $SystemSettingRepository;

    /**
     * 初始化
     */
    public function injectRepostitory(SystemSettingRepository $SystemSettingRepository)
    {
        $this->SystemSettingRepository = $SystemSettingRepository;
    }

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