<?php


namespace app\common\repository;


use think\Db;
use Throwable;
use app\common\exception\RepositoryException;

abstract class Repository
{
    /**
     * 获取列表
     * @param Query $Query
     * @return array
     */
    public function getList(Query $Query)
    {
        try {

            return Db::name(static::getName())
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
     * 获取总数
     * @param Query $Query
     * @return mixed
     */
    public function getTotal(Query $Query)
    {
        try {

            return Db::name(static::getName())
                ->where($Query->getWhere())
                ->whereOr($Query->getWhereOr())
                ->count();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 获取全部
     * @param Query $Query
     * @return mixed
     */
    public function getAll(Query $Query)
    {
        try {

            return Db::name(static::getName())
                ->where($Query->getWhere())
                ->whereOr($Query->getWhereOr())
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
     * 获取单个
     * @param Query $Query
     * @return mixed
     */
    public function getOne(Query $Query)
    {
        try {

            return Db::name(static::getName())
                ->where($Query->getWhere())
                ->whereOr($Query->getWhereOr())
                ->field($Query->getField())
                ->group($Query->getGroup())
                ->order($Query->getOrder())
                ->find();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 创建数据
     * @param array $params
     * @return mixed
     */
    public function createRecord(array $params = [])
    {
        try {

            return Db::name(static::getName())->insertGetId($params);

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 批量创建
     * @param array $params
     * @return mixed
     */
    public function createAll(array $params = [])
    {
        return Db::name(static::getName())->insertAll($params);
    }

    /**
     * 更新数据
     * @param Query $Query
     * @param array $params
     * @return bool
     */
    public function updateRecord(Query $Query, array $params = [])
    {
        try {

            return false !== Db::name(static::getName())->where($Query->getWhere())->whereOr($Query->getWhereOr())
                    ->update($params);

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 删除数据
     * @param Query $Query
     * @return mixed
     */
    public function deleteRecord(Query $Query)
    {
        try {

            return false !== Db::name(static::getName())->where($Query->getWhere())->whereOr($Query->getWhereOr())
                    ->delete();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }
}