<?php


namespace app\admin\behavior;


use Exception;

use think\Request;
use think\Response;

use app\admin\service\SystemLogService;

class SystemLogBehavior
{
    /**
     * 应用结束时执行
     * @param Request $request
     * @param Response $response
     * @throws Exception
     */
    public static function appEnd(Request $request, Response $response)
    {
        if ($request->isPost()) {

            $responseData = $response->getData();

            if (isset($responseData['code'])) {

                $SystemLogService = new SystemLogService();

                $SystemLogService->writeLog($responseData['msg'], $SystemLogService->translateCode($responseData['code']));
            }
        }
    }
}