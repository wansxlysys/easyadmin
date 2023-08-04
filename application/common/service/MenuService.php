<?php


namespace app\common\service;


use app\common\repository\MenuRepository;

class MenuService extends Service
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

    /**
     * 菜单存储类
     * @var MenuRepository
     */
    protected $MenuRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->MenuRepository = new MenuRepository();
    }
}