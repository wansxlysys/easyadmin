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
    public function getListWithInfo(Wrapper $Wrapper)
    {
        return Db::name(static::getName())
            ->alias('log')
            ->join('Manager manager', 'manager.id = log.managerId')
            ->join('SystemMenu menu', 'menu.id = log.menuId')
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
    public function getTotalWithInfo(Wrapper $Wrapper)
    {
        return Db::name(static::getName())
            ->alias('log')
            ->join('Manager manager', 'manager.id = log.managerId')
            ->join('SystemMenu menu', 'menu.id = log.menuId')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->count();
    }
}