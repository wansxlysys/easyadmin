<?php


namespace app\admin\repository;


use think\Db;
use think\Exception;
use think\Paginator;

use app\common\repository\Wrapper;
use app\common\repository\Repository;

class SystemManagerRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'system_manager';

    /**
     * 表id
     * @var string
     */
    protected $tableId = 'managerId';

    /**
     * 获取列表
     * @param Wrapper $Wrapper
     * @return Paginator
     * @throws Exception
     */
    public function getPageWithRole(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->alias('manager')
            ->join('system_manager_role role', 'role.roleId = manager.roleId')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->page($Wrapper->getPage())
            ->limit($Wrapper->getLimit())
            ->field($Wrapper->getField())
            ->group($Wrapper->getGroup())
            ->having($Wrapper->getHaving())
            ->order($Wrapper->getOrder())
            ->paginate();
    }

    /**
     * 获取关联角色
     * @param Wrapper $Wrapper
     * @return array
     * @throws Exception
     */
    public function getWithRole(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->alias('manager')
            ->join('system_manager_role role', 'role.roleId = manager.roleId')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->field($Wrapper->getField())
            ->order($Wrapper->getOrder())
            ->find();
    }
}