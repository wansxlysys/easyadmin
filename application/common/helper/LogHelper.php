<?php


namespace app\common\helper;


use think\facade\Log;

class LogHelper
{
    /**
     * 写入任务日志
     * @param $message
     * @param array $context
     */
    public static function queue($message, array $context = [])
    {
        Log::log('queue', $message, $context);
    }
}