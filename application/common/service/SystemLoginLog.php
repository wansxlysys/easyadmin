<?php


namespace app\common\service;


class SystemLoginLog extends \app\common\service\Service
{
    /**
     * 登录状态
     */
    const STATUS_SUCCESS = 1; // 登录成功
    const STATUS_ERROR   = 2; // 登录失败
}