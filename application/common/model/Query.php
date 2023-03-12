<?php


namespace app\common\model;


/**
 * 查询构建器
 * @package app\common\repository
 */
class Query
{
    /**
     * 并联条件
     * @var array
     */
    protected $where = [];

    /**
     * 或条件
     * @var array
     */
    protected $whereOr = [];

    /**
     * 当前页
     * @var int
     */
    protected $page = 1;

    /**
     * 限制条数
     * @var int
     */
    protected $limit = 10;

    /**
     * 排序
     * @var array
     */
    protected $order = [];

    /**
     * 查询字段
     * @var array
     */
    protected $field = [];

    /**
     * 分组
     * @var array
     */
    protected $group = [];

    /**
     * 分组筛选
     * @var string
     */
    protected $having = '';

    /**
     * 获取where
     * @return array
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * 设置where
     * @param array $where
     */
    public function setWhere(array $where)
    {
        $this->where = $where;
    }

    /**
     * 添加where
     * @param array $where
     */
    public function addWhere(array $where)
    {
        $this->where[] = $where;
    }

    /**
     * 获取whereOr
     * @return array
     */
    public function getWhereOr()
    {
        return $this->whereOr;
    }

    /**
     * 设置where
     * @param array $whereOr
     */
    public function setWhereOr(array $whereOr)
    {
        $this->whereOr = $whereOr;
    }

    /**
     * 添加where
     * @param array $whereOr
     */
    public function addWhereOr(array $whereOr)
    {
        $this->whereOr[] = $whereOr;
    }

    /**
     * 获取page
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * 设置分页
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = !empty($page) ? $page : $this->page;
    }

    /**
     * 获取limit
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * 设置查询条数
     * @param $limit
     */
    public function setLimit($limit)
    {
        $this->limit = !empty($limit) ? $limit : $this->limit;
    }

    /**
     * 获取order
     * @return array
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * 设置排序
     * @param array $order
     */
    public function setOrder(array $order)
    {
        $this->order = $order;
    }

    /**
     * 添加排序
     * @param $field
     * @param $order
     */
    public function addOrder($field, $order)
    {
        $this->order[$field] = $order;
    }

    /**
     * 获取field
     * @return array
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * 设置field
     * @param array $field
     */
    public function setField(array $field)
    {
        $this->field = $field;
    }

    /**
     * 添加field
     * @param $field
     */
    public function addField($field)
    {
        $this->field[] = $field;
    }

    /**
     * 获取group
     * @return array
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * 设置分组
     * @param array $group
     */
    public function setGroup(array $group)
    {
        $this->group = $group;
    }

    /**
     * 添加分组
     * @param $group
     */
    public function addGroup($group)
    {
        $this->group[] = $group;
    }

    /**
     * 获取having
     * @return string
     */
    public function getHaving()
    {
        return $this->having;
    }

    /**
     * 设置having
     * @param $having
     */
    public function setHaving($having)
    {
        $this->having = $having;
    }
}