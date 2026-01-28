<?php


namespace app\common\taglib;


use app\common\dependency\Dependency;

class TagParser
{
    /**
     * 参数
     * @var array
     */
    protected $params = [];

    /**
     * 解析器
     * @var object
     */
    protected $Parser;

    /**
     * 初始化
     * @param $name
     * @param $layer
     */
    public function __construct($name, $layer = 'common')
    {
        $this->Parser = Dependency::getClass(sprintf('\app\%s\taglib\parser\%s', $layer, $name));
    }

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
     * @return TagParser
     */
    public function add($name, $value)
    {
        if ($value !== null) {
            $this->params[$name] = $value;
        }

        return $this;
    }

    /**
     * 调用
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func([$this->Parser, $name], array_merge($this->params, $arguments));
    }
}