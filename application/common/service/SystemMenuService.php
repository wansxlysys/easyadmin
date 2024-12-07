<?php


namespace app\common\service;


use app\common\repository\SystemMenuRepository;

class SystemMenuService extends Service
{
    /**
     * 存储类
     * @var SystemMenuRepository
     */
    protected $SystemMenuRepository;

    /**
     * 初始化
     */
    public function injectDependency(SystemMenuRepository $SystemMenuRepository)
    {
        $this->SystemMenuRepository = $SystemMenuRepository;
    }
}