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
        $controllerClass = $params[0];
        $reflectionClass = new ReflectionClass($controllerClass);

        Dependency::injectMethods($controllerClass, $reflectionClass);
        Dependency::injectProperties($controllerClass, $reflectionClass);
    }
}