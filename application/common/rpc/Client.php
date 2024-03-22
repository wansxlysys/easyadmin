<?php


namespace app\common\rpc;


use Throwable;
use rpc\RpcClient;
use RuntimeException;
use think\facade\Config;

abstract class Client
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
    public function sendRequest($method, array $params = [])
    {
        $url    = Config::get('rpc.url');
        $reqKey = Config::get('rpc.key');

        $RpcClient = new RpcClient();

        $RpcClient->setUrl($url);
        $RpcClient->setReqkey($reqKey);
        $RpcClient->setMethod($method);
        $RpcClient->setParams($params);
        $RpcClient->setTarget($this->target);

        return $RpcClient->dispatch();
    }
}