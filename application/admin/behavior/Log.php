<?php


namespace app\admin\behavior;


use think\Response;
use think\facade\Request;

/**
 * 日志钩子
 * @package app\admin\behavior
 */
class Log
{
    /**
     * 执行句柄
     * @param $response
     */
    public function run(Response $response)
    {
        if (Request::isPost()) {

            $responseData = $response->getData();

            if (isset($responseData['code'])) {

                /**
                 * 框架响应状态码转系统状态码
                 */
                $codeMap = [1 => 1, 0 => 2];

                $LogService = new \app\admin\service\Log();

                $LogService->writeLog("系统自动记录：{$responseData['msg']}", $codeMap[$responseData['code']]);
            }
        }
    }
}