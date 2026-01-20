<?php


namespace app\admin\service;


use app\common\exception\ServiceException;
use Exception;

use app\common\service\Service;
use app\common\repository\Wrapper;

use app\admin\enum\SystemSettingEnum;
use app\admin\repository\SystemSettingRepository;

class SystemSettingService extends Service
{
    /**
     * 存储类
     * @var SystemSettingRepository
     */
    protected SystemSettingRepository $SystemSettingRepository;

    /**
     * 获取列表
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function getPageSetting(array $params = [])
    {
        $Wrapper = new Wrapper();

        if (!empty($params['name'])) {
            $Wrapper->addWhere('name', 'LIKE', "{$params['name']}");
        }

        if (!empty($params['identify'])) {
            $Wrapper->addWhere('identify', 'LIKE', "{$params['identify']}");
        }

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->addOrder('sort');

        $page = $this->SystemSettingRepository->getPage($Wrapper);

        return ['list' => $page->items(), 'total' => $page->total()];
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
}