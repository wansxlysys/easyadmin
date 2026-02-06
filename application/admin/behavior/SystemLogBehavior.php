<?php


namespace app\admin\behavior;


use Exception;

use think\Request;
use think\Response;

use app\common\util\ArrayUtil;
use app\common\util\RequestUtil;
use app\common\dependency\Dependency;
use app\common\constant\YesnoConstant;

use app\admin\helper\SystemMenuHelper;
use app\admin\helper\SystemManagerHelper;
use app\admin\service\SystemOperLogService;
use app\admin\constant\SystemOperLogConstant;

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

        if (!$currentMenu || $currentMenu['record'] == YesnoConstant::N) {
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
            $log['status']     = SystemOperLogConstant::translateCode($data['code']);
            $log['costTime']   = RequestUtil::costTime();
            $log['managerId']  = SystemManagerHelper::getManagerId();
            $log['requestIp']  = $request->ip();
            $log['requestUrl'] = $request->url();
            $log['userAgent']  = $request->header('User-Agent');

            Dependency::getClass(SystemOperLogService::class)->createLog($log);
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