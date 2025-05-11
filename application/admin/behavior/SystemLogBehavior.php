<?php


namespace app\admin\behavior;


use app\admin\dependency\SystemOperLogDependency;
use app\admin\enum\SystemOperLogEnum;
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

                $SystemLogService = SystemOperLogDependency::getService();

                $SystemLogService->writeLog($responseData['msg'], SystemOperLogEnum::translateCode($responseData['code']));
            }
        }
    }
}