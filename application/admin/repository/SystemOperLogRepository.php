<?php


namespace app\admin\repository;


use think\Db;
use think\Exception;
use think\Paginator;

use app\common\repository\Wrapper;
use app\common\repository\Repository;

class SystemOperLogRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'system_oper_log';

    /**
     * 表id
     * @var string
     */
    protected $tableId = 'logId';

    /**
     * 获取关联管理员列表
     * @param Wrapper $Wrapper
     * @return Paginator
     * @throws Exception
     */
    public function getPageWithInfo(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->alias('log')
            ->join('system_manager manager', 'manager.managerId = log.managerId')
            ->join('system_menu menu', 'menu.menuId = log.menuId')
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
}