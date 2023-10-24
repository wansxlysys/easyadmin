<?php


namespace app\common\repository;


use think\Db;
use Throwable;
use app\common\exception\RepositoryException;

class ManagerRepository extends Model
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'Manager';

    /**
     * 获取列表
     * @param Query $Query
     * @return array
     */
    public function getListWithRole(Query $Query)
    {
        try {

            return Db::name(static::getName())
                ->alias('manager')
                ->join('ManagerRole role', 'role.id = manager.role_id')
                ->where($Query->getWhere())
                ->whereOr($Query->getWhereOr())
                ->page($Query->getPage())
                ->limit($Query->getLimit())
                ->field($Query->getField())
                ->group($Query->getGroup())
                ->having($Query->getHaving())
                ->order($Query->getOrder())
                ->failException($Query->getFailException())
                ->select();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 获取总数
     * @param Query $Query
     * @return mixed
     */
    public function getTotalWithRole(Query $Query)
    {
        try {

            return Db::name(static::getName())
                ->alias('manager')
                ->join('ManagerRole role', 'role.id = manager.role_id')
                ->where($Query->getWhere())
                ->whereOr($Query->getWhereOr())
                ->count();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 通过账号查询
     * @param $account
     * @return mixed
     */
    public function getByAccount($account)
    {
        try {

            return Db::name(static::getName())->where('account', $account)->find();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }
}