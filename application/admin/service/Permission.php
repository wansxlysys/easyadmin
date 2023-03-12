<?php


namespace app\admin\service;


use think\Db;

class Permission extends \app\common\service\Permission
{

    /**
     * 角色存储嘞
     * @var \app\admin\model\Permission
     */
    protected $PermissionModel;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->PermissionModel = new \app\admin\model\Permission();
    }

    /**
     * 通过角色ID获取权限
     * @param $roleId
     * @return mixed
     */
    public function getAllMenuIdByRoleId($roleId)
    {
        $Query = new \app\common\model\Query();

        $Query->addWhere(['role_id', '=', $roleId]);

        return array_column($this->PermissionModel->getAll($Query), 'menu_id');
    }

    /**
     * 创建权限
     * @param $roleId
     * @param array $menuId
     * @return mixed
     */
    public function createRecord($roleId, array $menuId)
    {
        if (empty($menuId)) {
            return true;
        }

        $params = [];

        foreach ($menuId as $key => $vo) {
            $params[$key]['menu_id'] = $vo;
            $params[$key]['role_id'] = $roleId;
        }

        return $this->PermissionModel->createAll($params);
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

        Db::startTrans();

        try {

            /**
             * 删除权限
             */
            $Query = new \app\common\model\Query();

            $Query->addWhere(['role_id', '=', $roleId]);
            $Query->addWhere(['menu_id', 'IN', $deleteMenuId]);

            if (!$this->PermissionModel->deleteRecord($Query)) {
                throw new \RuntimeException('权限删除失败');
            }

            /**
             * 创建权限
             */
            if (!$this->createRecord($roleId, $createMenuId)) {
                throw new \RuntimeException('权限创建失败');
            }

            Db::commit();

        } catch (\Throwable $throwable) {

            Db::rollback();

            return $this->setMessage($throwable->getMessage());
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
        $Query = new \app\common\model\Query();

        $Query->addWhere(['role_id', '=', $roleId]);

        return $this->PermissionModel->deleteById($Query);
    }
}