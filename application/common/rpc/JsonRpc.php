<?php


namespace app\common\rpc;


use Throwable;

class JsonRpc
{
    /**
     * 服务地址
     * @var string
     */
    protected $uri = '/index/index/server';

    /**
     * 请求域名
     * @var string
     */
    protected $base = 'http://127.0.0.1:9000';

    /**
     * 请求头
     * @var array
     */
    protected $header = [
        'Secret-Key' => 'A8FB327026A9C5B769A63C9C534DB042'
    ];

    /**
     * 服务类
     * @var string
     */
    protected $target = '';

    /**
     * 发送
     * @param $method
     * @param array $params
     * @return mixed
     * @throws Throwable
     */
    public function sendRequest($method, array $params = [])
    {
        return (new JsonClient())
            ->setUri($this->uri)
            ->setBase($this->base)
            ->setTarget($this->target)
            ->setHeader($this->header)
            ->setMethod($method)
            ->setParams($params)
            ->sendRequest();
    }
}