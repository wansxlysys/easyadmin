<?php


namespace app\common\interceptor;


class Interceptor
{
    /**
     * 过滤器
     * @var InterceptorHandler[]
     */
    private static $interceptors = [];

    /**
     * 获取过滤器
     * @return InterceptorHandler[]
     */
    public static function getInterceptors()
    {
        return static::$interceptors;
    }

    /**
     * 设置过滤器
     * @param $interceptor
     * @return void
     */
    public static function addInterceptor($interceptor)
    {
        if (!in_array($interceptor, static::$interceptors)) {
            static::$interceptors[] = $interceptor;
        }
    }
}