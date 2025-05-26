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
     * 表ID
     * @var string
     */
    protected $tableId = 'dictId';
}