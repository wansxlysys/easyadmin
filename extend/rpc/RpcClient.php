<?php


namespace rpc;


use Throwable;
use RuntimeException;
use GuzzleHttp\Client;

class RpcClient
{
    /**
     * 服务地址
     * @var string
     */
    protected $reqUrl = '';

    /**
     * 密钥
     * @var string
     */
    protected $reqkey = '';

    /**
     * 请求目标
     * @var string
     */
    protected $target = '';

    /**
     * 请求方法
     * @var string
     */
    protected $method = '';

    /**
     * 请求参数
     * @var array
     */
    protected $params = [];

    /**
     * 设置地址
     * @param $url
     * @return RpcClient
     */
    public function setReqUrl($url)
    {
        $this->reqUrl = $url;
        return $this;
    }

    /**
     * 设置密钥
     * @param $reqkey
     * @return RpcClient
     */
    public function setReqkey($reqkey)
    {
        $this->reqkey = $reqkey;
        return $this;
    }

    /**
     * 设置目标
     * @param $target
     * @return RpcClient
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * 设置方法
     * @param $method
     * @return RpcClient
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * 设置请求参数
     * @param $params
     * @return RpcClient
     */
    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * 发送请求
     * @throws Throwable
     */
    public function dispatch()
    {
        $query['target'] = $this->target;
        $query['method'] = $this->method;
        $query['reqkey'] = $this->reqkey;

        /**
         * 发起请求
         */
        $response = (new Client())->post($this->reqUrl, [
            'query' => $query,
            'json'  => $this->params
        ]);

        /**
         * 检测状态码
         */
        if ($response->getStatusCode() != 200) {
            throw new RuntimeException($response->getBody());
        }

        /**
         * 返回响应结果
         */
        return json_decode($response->getBody(), true);
    }
}