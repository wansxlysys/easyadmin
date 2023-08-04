<?php


namespace app\common\repository;


use think\Db;
use Throwable;
use app\common\exception\RepositoryException;

class LogRepository extends Model
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'Log';

    /**
     * 获取关联管理员列表
     * @param Query $Query
     * @return mixed
     */
    public function getListWithManager(Query $Query)
    {
        try {

            return Db::name(static::getName())
                ->alias('log')
                ->join('Manager manager', 'log.manager_id = manager.id')
                ->where($Query->getWhere())
                ->whereOr($Query->getWhereOr())
                ->page($Query->getPage())
                ->limit($Query->getLimit())
                ->field($Query->getField())
                ->group($Query->getGroup())
                ->having($Query->getHaving())
                ->order($Query->getOrder())
                ->select();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 获取关联管理员总数
     * @param Query $Query
     * @return mixed
     */
    public function getTotalWithManager(Query $Query)
    {
        try {

            return Db::name(static::getName())
                ->alias('log')
                ->join('Manager manager', 'log.manager_id = manager.id')
                ->where($Query->getWhere())
                ->whereOr($Query->getWhereOr())
                ->count();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 获取关联管理员列表
     * @param Query $Query
     * @return mixed
     */
    public function getWithManager(Query $Query)
    {
        try {

            return Db::name(static::getName())
                ->alias('log')
                ->join('Manager manager', 'log.manager_id = manager.id')
                ->where($Query->getWhere())
                ->whereOr($Query->getWhereOr())
                ->field($Query->getField())
                ->find();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 清空全部
     * @return mixed
     */
    public function clear()
    {
        try {

            return false !== Db::name(static::getName())->where('id', '>', 0)->delete();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }
}