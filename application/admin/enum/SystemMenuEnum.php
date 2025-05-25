<?php


namespace app\admin\enum;


class SystemMenuEnum
{
    /**
     * 菜单类型
     */
    const TYPE_MENU   = 1; // 菜单
    const TYPE_BUTTON = 2; // 按钮
    const TYPE_LINK   = 3; // 外链

    /**
     * 日志记录
     */
    const RECORD_YES = 1; // 启用
    const RECORD_NOT = 1; // 禁用

    /**
     * 缓存标识
     */
    const CURRENT_MENU = 'system:menu:current'; // 当前菜单
}