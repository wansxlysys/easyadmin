<?php


namespace app\admin\service;


use Exception;

use app\common\enum\YesnoEnum;
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

    /**
     * 获取字典键值对
     * @param $identify
     * @return array
     * @throws Exception
     */
    public function getKeyMapSystemDictData($identify)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('dict.status', '=', YesnoEnum::YES);
        $Wrapper->addWhere('type.status', '=', YesnoEnum::YES);
        $Wrapper->addWhere('type.identify', '=', $identify);
        $Wrapper->addOrder('type.sort');

        $dictList = $this->SystemDictDataRepository->getListWithDictType($Wrapper);

        return array_column($dictList, 'value', 'label');
    }

    /**
     * 获取字典键值对
     * @param $identify
     * @return array
     * @throws Exception
     */
    public function getValueMapSystemDictData($identify)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('dict.status', '=', YesnoEnum::YES);
        $Wrapper->addWhere('type.status', '=', YesnoEnum::YES);
        $Wrapper->addWhere('type.identify', '=', $identify);
        $Wrapper->addOrder('type.sort');

        $dictList = $this->SystemDictDataRepository->getListWithDictType($Wrapper);

        return array_column($dictList, 'label', 'value');
    }

    /**
     * 获取字典键值对
     * @param $identify
     * @param $label
     * @return array
     * @throws Exception
     */
    public function getSystemDictDataValue($identify, $label)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('dict.label', '=', $label);
        $Wrapper->addWhere('type.identify', '=', $identify);
        $Wrapper->addWhere('dict.status', '=', YesnoEnum::YES);
        $Wrapper->addWhere('type.status', '=', YesnoEnum::YES);

        $dictData = $this->SystemDictDataRepository->getWithDictType($Wrapper);

        if (isset($dictData)) {
            return $dictData['value'];
        }

        return null;
    }
}