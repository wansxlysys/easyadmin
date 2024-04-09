<?php


namespace app\admin\event;


use think\facade\Request;
use app\common\enum\SystemLoginLogEnum;
use app\common\exception\SystemException;
use app\admin\service\SystemLoginLogService;

class SystemLoginLogEvent
{
    /**
     * 登录成功
     * @param array $params
     * @return mixed
     * @throws SystemException
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
     * @throws SystemException
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