<?php


use think\facade\Env;

return [
    // 服务地址
    'url' => Env::get('RPC_URL'),
    // 请求密钥
    'key' => Env::get('RPC_KEY'),
];