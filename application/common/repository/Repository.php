<?php


namespace app\common\repository;


use think\Db;
use think\Exception;

use app\common\util\DateTimeUtil;

abstract class Repository
{
    /**
     * 引入分表
     */
    use SubTable;

    /**
     * 数据表名
     * @var string
     */
    protected $name = '';

    /**
     * 获取列表
     * @param Query $Query
     * @return array
     * @throws Exception
     */
    public function getList(Query $Query)
    {
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
    }

    /**
     * 获取总数
     * @param Query $Query
     * @return mixed
     */
    public function getTotal(Query $Query)
    {
        return Db::name(static::getName())
            ->where($Query->getWhere())
            ->whereOr($Query->getWhereOr())
            ->count();
    }

    /**
     * 获取全部
     * @param Query $Query
     * @return mixed
     * @throws Exception
     */
    public function getAll(Query $Query)
    {
        return Db::name(static::getName())
            ->where($Query->getWhere())
            ->whereOr($Query->getWhereOr())
            ->field($Query->getField())
            ->group($Query->getGroup())
            ->having($Query->getHaving())
            ->order($Query->getOrder())
            ->select();
    }

    /**
     * 获取单个
     * @param Query $Query
     * @return mixed
     * @throws Exception
     */
    public function getOne(Query $Query)
    {
        return Db::name(static::getName())
            ->where($Query->getWhere())
            ->whereOr($Query->getWhereOr())
            ->field($Query->getField())
            ->group($Query->getGroup())
            ->order($Query->getOrder())
            ->find();
    }

    /**
     * 创建数据
     * @param array $data
     * @return mixed
     */
    public function createRecord(array $data = [])
    {
        $dateTime = DateTimeUtil::dateTime();

        $data['createTime'] = $dateTime;
        $data['updateTime'] = $dateTime;

        return Db::name(static::getName())->insertGetId($data);
    }

    /**
     * 批量创建
     * @param array $dataList
     * @return mixed
     */
    public function createAll(array $dataList = [])
    {
        $dateTime = DateTimeUtil::dateTime();

        foreach ($dataList as &$data) {
            $data['createTime'] = $dateTime;
            $data['updateTime'] = $dateTime;
        }

        return Db::name(static::getName())->insertAll($dataList);
    }

    /**
     * 更新数据
     * @param Query $Query
     * @param array $data
     * @return integer
     * @throws Exception
     */
    public function updateRecord(Query $Query, array $data = [])
    {
        $data['updateTime'] = DateTimeUtil::dateTime();

        return Db::name(static::getName())
            ->where($Query->getWhere())
            ->whereOr($Query->getWhereOr())
            ->update($data);
    }

    /**
     * 删除数据
     * @param Query $Query
     * @return integer
     * @throws Exception
     */
    public function deleteRecord(Query $Query)
    {
        return Db::name(static::getName())
            ->where($Query->getWhere())
            ->whereOr($Query->getWhereOr())
            ->delete();
    }
}