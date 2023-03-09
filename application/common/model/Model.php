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
     * 设置表名
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}