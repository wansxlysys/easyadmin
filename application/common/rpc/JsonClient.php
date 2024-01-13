<?php


namespace app\common\rpc;


use Throwable;
use RuntimeException;
use GuzzleHttp\Client;

class JsonClient
{
    /**
     * 请求成功
     */
    const SUCCESS = 200;

    /**
     * 请求地址
     * @var string
     */
    protected $base = '';

    /**
     * 请求路径
     * @var string
     */
    protected $uri = '';

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
     * 请求地址
     * @param $base
     * @return JsonClient
     */
    public function setBase($base)
    {
        $this->base = $base;
        return $this;
    }

    /**
     * 请求路径
     * @param $uri
     * @return JsonClient
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * 设置目标
     * @param $target
     * @return JsonClient
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * 设置方法
     * @param $method
     * @return JsonClient
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * 设置请求参数
     * @param $params
     * @return JsonClient
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * 设置请求参数
     * @param $key
     * @param $value
     * @return JsonClient
     */
    public function addHeader($key, $value)
    {
        $this->header[$key] = $value;
        return $this;
    }

    /**
     * 设置请求参数
     * @param $header
     * @return JsonClient
     */
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * 发送请求
     * @throws Throwable
     */
    public function sendRequest()
    {
        $client = new Client([
            'base_uri' => $this->base
        ]);

        $query['target'] = $this->target;
        $query['method'] = $this->method;

        /**
         * 发起请求
         */
        $response = $client->post($this->uri, [
            'query'   => $query,
            'headers' => $this->header,
            'json'    => $this->params
        ]);

        /**
         * 处理响应结果
         */
        $body = json_decode($response->getBody(), true);

        if ($body['code'] != static::SUCCESS) {
            throw new RuntimeException($body['data']);
        }

        return $body['data'];
    }
}