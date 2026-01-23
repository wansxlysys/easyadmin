<?php


use app\Common\behavior\AppInitBehavior;
use app\Common\behavior\AppBeginBehavior;
use app\Common\behavior\ActionBeginBehavior;
use app\Queue\behavior\QueueFailedBehavior;

return [
    // 应用初始化
    'app_init'     => [
        AppInitBehavior::class
    ],
    // 应用开始
    'app_begin'    => [
        AppBeginBehavior::class
    ],
    // 模块初始化
    'module_init'  => [],
    // 操作开始执行
    'action_begin' => [
        ActionBeginBehavior::class
    ],
    // 视图内容过滤
    'view_filter'  => [],
    // 日志写入
    'log_write'    => [],
    // 应用结束
    'app_end'      => [],
    // 队列消费失败
    'queue_failed' => [
        QueueFailedBehavior::class
    ]
];
