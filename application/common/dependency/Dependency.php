<?php


namespace app\common\dependency;


use ReflectionClass;
use ReflectionException;

class Dependency
{
    /**
     * 实例对象
     * @var array
     */
    private static $instances = [];

    /**
     * 获取实例对象
     * @template T
     * @param class-string<T> $className
     * @return T
     * @throws object
     */
    public static function getClass($className)
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
        static::injectMethods($instanceClass, $reflectionClass);
        static::injectProperties($instanceClass, $reflectionClass);

        return $instanceClass;
    }

    /**
     * 注入依赖
     * @param object $instancesClass
     * @param ReflectionClass $reflectionClass
     * @throws ReflectionException
     */
    public static function injectMethods($instancesClass, $reflectionClass)
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
                 * 收集依赖
                 */
                foreach ($method->getParameters() as $parameter) {

                    $parameterClassName = $parameter->getClass()->getName();

                    /**
                     * 检测容器中是否已经实例化
                     */
                    if (!isset(static::$instances[$parameterClassName])) {
                        static::$instances[$parameterClassName] = static::getClass($parameterClassName);
                    }

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

    /**
     * 注入属性
     * @param object $instancesClass
     * @param ReflectionClass $reflectionClass
     * @return void
     */
    public static function injectProperties($instancesClass, $reflectionClass)
    {
        /**
         * 循环每个属性
         */
        foreach ($reflectionClass->getProperties() as $property) {

            if ($property->hasType()) {

                /**
                 * 判断是否非基础类型
                 */
                if (!$property->getType()->isBuiltin()) {

                    $propertyClassName = $property->getType()->getName();

                    /**
                     * 检测容器中是否已经实例化
                     */
                    if (!isset(static::$instances[$propertyClassName])) {
                        static::$instances[$propertyClassName] = static::getClass($propertyClassName);
                    }

                    if (!$property->isPublic()) {
                        $property->setAccessible(true);
                    }

                    $property->setValue($instancesClass, static::$instances[$propertyClassName]);
                }
            }
        }
    }
}