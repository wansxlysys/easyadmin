<?php


namespace app\common\repository;


use app\common\repository\Query;

/**
 * 存储库基类
 * @package app\common\repository
 */
class Repository
{
    /**
     * 对应模型
     * @var mixed|null
     */
    protected $Model = null;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * 初始化
     */
    protected function initialize()
    {

    }

    /**
     * 获取列表偏移
     * @param Query $Query
     * @return mixed
     */
    public function getList(Query $Query)
    {
        $Model = $this->Model;
        $Model = $Model->where($Query->where);
        $Model = $Model->whereOr($Query->whereOr);
        $Model = $Model->page($Query->page);
        $Model = $Model->limit($Query->limit);
        $Model = $Model->field($Query->field);
        $Model = $Model->group($Query->group);
        $Model = $Model->having($Query->having);
        $Model = $Model->order($Query->order);
        $Model = $Model->select();

        return $Model->toArray();
    }

    /**
     * 获取总数
     * @param Query $Query
     * @return mixed
     */
    public function getTotal(Query $Query)
    {
        $Model = $this->Model;
        $Model = $Model->where($Query->where);
        $Model = $Model->whereOr($Query->whereOr);
        $Model = $Model->field($Query->field);
        $Model = $Model->group($Query->group);
        $Model = $Model->having($Query->having);
        $Model = $Model->select();

        return $Model->count();
    }

    /**
     * 获取全部
     * @param Query $Query
     * @return mixed
     */
    public function getAll(Query $Query)
    {
        $Model = $this->Model;
        $Model = $Model->where($Query->where);
        $Model = $Model->whereOr($Query->whereOr);
        $Model = $Model->field($Query->field);
        $Model = $Model->group($Query->group);
        $Model = $Model->having($Query->having);
        $Model = $Model->order($Query->order);
        $Model = $Model->select();

        return $Model->toArray();
    }

    /**
     * 获取单个
     * @param Query $Query
     * @return mixed
     */
    public function getOne(Query $Query)
    {
        $Model = $this->Model;
        $Model = $Model->where($Query->where);
        $Model = $Model->whereOr($Query->whereOr);
        $Model = $Model->field($Query->field);
        $Model = $Model->order($Query->order);
        $Model = $Model->findOrEmpty();

        return $Model->toArray();
    }

    /**
     * 通过ID获取
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $Query = new Query();

        $Query->where[] = ['id', '=', $id];

        return $this->getOne($Query);
    }

    /**
     * 通过参数ID更新
     * @param array $params
     * @return bool
     */
    public function updateById(array $params)
    {
        $Query = new Query();

        $Query->where[] = ['id', '=', $params['id']];

        return $this->updateRecord($Query, $params);
    }

    /**
     * 通过参数ID删除
     * @param $id
     * @return bool
     */
    public function deleteById($id)
    {
        $Query = new \app\common\repository\Query();

        $Query->where[] = ['id', 'IN', $id];

        return $this->deleteRecord($Query);
    }

    /**
     * 创建数据
     * @param array $params
     * @return mixed
     */
    public function createRecord(array $params = [])
    {
        return $this->Model->create($params);
    }

    /**
     * 更新数据
     * @param Query $Query
     * @param array $params
     * @return bool
     */
    public function updateRecord(Query $Query, array $params = [])
    {
        return false !== $this->Model->where($Query->where)->whereOr($Query->whereOr)->update($params);
    }

    /**
     * 删除数据
     * @param Query $Query
     * @return mixed
     */
    public function deleteRecord(Query $Query)
    {
        return $this->Model->destroy(function ($query) use ($Query) {
            $query->where($Query->where);
            $query->whereOr($Query->whereOr);
        });
    }

    /**
     * 批量新增
     * @param array $params
     * @return mixed
     */
    public function insertAll(array $params = [])
    {
        return $this->Model->insertAll($params);
    }
}