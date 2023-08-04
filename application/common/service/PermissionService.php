<?php


namespace app\common\service;


use app\common\repository\PermissionRepository;

class PermissionService extends Service
{
    /**
     * 角色存储类
     * @var PermissionRepository
     */
    protected $PermissionRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->PermissionRepository = new PermissionRepository();
    }
}