<?php


namespace app\admin\service;


use RuntimeException;
use app\common\repository\Query;
use app\admin\repository\PermissionRepository;

class PermissionService extends \app\common\service\PermissionService
{

    /**
     * 角色存储嘞
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

    /**
     * 通过角色ID获取权限
     * @param $roleId
     * @return mixed
     */
    public function getAllMenuIdByRoleId($roleId)
    {
        $Query = new Query();

        $Query->addWhere('role_id', '=', $roleId);

        return array_column($this->PermissionRepository->getAll($Query), 'menu_id');
    }

    /**
     * 创建权限
     * @param $roleId
     * @param array $menuId
     * @return mixed
     */
    public function createPermission($roleId, array $menuId)
    {
        if (empty($menuId)) {
            return true;
        }

        $params = [];

        foreach ($menuId as $key => $vo) {
            $params[$key]['menu_id'] = $vo;
            $params[$key]['role_id'] = $roleId;
        }

        return $this->PermissionRepository->createAll($params);
    }

    /**
     * 更新权限
     * @param $roleId
     * @param array $menuId
     * @return bool|mixed
     */
    public function updateRecord($roleId, array $menuId)
    {
        $permission = $this->getAllMenuIdByRoleId($roleId);

        $deleteMenuId = array_diff($permission, $menuId);
        $createMenuId = array_diff($menuId, $permission);

        /**
         * 删除权限
         */
        $Query = new Query();

        $Query->addWhere('role_id', '=', $roleId);
        $Query->addWhere('menu_id', 'IN', $deleteMenuId);

        if (!$this->PermissionRepository->deleteRecord($Query)) {
            throw new RuntimeException('权限删除失败');
        }

        /**
         * 创建权限
         */
        if (!$this->createPermission($roleId, $createMenuId)) {
            throw new RuntimeException('权限创建失败');
        }

        return true;
    }

    /**
     * 通过角色ID删除权限
     * @param $roleId
     * @return mixed
     */
    public function deleteByRoleId($roleId)
    {
        $Query = new Query();

        $Query->addWhere('role_id', '=', $roleId);

        return $this->PermissionRepository->deleteRecord($Query);
    }
}