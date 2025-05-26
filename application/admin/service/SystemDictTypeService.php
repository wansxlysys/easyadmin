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
    protected $SystemDictTypeRepository;

    /**
     * 注入存储类
     */
    public function injectRepository(SystemDictTypeRepository $SystemDictTypeRepository)
    {
        $this->SystemDictTypeRepository = $SystemDictTypeRepository;
    }

    /**
     * 获取列表
     * @throws Exception
     */
    public function listSystemDictType(array $params)
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

        $list  = $this->SystemDictTypeRepository->getList($Wrapper);
        $total = $this->SystemDictTypeRepository->getTotal($Wrapper);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * ID查询
     * @param $id
     * @return array
     * @throws Exception
     */
    public function getBySystemDictTypeId($id)
    {
        return $this->SystemDictTypeRepository->getById($id);
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