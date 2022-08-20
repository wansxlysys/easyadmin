<?php

namespace app\admin\behavior;

use think\facade\Request;

/**
 * 日志钩子
 * @package app\admin\behavior
 */
class Log
{
    /**
     * 执行入口
     * @param $response
     */
    public function run($response)
    {
        if (Request::isPost()) {
            $data = $response->getData();
            if (isset($data['code'])) {
                log_write('系统自动记录：' . $data['msg'], $this->getCode($data['code']));
            }
        }
    }

    /**
     * 获取status
     * @param $code
     * @return int
     */
    public function getCode($code)
    {
        $statusMap = [
            0 => 2,
            1 => 1
        ];

        return $statusMap[$code];
    }
}