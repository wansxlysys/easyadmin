<?php


namespace app\common\repository;


trait SubTable
{
    /**
     * 是否分表
     * @var bool
     */
    protected $isSub = false;

    /**
     * 分表规则
     * @var array
     */
    protected $subRule = [];

    /**
     * 分表数据
     * @var mixed
     */
    protected $subData;

    /**
     * 设置是否分表
     * @param $isSub
     * @return mixed
     */
    public function setSub($isSub)
    {
        $this->isSub = $isSub;
        return $this;
    }

    /**
     * 设置分表数据
     * @param array $data
     * @return mixed
     */
    public function setSubData(array $data)
    {
        $this->subData = $data;
        return $this;
    }

    /**
     * 设置分表规则
     * @param array $rule
     * @return $this
     */
    public function setSubRule(array $rule)
    {
        $this->subRule = $rule;
        return $this;
    }

    /**
     * 获取分表表名（分表需要重写该方法）
     */
    public function getSubName()
    {
        return $this->name;
    }

    /**
     * 通过取余方式获取子表表名
     * @param $value
     * @param $total
     * @return int
     */
    public function getSubNameByMod($value, $total)
    {
        return ($value % $total) + 1;
    }
}