<?php


namespace app\common\helper;


class DebugHelper
{
    /**
     * 运行开始时间
     * @var float
     */
    protected static $startTime;

    /**
     * 设置运行开始时间
     * @return void
     */
    public static function start()
    {
        static::$startTime = microtime(true);
    }

    /**
     * 获取运行时间
     * @return float
     */
    public static function duration()
    {
        return round(microtime(true) - static::$startTime, 6);
    }
}