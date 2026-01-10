<?php


use think\facade\App;

use app\common\taglib\TagParser;
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
 * 标签解析函数
 * @return TagParser
 */
function tag_parser($name, $layer = 'common')
{
    return new TagParser($name, $layer);
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

    return Dependency::getProxy(App::parseClass($module, 'service', $name));
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