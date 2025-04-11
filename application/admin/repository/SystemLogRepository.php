<?php


namespace app\admin\repository;


use app\common\repository\Repository;
use app\common\repository\Wrapper;
use think\Db;
use think\Exception;

class SystemLogRepository extends Repository
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
        return Db::name($this->getName())
            ->alias('log')
            ->join('SystemManager manager', 'manager.id = log.managerId')
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
     * @return int
     */
    public function getTotalWithInfo(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->alias('log')
            ->join('SystemManager manager', 'manager.id = log.managerId')
            ->join('SystemMenu menu', 'menu.id = log.menuId')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->count();
    }
}