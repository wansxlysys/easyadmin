<?php


namespace app\admin\repository;


use Exception;

use think\Db;

use app\common\repository\Wrapper;
use app\common\repository\Repository;

class SystemDictDataRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'SystemDictData';

    /**
     * 表主键
     * @var string
     */
    protected $tableId = 'dataId';

    /**
     * 获取字典数据列表
     * @param Wrapper $Wrapper
     * @return array
     * @throws Exception
     */
    public function getAllWithDictType(Wrapper $Wrapper)
    {
        return $this->getQuery()
            ->alias('dict')
            ->join('system_dict_type type', 'type.dictId = dict.dictId')
            ->where($Wrapper->getWhere())
            ->where($Wrapper->getAndOr())
            ->whereOr($Wrapper->getWhereOr())
            ->field($Wrapper->getField())
            ->group($Wrapper->getGroup())
            ->having($Wrapper->getHaving())
            ->order($Wrapper->getOrder())
            ->select();
    }

    /**
     * 获取字典数据
     * @param Wrapper $Wrapper
     * @return array
     * @throws Exception
     */
    public function getWithDictType(Wrapper $Wrapper)
    {
        return $this->getQuery()
            ->alias('dict')
            ->join('system_dict_type type', 'type.dictId = dict.dictId')
            ->where($Wrapper->getWhere())
            ->where($Wrapper->getAndOr())
            ->whereOr($Wrapper->getWhereOr())
            ->field($Wrapper->getField())
            ->find();
    }
}