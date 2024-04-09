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
     * @param Wrapper $Wrapper
     * @return mixed
     * @throws Exception
     */
    public function getListWithManager(Wrapper $Wrapper)
    {
        return Db::name(static::getName())
            ->alias('log')
            ->join('Manager manager', 'log.managerId = manager.id')
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
     * 获取关联管理员总数
     * @param Wrapper $Wrapper
     * @return mixed
     */
    public function getTotalWithManager(Wrapper $Wrapper)
    {
        return Db::name(static::getName())
            ->alias('log')
            ->join('Manager manager', 'log.managerId = manager.id')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->count();
    }

    /**
     * 获取关联管理员列表
     * @param Wrapper $Wrapper
     * @return mixed
     * @throws Exception
     */
    public function getWithManager(Wrapper $Wrapper)
    {
        return Db::name(static::getName())
            ->alias('log')
            ->join('Manager manager', 'log.managerId = manager.id')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->field($Wrapper->getField())
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