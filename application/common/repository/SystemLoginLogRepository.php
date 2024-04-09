<?php


namespace app\common\repository;


use think\Db;
use think\Exception;

class SystemLoginLogRepository extends Model
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'SystemLoginLog';

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
     * 清空系统登录日志
     * @throws Exception
     */
    public function clearSystemLoginLog()
    {
        return false !== Db::name(static::getName())->where('id', '>', 0)->delete();
    }
}