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
     * @return object
     */
    function service($name)
    {
        return app()->model($name, 'dependency')->getService();
    }
}

if (!function_exists('dependency')) {
    /**
     * 获取依赖层
     * @param $name
     * @return object
     */
    function dependency($name)
    {
        return app()->model($name, 'dependency');
    }
}