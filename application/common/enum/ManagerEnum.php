<?php


namespace app\common\enum;


class ManagerEnum
{
    /**
     * 超级管理员ID
     */
    const SUPER_ID = 1;

    /**
     * 缓存标识
     */
    const LOGIN_ID = 'system.manager.id'; // 缓存ID

    /**
     * 缓存标识
     */
    const LOGIN_MANAGER = 'system.manager'; // 管理员

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