<?php


namespace app\common\repository;


use think\Db;
use think\Exception;

class ManagerRepository extends Model
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'Manager';

    /**
     * 获取列表
     * @param Query $Query
     * @return array
     * @throws Exception
     */
    public function getListWithRole(Query $Query)
    {
        return Db::name(static::getName())
            ->alias('manager')
            ->join('ManagerRole role', 'role.id = manager.roleId')
            ->where($Query->getWhere())
            ->whereOr($Query->getWhereOr())
            ->page($Query->getPage())
            ->limit($Query->getLimit())
            ->field($Query->getField())
            ->group($Query->getGroup())
            ->having($Query->getHaving())
            ->order($Query->getOrder())
            ->select();
    }

    /**
     * 获取总数
     * @param Query $Query
     * @return mixed
     */
    public function getTotalWithRole(Query $Query)
    {
        return Db::name(static::getName())
            ->alias('manager')
            ->join('ManagerRole role', 'role.id = manager.roleId')
            ->where($Query->getWhere())
            ->whereOr($Query->getWhereOr())
            ->count();
    }

    /**
     * 获取关联角色
     * @param Query $Query
     * @return array
     * @throws Exception
     */
    public function getWithRole(Query $Query)
    {
        return Db::name(static::getName())
            ->alias('manager')
            ->join('ManagerRole role', 'role.id = manager.roleId')
            ->where($Query->getWhere())
            ->whereOr($Query->getWhereOr())
            ->field($Query->getField())
            ->order($Query->getOrder())
            ->find();
    }
}