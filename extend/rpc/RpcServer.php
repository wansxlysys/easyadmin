<?php


namespace rpc;


use RuntimeException;

class RpcServer
{
    /**
     * 校验密钥
     * @var string
     */
    protected $rpckey = '';

    /**
     * 请求密钥
     * @var string
     */
    protected $reqkey = '';

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
     * @param $rpckey
     * @return $this
     */
    public function setRpckey($rpckey)
    {
        $this->rpckey = $rpckey;
        return $this;
    }

    /**
     * 设置请求密钥
     * @param $reqkey
     * @return $this
     */
    public function setReqkey($reqkey)
    {
        $this->reqkey = $reqkey;
        return $this;
    }

    /**
     * 调度
     * @return mixed
     */
    public function dispatch()
    {
        if ($this->rpckey != $this->reqkey) {
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