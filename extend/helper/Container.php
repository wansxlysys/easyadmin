<?php


namespace helper;

/**
 * 寄存器
 * @package helper
 */
class Container
{

    /**
     * 容器
     * @var array
     */
    private static $container = [];

    /**
     * 检测容器变量是否存在
     * @param $name
     * @return bool
     */
    public static function has($name)
    {
        return isset(self::$container[$name]);
    }

    /**
     * 设置容器
     * @param $name
     * @param $value
     */
    public static function set($name, $value)
    {
        self::$container[$name] = $value;
    }

    /**
     * 获取容器
     * @param $name
     * @param callable|null $resolve
     * @return mixed|null
     */
    public static function get($name, callable $resolve = null)
    {
        if (!is_null($resolve)) {
            self::set($name, $resolve());
        }

        return isset(self::$container[$name]) ? self::$container[$name] : null;
    }

    /**
     * 获取全部
     * @return array
     */
    public static function getAll()
    {
        return self::$container;
    }
}