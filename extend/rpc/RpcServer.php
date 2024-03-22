<?php


namespace rpc;


use RuntimeException;

class RpcServer
{
    /**
     * 校验密钥
     * @var string
     */
    protected $rpcKey = '';

    /**
     * 请求密钥
     * @var string
     */
    protected $reqKey = '';

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
     * 设置服务
     * @var array
     */
    protected $server = [];

    /**
     * 目标服务
     * @var string
     */
    protected $target = '';

    /**
     * 设置服务
     * @param $server
     * @return $this
     */
    public function setServer($server)
    {
        $this->server = $server;
        return $this;
    }

    /**
     * 设置服务
     * @param $name
     * @param $server
     * @return $this
     */
    public function addServer($name, $server)
    {
        $this->server[$name] = $server;
        return $this;
    }

    /**
     * 设置目标
     * @param $target
     * @return RpcServer
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * 设置方法
     * @param $method
     * @return RpcServer
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * 设置请求参数
     * @param $params
     * @return RpcServer
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * 设置请求密钥
     * @param $rpcKey
     * @return $this
     */
    public function setRpcKey($rpcKey)
    {
        $this->rpcKey = $rpcKey;
        return $this;
    }

    /**
     * 设置请求密钥
     * @param $reqKey
     * @return $this
     */
    public function setReqKey($reqKey)
    {
        $this->reqKey = $reqKey;
        return $this;
    }

    /**
     * 调度
     * @return mixed
     */
    public function dispatch()
    {
        if ($this->rpcKey != $this->reqKey) {
            throw new RuntimeException('rpckey error');
        }

        if (!isset($this->server[$this->target])) {
            throw new RuntimeException('target server not exists');
        }

        $target = new $this->server[$this->target];

        if (empty($this->params)) {
            $data = call_user_func([$target, $this->method]);
        } else {
            $data = call_user_func_array([$target, $this->method], $this->params);
        }

        return $data;
    }
}