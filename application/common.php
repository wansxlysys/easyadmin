<?php


use think\facade\App;

use app\common\taglib\TagParser;
use app\common\dependency\Dependency;

/**
 * 引入静态文件并加入版本号
 * @param $url
 * @return string
 */
function static_url($url)
{
    return config('system.static_path') . $url . '?v=' . config('system.version');
}

/**
 * 标签解析函数
 * @param $name
 * @param $module
 * @return TagParser
 */
function tag_parser($name, $module = 'common')
{
    return new TagParser($name, $module);
}

/**
 * 获取依赖层
 * @param $name
 * @param string $module
 * @return object
 */
function service($name, $module = '')
{
    if (empty($module)) {
        $module = request()->module();
    }

    return Dependency::getClass(App::parseClass($module, 'service', $name));
}

/**
 * 获取依赖层
 * @param $name
 * @param $module
 * @return object
 */
function helper($name, $module = '')
{
    return app()->create($name, 'helper', true, $module);
}

/**
 * 获取依赖层
 * @param $name
 * @param $module
 * @return object
 */
function util($name, $module = '')
{
    return app()->create($name, 'util', true, $module);
}