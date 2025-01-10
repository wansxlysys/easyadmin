<?php


namespace app\common\dependency;


class DependencyAspect
{
    /**
     * 切面配置
     * @var array
     */
    protected static $aspectConfig = [];

    /**
     * 注册切面类
     * @param $className
     * @param $methodName
     * @param $aspectClass
     * @return void
     */
    public static function register($className, $methodName, $aspectClass)
    {
        static::$aspectConfig[$className][$methodName][] = Dependency::getInstance($aspectClass);
    }

    /**
     * 获取切面类
     * @param $className
     * @return mixed
     */
    public static function getAspect($className)
    {
        return static::$aspectConfig[$className] ?? [];
    }

    /**
     * 清空切面
     * @return void
     */
    public static function clearAspect()
    {
        static::$aspectConfig = [];
    }

    /**
     * 移除切面
     * @param $className
     * @param string $methodName
     * @return void
     */
    public static function removeAspect($className, $methodName = '')
    {
        if (empty($methodName)) {
            static::$aspectConfig[$className] = [];
        } else {
            static::$aspectConfig[$className][$methodName] = [];
        }
    }
}