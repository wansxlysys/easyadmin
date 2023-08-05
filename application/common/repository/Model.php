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
     * 通过ID获取或抛出异常
     * @param $id
     * @return mixed
     */
    public function getByIdOrFail($id)
    {
        try {

            return Db::name(static::getName())->where('id', $id)->findOrFail();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 通过条件查询
     * @param array $where
     * @param bool $fail
     * @return mixed
     */
    public function getByWhere(array $where, $fail = false)
    {
        try {

            return Db::name(static::getName())->where($where)->failException($fail)->find();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 通过ID更新
     * @param $id
     * @param array $params
     * @return bool
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
     * 通过ID删除
     * @param $id
     * @return bool
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