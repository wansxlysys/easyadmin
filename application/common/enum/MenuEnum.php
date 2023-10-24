<?php


namespace app\common\enum;


class MenuEnum
{
    /**
     * 菜单类型
     */
    const TYPE_MENU   = 1; // 菜单
    const TYPE_BUTTON = 2; // 按钮
    const TYPE_LINK   = 3; // 外链

    /**
     * 缓存标识
     */
    const CONTAINER_MENU = 'system.menu';
}