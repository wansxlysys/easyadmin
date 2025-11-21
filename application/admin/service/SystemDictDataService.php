<?php


namespace app\admin\service;


use Exception;

use app\common\service\Service;
use app\common\repository\Wrapper;

use app\admin\repository\SystemDictDataRepository;

class SystemDictDataService extends Service
{
    /**
     * 字典数据存储类
     * @var SystemDictDataRepository
     */
    protected SystemDictDataRepository $SystemDictDataRepository;

    /**
     * 获取列表
     * @throws Exception
     */
    public function getPageSystemDictData(array $params)
    {
        $Wrapper = new Wrapper();

        if (!empty($params['dictId'])) {
            $Wrapper->addWhere('dictId', '=', $params['dictId']);
        }

        if (!empty($params['label'])) {
            $Wrapper->addWhere('label', 'like', "%{$params['label']}%");
        }

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);

        $Wrapper->addOrder('sort', 'asc');

        $page = $this->SystemDictDataRepository->getPage($Wrapper);

        return ['list' => $page->items(), 'total' => $page->total()];
    }

    /**
     * ID查询
     * @param $dataId
     * @return array
     * @throws Exception
     */
    public function getBySystemDictDataId($dataId)
    {
        return $this->SystemDictDataRepository->getById($dataId);
    }

    /**
     * 添加
     * @param array $params
     * @return int
     */
    public function createSystemDictData(array $params)
    {
        return $this->SystemDictDataRepository->createRecord($params);
    }

    /**
     * 修改
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function updateSystemDictData(array $params)
    {
        return $this->SystemDictDataRepository->updateById($params['dataId'], $params);
    }

    /**
     * 删除
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function deleteSystemDictData(array $params)
    {
        return $this->SystemDictDataRepository->deleteById($params['dataId']);
    }
}