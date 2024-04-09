<?php


namespace app\common\repository;


use Closure;

class Wrapper extends Query
{
    /**
     * 回调条件
     * @var array
     */
    protected $closure = [];

    /**
     * 设置回调
     * @param Closure $closure
     * @param string $name
     */
    public function addClosure(Closure $closure, $name = 'where')
    {
        $this->closure[$name] = $closure;
    }

    /**
     * 获取回调
     * @param $name
     * @return Closure
     */
    public function getClosure($name = 'where')
    {
        return function ($query) use ($name) {
            if (isset($this->closure[$name])) {
                $this->closure[$name]($query);
            }
        };
    }
}