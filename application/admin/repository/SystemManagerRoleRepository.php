<?php


namespace app\admin\repository;


use app\common\repository\Repository;

class SystemManagerRoleRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'system_manager_role';

    /**
     * 表id
     * @var string
     */
    protected $tableId = 'roleId';
}