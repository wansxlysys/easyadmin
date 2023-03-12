<?php


namespace app\common\constant;


class Manager
{
    /**
     * 缓存标识
     */
    const SESSION_ID = 'admin_id'; // 缓存ID

    /**
     * 缓存容器标识
     */
    const CONTAINER_ROLE       = 'admin_role'; // 角色
    const CONTAINER_MANAGER    = 'admin_manager'; // 管理员
    const CONTAINER_PERMISSION = 'admin_permission'; // 权限

    /**
     * 管理员状态
     */
    const STATUS_ENABLED  = 1; // 启用
    const STATUS_DISABLED = 2; // 禁用
}