<?php


namespace app\rpc\client;


use Throwable;

use think\facade\Config;

use app\rpc\RpcClient;

abstract class BaseClient
{
    /**
     * 请求服务
     * @var string
     */
    protected $target = '';

    /**
     * 发送请求
     * @param $method
     * @param array $params
     * @return mixed
     * @throws Throwable
     */
    public function dispatch($method, array $params = [])
    {
        $RpcClient = new RpcClient();

        $RpcClient->setRequrl(Config::get('rpc.url'));
        $RpcClient->setReqkey(Config::get('rpc.key'));

        $RpcClient->setMethod($method);
        $RpcClient->setParams($params);
        $RpcClient->setTarget($this->target);

        return $RpcClient->dispatch();
    }
}