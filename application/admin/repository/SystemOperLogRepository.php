<?php


namespace app\admin\repository;


use think\Exception;

use app\common\repository\Wrapper;
use app\common\builder\PageBuilder;
use app\common\repository\Repository;

class SystemOperLogRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'system_oper_log';

    /**
     * 表主键
     * @var string
     */
    protected $tableId = 'logId';

    /**
     * 获取关联管理员列表
     * @param Wrapper $Wrapper
     * @return array
     * @throws Exception
     */
    public function getPageWithInfo(Wrapper $Wrapper)
    {
        $query = $this->getQuery()
            ->alias('log')
            ->join('system_manager manager', 'manager.managerId = log.managerId')
            ->join('system_menu menu', 'menu.menuId = log.menuId')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->field($Wrapper->getField())
            ->group($Wrapper->getGroup())
            ->having($Wrapper->getHaving())
            ->order($Wrapper->getOrder());

        return PageBuilder::build($query, $Wrapper->getPage(), $Wrapper->getLimit());
    }
}