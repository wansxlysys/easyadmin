<?php


namespace app\admin\behavior;


use think\Request;
use think\Response;
use app\admin\service\SystemLogService;
use app\common\exception\SystemException;

class SystemLogBehavior
{
    /**
     * 应用结束时执行
     * @param Request $request
     * @param Response $response
     * @throws SystemException
     */
    public static function appEnd(Request $request, Response $response)
    {
        if ($request->isPost()) {

            $responseData = $response->getData();

            if (isset($responseData['code'])) {

                $SystemLogService = new SystemLogService();

                $SystemLogService->writeLog("系统自动记录：{$responseData['msg']}", $SystemLogService->translateCode($responseData['code']));
            }
        }
    }
}