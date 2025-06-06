<?php


namespace app\admin\repository;


use app\common\repository\Repository;

class SystemMenuRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'system_menu';

    /**
     * 表主键
     * @var string
     */
    protected $tableId = 'menuId';
}