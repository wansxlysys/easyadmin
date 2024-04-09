<?php


namespace app\common\repository;


use think\Db;
use think\Exception;

class SystemLogRepository extends Model
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'SystemLog';

    /**
     * 获取关联管理员列表
     * @param Query $Query
     * @return mixed
     * @throws Exception
     */
    public function getListWithManager(Query $Query)
    {
        return Db::name(static::getName())
            ->alias('log')
            ->join('Manager manager', 'log.managerId = manager.id')
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
     * 获取关联管理员总数
     * @param Query $Query
     * @return mixed
     */
    public function getTotalWithManager(Query $Query)
    {
        return Db::name(static::getName())
            ->alias('log')
            ->join('Manager manager', 'log.managerId = manager.id')
            ->where($Query->getWhere())
            ->whereOr($Query->getWhereOr())
            ->count();
    }

    /**
     * 获取关联管理员列表
     * @param Query $Query
     * @return mixed
     * @throws Exception
     */
    public function getWithManager(Query $Query)
    {
        return Db::name(static::getName())
            ->alias('log')
            ->join('Manager manager', 'log.managerId = manager.id')
            ->where($Query->getWhere())
            ->whereOr($Query->getWhereOr())
            ->field($Query->getField())
            ->find();
    }

    /**
     * 清空全部
     * @return mixed
     * @throws Exception
     */
    public function clearLog()
    {
        return false !== Db::name(static::getName())->where('id', '>', 0)->delete();
    }
}