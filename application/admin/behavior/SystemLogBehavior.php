<?php


namespace app\admin\behavior;


use think\Response;
use think\facade\Request;
use app\admin\service\SystemLogService;

class SystemLogBehavior
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

                $SystemLogService = new SystemLogService();

                $SystemLogService->writeLog("系统自动记录：{$responseData['msg']}", $SystemLogService->translateCode($responseData['code']));
            }
        }
    }
}