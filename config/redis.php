<?php


use think\facade\Env;

return [
    // 连接参数
    'params'  => [
        // 服务器地址
        'host'     => Env::get('redis.host'),
        // 数据库名
        'database' => Env::get('redis.database'),
        // 密码
        'password' => Env::get('redis.password'),
    ],
    // 连接选项
    'options' => [
        // KEY前缀
        'prefix' => Env::get('redis.prefix'),
    ]
];