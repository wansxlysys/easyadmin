<?php


namespace app\admin\constant;


class SystemManagerConstant
{
    /**
     * 超级管理员ID
     */
    const SUPER_ID = 1;

    /**
     * 登录管理员ID
     */
    const LOGIN_MANAGER_ID = 'system:login:managerId'; // 缓存ID

    /**
     * 登录管理员校验码
     */
    const LOGIN_VERIFY_CODE = 'system:login:verifyCode'; // 校验码

    /**
     * 登录管理员信息
     */
    const LOGIN_MANAGER = 'system:login:manager'; // 管理员

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