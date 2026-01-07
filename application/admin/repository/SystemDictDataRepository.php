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
     * @param Wrapper $Wrapper
     * @return array
     * @throws Exception
     */
    public function getListWithDictType(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->alias('dict')
            ->join('system_dict_type type', 'type.dictId = dict.dictId')
            ->where($Wrapper->getWhere())
            ->where($Wrapper->getAndOr())
            ->whereOr($Wrapper->getWhereOr())
            ->page($Wrapper->getPage())
            ->limit($Wrapper->getLimit())
            ->field($Wrapper->getField())
            ->group($Wrapper->getGroup())
            ->having($Wrapper->getHaving())
            ->order($Wrapper->getOrder())
            ->select();
    }
}