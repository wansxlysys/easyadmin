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

if (!function_exists('log_write')) {
    /**
     * 日志写入
     * @param string $description
     * @param int $status
     * @return bool|mixed
     */
    function log_write($description = '', $status = 1)
    {
        return (new \app\admin\service\Log())->writeLog($description, $status);
    }
}