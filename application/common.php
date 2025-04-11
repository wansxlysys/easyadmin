<?php


if (!function_exists('register_static')) {
    /**
     * 引入静态文件并加入版本号
     * @param $url
     * @return string
     */
    function register_static($url)
    {
        return config('system.static_path') . $url . '?v=' . config('system.version');
    }
}

if (!function_exists('empty_image')) {
    /**
     * 输出展位图片
     * @param $image
     * @param $default
     * @return bool|mixed
     */
    function empty_image($image, $default)
    {
        if (empty($image)) {
            return $default;
        }

        return $image;
    }
}

if (!function_exists('service')) {
    /**
     * 获取依赖层
     * @param $name
     * @param $common
     * @return object
     */
    function service($name, $common)
    {
        return app()->model($name, 'dependency', true, $common)->getService();
    }
}

if (!function_exists('dependency')) {
    /**
     * 获取依赖层
     * @param $name
     * @param $common
     * @return object
     */
    function dependency($name, $common)
    {
        return app()->model($name, 'dependency', true, $common);
    }
}

if (!function_exists('helper')) {
    /**
     * 获取依赖层
     * @param $name
     * @param $common
     * @return object
     */
    function helper($name, $common)
    {
        return app()->model($name, 'helper', true, $common);
    }
}

if (!function_exists('util')) {
    /**
     * 获取依赖层
     * @param $name
     * @param $common
     * @return object
     */
    function util($name, $common)
    {
        return app()->model($name, 'util', true, $common);
    }
}