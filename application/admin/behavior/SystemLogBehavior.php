<?php


namespace app\admin\behavior;


use Exception;

use think\Request;
use think\Response;

use app\common\enum\YesnoEnum;
use app\common\util\ArrayUtil;
use app\common\dependency\Dependency;

use app\admin\enum\SystemOperLogEnum;
use app\admin\helper\SystemMenuHelper;
use app\admin\helper\SystemManagerHelper;
use app\admin\service\SystemOperLogService;

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
        $currentMenu = SystemMenuHelper::getCurrentMenu();

        if ($currentMenu && $currentMenu['record'] == YesnoEnum::YES) {

            $data = $response->getData();

            if (isset($data['code'])) {

                $params = $request->post();

                if (!empty($params['password'])) {
                    $params['password'] = '******';
                }

                $log['message']    = $data['msg'];
                $log['menuId']     = $currentMenu['menuId'];
                $log['params']     = ArrayUtil::toJson($params);
                $log['status']     = SystemOperLogEnum::translateCode($data['code']);
                $log['managerId']  = SystemManagerHelper::getManagerId();
                $log['requestIp']  = $request->ip();
                $log['requestUrl'] = $request->url();

                Dependency::getProxy(SystemOperLogService::class)->createLog($log);
            }
        }
    }
}