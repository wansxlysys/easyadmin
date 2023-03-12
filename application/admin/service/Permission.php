<?php


namespace app\admin\service;


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

        return $this->PermissionModel->insertAll($params);
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

        // 获取差集和补集
        $delete = array_diff($permission, $menuId);
        $create = array_diff($menuId, $permission);

        $where[] = ['role_id', '=', $roleId];
        $where[] = ['menu_id', 'IN', $delete];

        if (!$this->deleteByWhere($where)) {
            return false;
        }

        return $this->createRecord($roleId, $create);
    }

    /**
     * 通过条件删除
     * @param array $where
     * @return mixed
     */
    public function deleteByWhere(array $where = [])
    {
        $Query = new \app\common\repository\Query();

        $Query->where = $where;

        return $this->PermissionModel->deleteRecord($Query);
    }

    /**
     * 通过角色ID删除权限
     * @param $roleId
     * @return mixed
     */
    public function deleteByRoleId($roleId)
    {
        $where[] = ['role_id', '=', $roleId];

        return $this->deleteByWhere($where);
    }

}