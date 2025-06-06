<?php


namespace app\admin\repository;


use app\common\repository\Repository;

class SystemDictTypeRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'SystemDictType';

    /**
     * 表主键
     * @var string
     */
    protected $tableId = 'dictId';
}