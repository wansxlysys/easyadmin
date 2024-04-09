<?php


namespace app\admin\event;


use Throwable;

use think\facade\Request;

use app\admin\service\SystemLoginLogService;

use app\common\enum\SystemLoginLogEnum;

class SystemLoginLogEvent
{
    /**
     * 登录成功
     * @param array $params
     * @return mixed
     * @throws Throwable
     */
    public static function loginSuccess(array $params)
    {
        $SystemLoginLog = new SystemLoginLogService();

        $loginLog['status']      = SystemLoginLogEnum::STATUS_SUCCESS;
        $loginLog['loginIp']    = Request::ip();
        $loginLog['managerId']  = $params['managerId'];
        $loginLog['description'] = $params['description'];

        return $SystemLoginLog->createLog($loginLog);
    }

    /**
     * 登录失败
     * @param array $params
     * @return mixed
     * @throws Throwable
     */
    public static function loginError(array $params)
    {
        $SystemLoginLog = new SystemLoginLogService();

        $loginLog['status']      = SystemLoginLogEnum::STATUS_ERROR;
        $loginLog['loginIp']    = Request::ip();
        $loginLog['managerId']  = $params['managerId'];
        $loginLog['description'] = $params['description'];

        return $SystemLoginLog->createLog($loginLog);
    }
}