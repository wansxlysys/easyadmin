<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

return [
    // Redis驱动
    'connector'  => 'Redis',
    // 任务的过期时间
    'expire'     => 60,
    // 默认的队列名称
    'default'    => 'default',
    // Redis地址
    'host'       => '127.0.0.1',
    // Redis端口
    'port'       => 6379,
    // Redis密码
    'password'   => '',
    // Redis数据库
    'select'     => 0,
    // Redis连接的超时
    'timeout'    => 0,
    // 是否为长连接
    'persistent' => false,
];
