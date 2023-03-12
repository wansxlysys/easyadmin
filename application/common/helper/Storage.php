<?php


namespace app\common\helper;


class Storage
{
    /**
     * 容器
     * @var array
     */
    private static $store = [];

    /**
     * 检测容器变量是否存在
     * @param $name
     * @return bool
     */
    public static function has($name)
    {
        return isset(static::$store[$name]);
    }

    /**
     * 设置容器
     * @param $name
     * @param $value
     */
    public static function set($name, $value)
    {
        static::$store[$name] = $value;
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
            static::set($name, $resolve());
        }

        return isset(static::$store[$name]) ? static::$store[$name] : null;
    }

    /**
     * 删除缓存
     * @param $name
     * @return void
     */
    public function del($name)
    {
        if (isset(static::$store[$name])) {
            unset(static::$store[$name]);
        }
    }

    /**
     * 获取全部
     * @return array
     */
    public static function getAll()
    {
        return static::$store;
    }

    /**
     * 清除全部缓存
     */
    public static function clear()
    {
        static::$store = [];
    }
}