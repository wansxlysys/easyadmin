<?php


namespace app\admin\service;


use Exception;

use app\common\repository\Wrapper;

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
     * 获取列表
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function listSetting(array $params = [])
    {
        $Wrapper = new Wrapper();

        if (!empty($params['type'])) {
            $Wrapper->addWhere('type', 'LIKE', '%' . $params['type'] . '%');
        }

        if (!empty($params['name'])) {
            $Wrapper->addWhere('name', 'LIKE', '%' . $params['name'] . '%');
        }

        if (!empty($params['identify'])) {
            $Wrapper->addWhere('identify', 'LIKE', '%' . $params['identify'] . '%');
        }

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->addOrder('sort', 'asc');

        $list  = $this->SystemSettingRepository->getList($Wrapper);
        $total = $this->SystemSettingRepository->getTotal($Wrapper);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 获取设置
     * @return array
     * @throws Exception
     */
    public function getSettingById($settingId)
    {
        return $this->SystemSettingRepository->getById($settingId);
    }

    /**
     * 添加设置
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function createSetting(array $params)
    {
        return $this->SystemSettingRepository->createRecord($params);
    }

    /**
     * 更新设置
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function updateSetting(array $params)
    {
        return $this->SystemSettingRepository->updateById($params['settingId'], $params);
    }

    /**
     * 删除设置
     * @param $settingId
     * @return int
     * @throws Exception
     */
    public function deleteSetting($settingId)
    {
        return $this->SystemSettingRepository->deleteById($settingId);
    }

    /**
     * 获取设置数组
     * @return array
     * @throws Exception
     */
    public function getSystemSetting()
    {
        return $this->getSettingArray(SystemSettingEnum::TYPE_SYSTEM);
    }

    /**
     * 通过设置类型获取设置数组
     * @return array
     * @throws Exception
     */
    private function getSettingArray($type)
    {
        $settingList = $this->SystemSettingRepository->getAllByWhere(['type' => $type]);

        $resultList = [];

        foreach ($settingList as $setting) {
            $resultList[$setting['identify']] = $setting['value'];
        }

        return $resultList;
    }
}