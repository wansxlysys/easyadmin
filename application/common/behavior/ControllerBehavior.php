<?php


namespace app\common\behavior;


use ReflectionClass;
use ReflectionException;

use app\common\dependency\Dependency;

class ControllerBehavior
{
    /**
     * 初始化钩子
     * @return void
     * @throws ReflectionException
     */
    public function run(array $params)
    {
        list($controller, $action) = $params;

        $reflectionClass = new ReflectionClass($controller);

        Dependency::injectMethods($controller, $reflectionClass);
        Dependency::injectProperties($controller, $reflectionClass);
    }
}