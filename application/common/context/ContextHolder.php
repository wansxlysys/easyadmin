<?php


namespace app\common\context;


class ContextHolder
{
    /**
     * 缓存
     * @var array
     */
    protected static $store = [];

    /**
     * 检测缓存变量是否存在
     * @param $name
     * @return bool
     */
    public static function has($name)
    {
        return isset(static::$store[$name]);
    }

    /**
     * 设置缓存
     * @param $name
     * @param $value
     */
    public static function set($name, $value)
    {
        static::$store[$name] = $value;
    }

    /**
     * 获取缓存
     * @param $name
     * @return mixed|null
     */
    public static function get($name)
    {
        return static::$store[$name] ?? null;
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