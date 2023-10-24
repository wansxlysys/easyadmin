<?php


namespace app\common\service;


use app\common\repository\ManagerRoleRepository;

class ManagerRoleService extends Service
{
    /**
     * 超管角色名
     */
    const SUPER_NAME = 'super';

    /**
     * 是否系统内置
     */
    const IS_SYSTEM_YES = 1; // 是
    const IS_SYSTEM_NOT = 2; // 否

    /**
     * 存储类
     * @var ManagerRoleRepository
     */
    protected $ManagerRoleRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->ManagerRoleRepository = new ManagerRoleRepository();
    }
}