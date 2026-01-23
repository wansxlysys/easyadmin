<?php


namespace app\admin\behavior;


use Exception;

use think\Request;
use think\Response;

use app\common\enum\YesnoEnum;
use app\common\util\ArrayUtil;
use app\common\helper\DebugHelper;
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
    public function appEnd(Request $request, Response $response)
    {
        $currentMenu = SystemMenuHelper::getMenu();

        if (!$currentMenu || $currentMenu['record'] == YesnoEnum::N) {
            return;
        }

        $data = $response->getData();

        /**
         * 判断返回数据是否有code字段
         */
        if (isset($data['code'])) {

            $log['message']    = $data['msg'];
            $log['menuId']     = $currentMenu['menuId'];
            $log['params']     = $this->filterParams($request->post());
            $log['status']     = SystemOperLogEnum::translateCode($data['code']);
            $log['costTime']   = DebugHelper::duration();
            $log['managerId']  = SystemManagerHelper::getManagerId();
            $log['requestIp']  = $request->ip();
            $log['requestUrl'] = $request->url();
            $log['userAgent']  = $request->header('User-Agent');

            Dependency::getProxy(SystemOperLogService::class)->createLog($log);
        }
    }

    /**
     * 过滤参数
     * @param array $params
     * @return string
     */
    protected function filterParams(array $params)
    {
        if (!empty($params['password'])) {
            $params['password'] = '******';
        }

        return ArrayUtil::toJson($params);
    }
}