<?php


use think\facade\Env;

return [
    // 连接参数
    'params'  => [
        // 服务器地址
        'host'     => Env::get('REDIS_HOSTNAME'),
        // 数据库名
        'database' => Env::get('REDIS_DATABASE'),
        // 密码
        'password' => Env::get('REDIS_PASSWORD'),
    ],
    // 连接选项
    'options' => [
        // KEY前缀
        'prefix' => Env::get('REDIS_PREFIX'),
    ]
];