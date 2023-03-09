<?php


namespace app\common\exception;


class NotFoundException extends \RuntimeException
{
    /**
     * 初始化
     * @param string $message
     */
    public function __construct($message = '')
    {
        parent::__construct($message, 404);
    }
}