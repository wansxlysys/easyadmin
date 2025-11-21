<?php


namespace app\admin\service;


use Exception;

use app\common\service\Service;
use app\common\repository\Wrapper;

use app\admin\repository\SystemDictTypeRepository;

class SystemDictTypeService extends Service
{
    /**
     * 字典管理存储类
     * @var SystemDictTypeRepository
     */
    protected SystemDictTypeRepository $SystemDictTypeRepository;

    /**
     * 获取列表
     * @throws Exception
     */
    public function getPageSystemDictType(array $params)
    {
        $Wrapper = new Wrapper();

        if (!empty($params['name'])) {
            $Wrapper->addWhere('name', 'like', "%{$params['name']}%");
        }

        if (!empty($params['identify'])) {
            $Wrapper->addWhere('identify', 'like', "%{$params['identify']}%");
        }

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->addOrder('sort', 'asc');

        $page = $this->SystemDictTypeRepository->getPage($Wrapper);

        return ['list' => $page->items(), 'total' => $page->total()];
    }

    /**
     * ID查询
     * @param $dictId
     * @return array
     * @throws Exception
     */
    public function getBySystemDictTypeId($dictId)
    {
        return $this->SystemDictTypeRepository->getById($dictId);
    }

    /**
     * 添加
     * @param array $params
     * @return int
     */
    public function createSystemDictType(array $params)
    {
        return $this->SystemDictTypeRepository->createRecord($params);
    }

    /**
     * 修改
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function updateSystemDictType(array $params)
    {
        return $this->SystemDictTypeRepository->updateById($params['dictId'], $params);
    }

    /**
     * 删除
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function deleteSystemDictType(array $params)
    {
        return $this->SystemDictTypeRepository->deleteById($params['dictId']);
    }
}