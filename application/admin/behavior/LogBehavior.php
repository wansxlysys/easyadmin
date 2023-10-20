<?php


namespace app\admin\behavior;


use think\Response;
use think\facade\Request;
use app\admin\service\LogService;

class LogBehavior
{
    /**
     * 应用结束时执行
     * @param $response
     */
    public static function appEnd(Response $response)
    {
        if (Request::isPost()) {

            $responseData = $response->getData();

            if (isset($responseData['code'])) {

                /**
                 * 框架响应状态码转系统状态码
                 */
                $codeMap = [1 => 1, 0 => 2];

                $LogService = new LogService();

                $LogService->writeLog("系统自动记录：{$responseData['msg']}", $codeMap[$responseData['code']]);
            }
        }
    }
}