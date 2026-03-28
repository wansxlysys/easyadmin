<?php


namespace app\common\repository;


use think\Db;
use think\db\Query;
use think\Exception;

use app\common\util\DateTimeUtil;
use app\common\builder\PageBuilder;
use app\common\constant\YesnoConstant;

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
     * 表主键
     * @var string
     */
    protected $tableId = 'id';

    /**
     * 获取查询器
     * @return Query
     */
    public function getQuery()
    {
        return Db::name($this->getName());
    }

    /**
     * 获取列表
     * @param Wrapper $Wrapper
     * @return array
     * @throws Exception
     */
    public function getPage(Wrapper $Wrapper)
    {
        $query = $this->getQuery()
            ->where($Wrapper->getWhere())
            ->where($Wrapper->getAndOr())
            ->whereOr($Wrapper->getWhereOr())
            ->field($Wrapper->getField())
            ->group($Wrapper->getGroup())
            ->having($Wrapper->getHaving())
            ->order($Wrapper->getOrder());

        return PageBuilder::build($query, $Wrapper->getPage(), $Wrapper->getLimit());
    }

    /**
     * 获取列表
     * @param Wrapper $Wrapper
     * @return array
     * @throws Exception
     */
    public function getList(Wrapper $Wrapper)
    {
        return $this->getQuery()
            ->where($Wrapper->getWhere())
            ->where($Wrapper->getAndOr())
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
        return $this->getQuery()
            ->where($Wrapper->getWhere())
            ->where($Wrapper->getAndOr())
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
        return $this->getQuery()
            ->where($Wrapper->getWhere())
            ->where($Wrapper->getAndOr())
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
        return $this->getQuery()
            ->where($Wrapper->getWhere())
            ->where($Wrapper->getAndOr())
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

        return $this->getQuery()->insertGetId($data);
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

        return $this->getQuery()->insertAll($dataList);
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

        return $this->getQuery()
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
        return $this->getQuery()
            ->where($Wrapper->getWhere())
            ->delete();
    }

    /**
     * 软删除数据
     * @param Wrapper $Wrapper
     * @return int
     * @throws Exception
     */
    public function removeRecord(Wrapper $Wrapper)
    {
        $data['isDelete']   = YesnoConstant::Y;
        $data['deleteTime'] = DateTimeUtil::dateTime();

        return $this->getQuery()
            ->where($Wrapper->getWhere())
            ->where('isDelete', YesnoConstant::N)
            ->update($data);
    }

    /**
     * 通过ID获取
     * @param $id
     * @param array $field
     * @return array
     * @throws Exception
     */
    public function getById($id, array $field = [])
    {
        $Wrapper = new Wrapper();

        $Wrapper->setField($field);
        $Wrapper->addWhere($this->tableId, '=', $id);

        return $this->getOne($Wrapper);
    }

    /**
     * 通过条件查询
     * @param array $where
     * @param array $field
     * @return array
     * @throws Exception
     */
    public function getByWhere(array $where, array $field = [])
    {
        $Wrapper = new Wrapper();

        $Wrapper->setField($field);
        $Wrapper->setWhere($where);

        return $this->getOne($Wrapper);
    }

    /**
     * ID查询全部
     * @param $id
     * @param array $field
     * @return array
     * @throws Exception
     */
    public function getAllById($id, array $field = [])
    {
        $Wrapper = new Wrapper();

        $Wrapper->setField($field);
        $Wrapper->addWhere($this->tableId, 'in', $id);

        return $this->getAll($Wrapper);
    }

    /**
     * 条件查询全部
     * @param array $where
     * @param array $field
     * @return array
     * @throws Exception
     */
    public function getAllByWhere(array $where, array $field = [])
    {
        $Wrapper = new Wrapper();

        $Wrapper->setField($field);
        $Wrapper->setWhere($where);

        return $this->getAll($Wrapper);
    }

    /**
     * 通过ID更新
     * @param $id
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function updateById($id, array $data = [])
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere($this->tableId, 'in', $id);

        return $this->updateRecord($Wrapper, $data);
    }

    /**
     * 通过条件更新
     * @param array $where
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function updateByWhere(array $where, array $data = [])
    {
        $Wrapper = new Wrapper();

        $Wrapper->setWhere($where);

        return $this->updateRecord($Wrapper, $data);
    }

    /**
     * 通过ID删除
     * @param $id
     * @return int
     * @throws Exception
     */
    public function deleteById($id)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere($this->tableId, 'in', $id);

        return $this->deleteRecord($Wrapper);
    }

    /**
     * 条件删除
     * @param array $where
     * @return int
     * @throws Exception
     */
    public function deleteByWhere(array $where)
    {
        $Wrapper = new Wrapper();

        $Wrapper->setWhere($where);

        return $this->deleteRecord($Wrapper);
    }

    /**
     * 通过ID软删除
     * @param $id
     * @return int
     * @throws Exception
     */
    public function removeById($id)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere($this->tableId, 'in', $id);

        return $this->removeRecord($Wrapper);
    }

    /**
     * 条件软删除
     * @param array $where
     * @return int
     * @throws Exception
     */
    public function removeByWhere(array $where)
    {
        $Wrapper = new Wrapper();

        $Wrapper->setWhere($where);

        return $this->removeRecord($Wrapper);
    }
}