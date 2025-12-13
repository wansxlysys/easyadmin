<?php


namespace app\common\extend\rpc;


use Throwable;
use RuntimeException;

class RpcServer
{
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

    protected function result($code, $msg, $data = null)
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }

    /**
     * 执行服务
     * @return array
     */
    public function dispatch()
    {
        try {

            if (!isset($this->server[$this->target])) {
                throw new RuntimeException($this->target . '服务不存在', 404);
            }

            $class = new $this->server[$this->target];

            if (!method_exists($class, $this->method)) {
                throw new RuntimeException($this->method . '方法不存在', 404);
            }

            if (empty($this->params)) {
                $data = call_user_func([$class, $this->method]);
            } else {
                $data = call_user_func_array([$class, $this->method], $this->params);
            }

        } catch (Throwable $throwable) {
            return $this->result($throwable->getCode(), '远程调用失败：' . $throwable->getMessage());
        }

        return $this->result(200, 'success', $data);
    }
}