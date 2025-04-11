<?php


namespace app\admin\behavior;


use app\admin\dependency\SystemLogDependency;
use app\admin\enum\SystemLogEnum;
use Exception;
use think\Request;
use think\Response;

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

                $SystemLogService = SystemLogDependency::getService();

                $SystemLogService->writeLog($responseData['msg'], SystemLogEnum::translateCode($responseData['code']));
            }
        }
    }
}