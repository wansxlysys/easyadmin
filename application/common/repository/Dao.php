<?php


namespace app\common\repository;


use think\Db;
use think\Exception;

use app\common\util\DateTimeUtil;

abstract class Dao
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
     * @param Wrapper $Wrapper
     * @return array
     * @throws Exception
     */
    public function getList(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->page($Wrapper->getPage())
            ->limit($Wrapper->getLimit())
            ->field($Wrapper->getField())
            ->group($Wrapper->getGroup())
            ->having($Wrapper->getHaving())
            ->order($Wrapper->getOrder())
            ->select();
    }

    /**
     * 获取总数
     * @param Wrapper $Wrapper
     * @return int
     */
    public function getTotal(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->count();
    }

    /**
     * 获取全部
     * @param Wrapper $Wrapper
     * @return array
     * @throws Exception
     */
    public function getAll(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->field($Wrapper->getField())
            ->group($Wrapper->getGroup())
            ->having($Wrapper->getHaving())
            ->order($Wrapper->getOrder())
            ->select();
    }

    /**
     * 获取单个
     * @param Wrapper $Wrapper
     * @return array
     * @throws Exception
     */
    public function getOne(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->field($Wrapper->getField())
            ->group($Wrapper->getGroup())
            ->order($Wrapper->getOrder())
            ->find();
    }

    /**
     * 创建数据
     * @param array $data
     * @return int
     */
    public function createRecord(array $data = [])
    {
        $dateTime = DateTimeUtil::dateTime();

        $data['createTime'] = $dateTime;
        $data['updateTime'] = $dateTime;

        return Db::name($this->getName())->insertGetId($data);
    }

    /**
     * 批量创建
     * @param array $dataList
     * @return int
     */
    public function createAll(array $dataList = [])
    {
        $dateTime = DateTimeUtil::dateTime();

        foreach ($dataList as &$data) {
            $data['createTime'] = $dateTime;
            $data['updateTime'] = $dateTime;
        }

        return Db::name($this->getName())->insertAll($dataList);
    }

    /**
     * 更新数据
     * @param Wrapper $Wrapper
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function updateRecord(Wrapper $Wrapper, array $data = [])
    {
        $data['updateTime'] = DateTimeUtil::dateTime();

        return Db::name($this->getName())
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->update($data);
    }

    /**
     * 删除数据
     * @param Wrapper $Wrapper
     * @return int
     * @throws Exception
     */
    public function deleteRecord(Wrapper $Wrapper)
    {
        return Db::name($this->getName())
            ->where($Wrapper->getWhere())
            ->whereOr($Wrapper->getWhereOr())
            ->delete();
    }
}