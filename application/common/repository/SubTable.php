<?php


namespace app\common\repository;


trait SubTable
{
    /**
     * 分表数据
     * @var mixed
     */
    protected $subData = null;

    /**
     * 使用分表
     * @param $subData
     * @return SubTable
     */
    public function useSub($subData)
    {
        $this->subData = $subData;
        return $this;
    }

    /**
     * 不使用分表
     * @return SubTable
     */
    public function nonSub()
    {
        $this->subData = null;
        return $this;
    }

    /**
     * 获取表名
     * @return string
     */
    public function getName()
    {
        if (is_null($this->subData)) {
            return $this->name;
        }

        return $this->getSubName();
    }

    /**
     * 获取分表表名
     */
    public function getSubName()
    {
        return $this->name;
    }
}