<?php


namespace app\common\extend\JsonRpc;


use Exception;
use RuntimeException;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RpcClient
{
    /**
     * 服务地址
     * @var string
     */
    protected $url = '';

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
     * 请求头
     * @var array
     */
    protected $header = [];

    /**
     * 设置地址
     * @param $url
     * @return RpcClient
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
     * @param array $params
     * @return RpcClient
     */
    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * 添加请求头
     * @param $key
     * @param $value
     * @return $this
     */
    public function addHeader($key, $value)
    {
        $this->header[$key] = $value;
        return $this;
    }

    /**
     * 发送请求
     * @throws Exception|GuzzleException
     */
    public function dispatch()
    {
        $query['target'] = $this->target;
        $query['method'] = $this->method;

        /**
         * 发起请求
         */
        $response = (new Client())->post($this->url, [
            'query'   => $query,
            'json'    => $this->params,
            'headers' => $this->header
        ]);

        /**
         * 检测响应状态
         */
        $content = json_decode($response->getBody(), true);

        if ($content['code'] != 200) {
            throw new RuntimeException($content['msg']);
        }

        /**
         * 返回响应结果
         */
        return $content['data'];
    }
}