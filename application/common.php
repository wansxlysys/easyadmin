<?php

use app\common\dependency\Dependency;

/**
 * 引入静态文件并加入版本号
 * @param $url
 * @return string
 */
function register_static($url)
{
    return config('system.static_path') . $url . '?v=' . config('system.version');
}

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

/**
 * 获取依赖层
 * @param $name
 * @param string $module
 * @return object
 */
function service($name, $module = '')
{
    if (empty($layer)) {
        $module = request()->module();
    }

    return Dependency::getProxy(app()->parseClass($module, 'service', $name));
}

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