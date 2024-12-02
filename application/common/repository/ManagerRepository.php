<?php


namespace app\common\repository;


use think\Db;
use think\Exception;

class ManagerRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'Manager';

    /**
     * 获取列表
     * @param Wrapper $Wrapper
     * @return array
     * @throws Exception
     */
    public function getListWithRole(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->alias('manager')
            ->join('ManagerRole role', 'role.id = manager.roleId')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->page($Wrapper->getPage())
            ->limit($Wrapper->getLimit())
            ->field($Wrapper->getField())
            ->group($Wrapper->getGroup())
            ->having($Wrapper->getHaving())
            ->order($Wrapper->getOrder())
            ->select();
    }

    /**
     * 获取总数
     * @param Wrapper $Wrapper
     * @return int
     */
    public function getTotalWithRole(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->alias('manager')
            ->join('ManagerRole role', 'role.id = manager.roleId')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->count();
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
            ->join('ManagerRole role', 'role.id = manager.roleId')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->field($Wrapper->getField())
            ->order($Wrapper->getOrder())
            ->find();
    }
}