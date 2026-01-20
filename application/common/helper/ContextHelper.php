<?php


namespace app\common\helper;


class ContextHelper
{
    /**
     * 缓存
     * @var array
     */
    protected static $context = [];

    /**
     * 检测缓存变量是否存在
     * @param $name
     * @return bool
     */
    public static function has($name)
    {
        return isset(static::$context[$name]);
    }

    /**
     * 设置缓存
     * @param $name
     * @param $value
     */
    public static function set($name, $value)
    {
        static::$context[$name] = $value;
    }

    /**
     * 获取缓存
     * @param $name
     * @param null $callback
     * @return mixed|null
     */
    public static function get($name, $callback = null)
    {
        if (isset(static::$context[$name])) {
            return static::$context[$name];
        }

        if ($callback == null) {
            return null;
        }

        return static::$context[$name] = $callback();
    }

    /**
     * 删除缓存
     * @param $name
     * @return void
     */
    public function del($name)
    {
        if (isset(static::$context[$name])) {
            unset(static::$context[$name]);
        }
    }

    /**
     * 获取全部
     * @return array
     */
    public static function getAll()
    {
        return static::$context;
    }

    /**
     * 清除全部缓存
     */
    public static function clear()
    {
        static::$context = [];
    }
}