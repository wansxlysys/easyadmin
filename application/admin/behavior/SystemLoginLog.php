<?php


namespace app\admin\behavior;


use think\facade\Request;

class SystemLoginLog
{
    /**
     * 登录成功
     * @param array $params
     * @return mixed
     */
    public static function success(array $params)
    {
        $SystemLoginLog = new \app\admin\service\SystemLoginLog();

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
    public static function error(array $params)
    {
        $SystemLoginLog = new \app\admin\service\SystemLoginLog();

        $loginLog['status']      = 2;
        $loginLog['login_ip']    = Request::ip();
        $loginLog['manager_id']  = $params['manager_id'];
        $loginLog['description'] = $params['description'];

        return $SystemLoginLog->createSystemLoginLog($loginLog);
    }
}