<?php


namespace app\common\taglib;


class TagParams
{
    /**
     * 参数
     * @var array
     */
    protected $params = [];

    /**
     * 获取参数
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return isset($this->params[$name]) ? $this->params : $default;
    }

    /**
     * 添加参数
     * @param $name
     * @param $value
     * @return TagParams
     */
    public function add($name, $value)
    {
        if ($value !== null) {
            $this->params[$name] = $value;
        }

        return $this;
    }

    /**
     * 导出参数
     * @return array
     */
    public function toArray()
    {
        return $this->params;
    }
}