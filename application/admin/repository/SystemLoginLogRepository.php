<?php


namespace app\admin\repository;


use think\Db;
use think\Paginator;
use think\Exception;

use app\common\repository\Repository;
use app\common\repository\Wrapper;

class SystemLoginLogRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'system_login_log';

    /**
     * 表主键
     * @var string
     */
    protected $tableId = 'logId';

    /**
     * 获取关联管理员列表
     * @param Wrapper $Wrapper
     * @return Paginator
     * @throws Exception
     */
    public function getPageWithManager(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->alias('log')
            ->join('system_manager manager', 'log.managerId = manager.managerId')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->page($Wrapper->getPage())
            ->field($Wrapper->getField())
            ->group($Wrapper->getGroup())
            ->having($Wrapper->getHaving())
            ->order($Wrapper->getOrder())
            ->paginate($Wrapper->getLimit());
    }
}