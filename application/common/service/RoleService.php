<?php


namespace app\common\service;


use app\common\repository\RoleRepository;

class RoleService extends Service
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
     * @var RoleRepository
     */
    protected $RoleRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->RoleRepository = new RoleRepository();
    }
}