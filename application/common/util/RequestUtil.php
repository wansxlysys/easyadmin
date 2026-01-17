<?php


namespace app\common\util;


use think\facade\Request;

class RequestUtil
{
    /**
     * 获取当前请求的路径
     * @return string
     */
    public static function getPath()
    {
        return implode('/', [Request::module(), Request::controller(), Request::action()]);
    }
}