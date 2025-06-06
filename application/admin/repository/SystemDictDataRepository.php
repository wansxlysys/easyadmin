<?php


namespace app\admin\repository;


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
}