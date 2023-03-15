<?php


namespace app\common\repository;


use think\Db;
use app\common\exception\RepositoryException;

/**
 * 模型类
 * @package app\common\model
 */
class Model extends \app\common\repository\Repository
{
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

        } catch (\Throwable $throwable) {
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

        } catch (\Throwable $throwable) {
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

        } catch (\Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }

    /**
     * 获取表名
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}