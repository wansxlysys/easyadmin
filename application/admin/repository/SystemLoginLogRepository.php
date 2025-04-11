<?php


namespace app\admin\repository;


use app\common\repository\Repository;
use app\common\repository\Wrapper;
use think\Db;
use think\Exception;

class SystemLoginLogRepository extends Repository
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
        return Db::name($this->getName())
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
     * @return int
     */
    public function getTotalWithManager(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->alias('log')
            ->join('Manager manager', 'log.managerId = manager.id')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->count();
    }
}