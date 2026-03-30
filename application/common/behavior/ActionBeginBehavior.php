<?php


namespace app\common\behavior;


use ReflectionClass;
use ReflectionException;

use app\common\helper\InjectHelper;

class ActionBeginBehavior
{
    /**
     * 初始化钩子
     * @return void
     * @throws ReflectionException
     */
    public function run(array $params)
    {
        list($controller) = $params;

        $reflectionClass = new ReflectionClass($controller);

        InjectHelper::injectMethods($controller, $reflectionClass);
        InjectHelper::injectProperties($controller, $reflectionClass);
    }
}