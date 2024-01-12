<?php


namespace app\common\rpc;


use Throwable;
use RuntimeException;

class JsonServer
{
    /**
     * 请求成功
     */
    const SUCCESS = 200;

    /**
     * 请求失败
     */
    const ERROR = 400;

    /**
     * 请求服务
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
     * 服务
     * @var array
     */
    protected $server = [];

    /**
     * @param $target
     * @param $server
     * @return $this
     */
    public function addServer($target, $server)
    {
        $this->server[$target] = $server;
        return $this;
    }

    /**
     * 设置服务
     * @param $target
     * @return JsonServer
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * 设置方法
     * @param $method
     * @return JsonServer
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * 设置请求参数
     * @param $params
     * @return JsonServer
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * 调度
     * @return mixed
     */
    public function dispatch()
    {
        try {

            if (empty($this->server[$this->target])) {
                throw new RuntimeException('target server not exists');
            }

            if (empty($this->params)) {
                $data = call_user_func([new $this->server[$this->target], $this->method]);
            } else {
                $data = call_user_func_array([new $this->server[$this->target], $this->method], $this->params);
            }

            return $this->response(static::SUCCESS, $data);

        } catch (Throwable $throwable) {
            return $this->response(static::ERROR, $throwable->getMessage());
        }
    }

    /**
     * 响应
     * @param $code
     * @param $data
     * @return false|string
     */
    protected function response($code, $data)
    {
        $result['code'] = $code;
        $result['data'] = $data;

        return $result;
    }
}