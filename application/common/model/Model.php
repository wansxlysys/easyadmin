<?php


namespace app\common\model;


use think\Db;
use app\common\exception\RepositoryException;

/**
 * 模型类
 * @package app\common\model
 */
class Model extends \app\common\repository\Repository
{
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

            return Db::name(static::getName())->where('id', 'IN', $id)->update($params);

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

            return Db::name(static::getName())->where('id', 'IN', $id)->delete();

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

    /**
     * 通过ID获取分表表名
     * @param $id
     * @return string
     */
    public function getSubNameById($id)
    {
        return "{$this->name}_{$this->getByMod($id, 100)}";
    }

    /**
     * 取余方式分表
     * @param $key
     * @param $total
     * @return int
     */
    public function getByMod($key, $total)
    {
        return ($key % $total) + 1;
    }
}