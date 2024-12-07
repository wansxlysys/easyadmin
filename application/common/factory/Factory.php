<?php


namespace app\common\factory;


use ReflectionClass;
use ReflectionException;

class Factory
{
    /**
     * 实例
     * @var array
     */
    public static $instances = [];

    /**
     * 获取实例
     * @throws object
     */
    public static function get($className)
    {
        if (isset(static::$instances[$className])) {
            return static::$instances[$className];
        }

        /**
         * 创建反射
         */
        $reflectionClass = new ReflectionClass($className);

        /**
         * 实例化类
         */
        $instanceClass = $reflectionClass->newInstance();

        /**
         * 放入容器
         */
        static::$instances[$className] = $instanceClass;

        /**
         * 注入依赖
         */
        static::injectDependency($instanceClass, $reflectionClass);

        return $instanceClass;
    }

    /**
     * 注入依赖
     * @param object $instancesClass
     * @param ReflectionClass $reflectionClass
     * @throws ReflectionException
     */
    private static function injectDependency($instancesClass, $reflectionClass)
    {
        /**
         * 循环每个方法
         */
        foreach ($reflectionClass->getMethods() as $method) {

            /**
             * 检测是否为自动注入方法
             */
            if (strstr($method->getName(), 'inject')) {

                $dependencies = [];

                /**
                 * 循环每个参数
                 */
                foreach ($method->getParameters() as $parameter) {

                    $parameterClassName = $parameter->getClass()->getName();

                    /**
                     * 检测容器中是否已经实例化
                     */
                    if (!isset(static::$instances[$parameterClassName])) {
                        static::$instances[$parameterClassName] = static::get($parameterClassName);
                    }

                    /**
                     * 放入依赖
                     */
                    $dependencies[] = static::$instances[$parameterClassName];
                }

                /**
                 * 设置访问权限
                 */
                if (!$method->isPublic()) {
                    $method->setAccessible(true);
                }

                /**
                 * 注入依赖
                 */
                $method->invoke($instancesClass, ...$dependencies);
            }
        }
    }
}