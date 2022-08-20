<?php


namespace app\common\traits;


trait Business
{
    /**
     * 信息
     * @var string
     */
    protected $message = '';

    /**
     * 状态码
     * @var int
     */
    protected $code = 0;

    /**
     * 设置状态码
     * @param $code
     */
    protected function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * 设置信息
     * @param $message
     * @return bool
     */
    protected function setMessage($message)
    {
        $this->message = $message;
        return false;
    }

    /**
     * 获取状态码
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * 获取信息
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}