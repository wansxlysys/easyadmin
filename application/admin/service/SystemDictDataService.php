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
    protected $SystemDictDataRepository;

    /**
     * 注入存储类
     */
    public function injectRepository(SystemDictDataRepository $SystemDictDataRepository)
    {
        $this->SystemDictDataRepository = $SystemDictDataRepository;
    }

    /**
     * 获取列表
     * @throws Exception
     */
    public function listSystemDictData(array $params)
    {
        $Wrapper = new Wrapper();

        if (!empty($params['id'])) {
            $Wrapper->addWhere('id', '=', $params['id']);
        }

        if (!empty($params['name'])) {
            $Wrapper->addWhere('name', 'like', "%{$params['name']}%");
        }

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);

        $Wrapper->addOrder('sort', 'asc');

        $list  = $this->SystemDictDataRepository->getList($Wrapper);
        $total = $this->SystemDictDataRepository->getTotal($Wrapper);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * ID查询
     * @param $id
     * @return array
     * @throws Exception
     */
    public function getBySystemDictDataId($id)
    {
        return $this->SystemDictDataRepository->getById($id);
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
        return $this->SystemDictDataRepository->updateById($params['id'], $params);
    }

    /**
     * 删除
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function deleteSystemDictData(array $params)
    {
        return $this->SystemDictDataRepository->deleteById($params['id']);
    }
}