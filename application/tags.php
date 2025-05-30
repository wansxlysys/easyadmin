<?php


use app\common\behavior\AspectBehavior;
use app\common\behavior\InterceptorBehavior;
use app\common\behavior\SystemBehavior;

use app\queue\exception\QueueExceptionHandler;

return [
    // 应用初始化
    'app_init'     => [
        SystemBehavior::class
    ],
    // 应用开始
    'app_begin'    => [
        InterceptorBehavior::class,
        AspectBehavior::class
    ],
    // 模块初始化
    'module_init'  => [],
    // 操作开始执行
    'action_begin' => [],
    // 视图内容过滤
    'view_filter'  => [],
    // 日志写入
    'log_write'    => [],
    // 应用结束
    'app_end'      => [],
    // 队列消费失败
    'queue_failed' => [
        QueueExceptionHandler::class
    ]
];
