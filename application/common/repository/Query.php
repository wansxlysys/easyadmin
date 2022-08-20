<?php


namespace app\common\repository;


/**
 * 构建器
 * @package app\common\repository
 */
class Query
{
    /**
     * 并联条件
     * @var array
     */
    public $where = [];

    /**
     * 或条件
     * @var array
     */
    public $whereOr = [];

    /**
     * 当前页
     * @var int
     */
    public $page = 1;

    /**
     * 偏移位置
     * @var int
     */
    public $offset = 0;

    /**
     * 限制条数
     * @var int
     */
    public $limit = 10;

    /**
     * 排序
     * @var array
     */
    public $order = [];

    /**
     * 查询字段
     * @var array
     */
    public $field = [];

    /**
     * 分组
     * @var array
     */
    public $group = [];

    /**
     * 分组筛选
     * @var string
     */
    public $having = '';

    /**
     * 支持动态赋值方法
     * @param $method
     * @param $args
     * @return mixed
     * @throws \Exception
     */
    public function __call($method, $args)
    {
        if (isset($this->$method)) {
            return call_user_func_array($this->$method, $args);
        } else {
            throw new \Exception('method not exists:' . __CLASS__ . '->' . $method);
        }
    }
}