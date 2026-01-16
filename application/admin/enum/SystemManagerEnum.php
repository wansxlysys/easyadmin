<?php


namespace app\admin\enum;


class SystemManagerEnum
{
    /**
     * 超级管理员ID
     */
    const SUPER_ID = 1;

    /**
     * 缓存标识
     */
    const SESSION_ID = 'system:manager:id'; // 缓存ID

    /**
     * session校验码标识
     */
    const SESSION_CODE = 'system:manager:verify'; // 校验码

    /**
     * 缓存标识
     */
    const LOGIN_MANAGER = 'system:manager'; // 管理员

    /**
     * 登录错误次数锁定
     */
    const LOCK_LOGIN_ERROR_NUMBER = 3;

    /**
     * 管理员状态
     */
    const STATUS_ENABLED  = 1; // 启用
    const STATUS_DISABLED = 2; // 禁用
    const STATUS_LOCKED   = 3; // 锁定
}