<?php


namespace app\common\service;


use app\common\repository\ManagerRoleRepository;

class ManagerRoleService extends Service
{
    /**
     * 存储类
     * @var ManagerRoleRepository
     */
    protected $ManagerRoleRepository;

    /**
     * 初始化
     */
    public function injectRepostitory(ManagerRoleRepository $ManagerRoleRepository)
    {
        $this->ManagerRoleRepository = $ManagerRoleRepository;
    }
}