<?php


namespace app\admin\behavior;


use think\facade\Request;
use app\admin\service\SystemLoginLogService;

class SystemLoginLogBehavior
{
    /**
     * 登录成功
     * @param array $params
     * @return mixed
     */
    public static function loginSuccess(array $params)
    {
        $SystemLoginLog = new SystemLoginLogService();

        $loginLog['status']      = 1;
        $loginLog['login_ip']    = Request::ip();
        $loginLog['manager_id']  = $params['manager_id'];
        $loginLog['description'] = $params['description'];

        return $SystemLoginLog->createSystemLoginLog($loginLog);
    }

    /**
     * 登录失败
     * @param array $params
     * @return mixed
     */
    public static function loginError(array $params)
    {
        $SystemLoginLog = new SystemLoginLogService();

        $loginLog['status']      = 2;
        $loginLog['login_ip']    = Request::ip();
        $loginLog['manager_id']  = $params['manager_id'];
        $loginLog['description'] = $params['description'];

        return $SystemLoginLog->createSystemLoginLog($loginLog);
    }
}