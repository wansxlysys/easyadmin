<?php


namespace app\common\interceptor;


class Interceptor
{
    /**
     * 过滤器
     * @var InterceptorHandler[]
     */
    private static $filters = [];

    /**
     * 获取过滤器
     * @return InterceptorHandler[]
     */
    public static function getFilters()
    {
        return static::$filters;
    }

    /**
     * 设置过滤器
     * @param $filter
     * @return void
     */
    public static function addFilter($filter)
    {
        if (!in_array($filter, static::$filters)) {
            static::$filters[] = $filter;
        }
    }
}