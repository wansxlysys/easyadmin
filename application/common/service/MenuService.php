<?php


namespace app\common\service;


use app\common\repository\MenuRepository;

class MenuService extends Service
{
    /**
     * 存储类
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