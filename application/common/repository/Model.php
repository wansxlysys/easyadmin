<?php


namespace app\common\repository;


use think\Db;
use Throwable;
use app\common\exception\RepositoryException;

class Model extends Repository
{
    /**
     * 导入分表特征类
     */
    use SubTable;

    /**
     * 数据表名
     * @var string
     */
    protected $name = '';

    /**
     * 通过ID获取
     * @param $id
     * @return mixed
     * @throws RepositoryException
     */
    public function getById($id)
    {
        try {

            return Db::name(static::getName())->where('id', $id)->find();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 通过条件查询
     * @param array $where
     * @return mixed
     * @throws RepositoryException
     */
    public function getByWhere(array $where)
    {
        try {

            return Db::name(static::getName())->where($where)->find();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 条件查询全部
     * @param array $where
     * @return mixed
     * @throws RepositoryException
     */
    public function getAllByWhere(array $where)
    {
        try {

            return Db::name(static::getName())->where($where)->select();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 通过ID更新
     * @param $id
     * @param array $params
     * @return bool
     * @throws RepositoryException
     */
    public function updateById($id, array $params)
    {
        try {

            return false !== Db::name(static::getName())->where('id', 'IN', $id)->update($params);

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 通过条件更新
     * @param array $where
     * @param array $params
     * @return bool
     * @throws RepositoryException
     */
    public function updateByWhere(array $where, array $params)
    {
        try {

            return false !== Db::name(static::getName())->where($where)->update($params);

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 通过ID删除
     * @param $id
     * @return bool
     * @throws RepositoryException
     */
    public function deleteById($id)
    {
        try {

            return false !== Db::name(static::getName())->where('id', 'IN', $id)->delete();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 条件删除
     * @param array $where
     * @return bool
     * @throws RepositoryException
     */
    public function deleteByWhere(array $where)
    {
        try {

            return false !== Db::name(static::getName())->where($where)->delete();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 获取表名
     * @return string
     */
    public function getName()
    {
        /**
         * 如果无需分表则返回主表名
         */
        if (false === $this->isSub) {
            return $this->name;
        }

        return static::getSubName();
    }
}