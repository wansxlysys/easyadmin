<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
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

if (!function_exists('log_write')) {
    /**
     * 日志写入
     * @param string $description
     * @param int $status
     */
    function log_write($description = '', $status = 1)
    {
        $LogService = new \app\admin\service\Log();
        $LogService->writeLog($description, $status);
    }
}