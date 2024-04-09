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
     * and回调
     * @var Closure
     */
    protected $closureWhere = null;

    /**
     * or回调
     * @var Closure
     */
    protected $closureWhereOr = null;

    /**
     * 设置回调
     * @param string $name
     * @param Closure $closure
     */
    public function setClosure($name, Closure $closure)
    {
        $this->closure[$name] = $closure;
    }

    /**
     * 获取回调
     * @param $name
     * @return mixed
     */
    public function getClosure($name)
    {
        return $this->closure[$name] ?? '';
    }

    /**
     * 设置回调
     * @param Closure $closure
     */
    public function setClosureWhere(Closure $closure)
    {
        $this->closureWhere = $closure;
    }

    /**
     * 获取and回调
     * @return Closure
     */
    public function getClosureWhere()
    {
        return $this->closureWhere;
    }

    /**
     * 设置回调
     * @param Closure $closure
     */
    public function setClosureWhereOr(Closure $closure)
    {
        $this->closureWhereOr = $closure;
    }

    /**
     * 获取or回调
     * @return Closure
     */
    public function getClosureWhereOr()
    {
        return $this->closureWhereOr;
    }
}