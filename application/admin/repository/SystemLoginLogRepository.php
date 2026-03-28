<?php


namespace app\admin\repository;


use think\Exception;

use app\common\repository\Wrapper;
use app\common\builder\PageBuilder;
use app\common\repository\Repository;

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
     * @return array
     * @throws Exception
     */
    public function getPageWithManager(Wrapper $Wrapper)
    {
        $query = $this->getQuery()
            ->alias('log')
            ->join('system_manager manager', 'log.managerId = manager.managerId')
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->field($Wrapper->getField())
            ->group($Wrapper->getGroup())
            ->having($Wrapper->getHaving())
            ->order($Wrapper->getOrder());

        return PageBuilder::build($query, $Wrapper->getPage(), $Wrapper->getLimit());
    }
}