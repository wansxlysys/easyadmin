<?php


namespace app\common\service;


class SystemLoginLogService extends Service
{
    /**
     * 登录状态
     */
    const STATUS_SUCCESS = 1; // 登录成功
    const STATUS_ERROR   = 2; // 登录失败
}