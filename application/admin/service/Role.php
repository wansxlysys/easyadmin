<?php


namespace app\admin\service;


use think\Db;

class Role extends \app\common\service\Role
{
    /**
     * 角色存储嘞
     * @var \app\admin\model\Role
     */
    protected $RoleModel;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->RoleModel = new \app\admin\model\Role();
    }

    /**
     * 获取列表和总数
     * @param array $params
     * @return array
     */
    public function getListWithTotal(array $params = [])
    {
        $Query = new \app\common\model\Query();

        if (!empty($params['title'])) {
            $Query->addWhere(['title', 'LIKE', "%{$params['title']}%"]);
        }

        $Query->setPage($params['page']);
        $Query->setLimit($params['limit']);

        $list  = $this->RoleModel->getList($Query);
        $total = $this->RoleModel->getTotal($Query);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 获取全部角色
     * @param array $params
     * @return mixed
     */
    public function getAll(array $params = [])
    {
        return $this->RoleModel->getAll(new \app\common\model\Query());
    }

    /**
     * 通过ID获取角色
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->RoleModel->getById($id);
    }

    /**
     * 通过角色ID删除
     * @param $id
     * @return bool
     */
    public function deleteByParamsId($id)
    {
        $ManagerService    = new \app\admin\service\Manager();
        $PermissionService = new \app\admin\service\Permission();

        if ($ManagerService->getByRoleId($id)) {
            return $this->setMessage('角色下存在管理员，禁止删除');
        }

        Db::startTrans();

        try {

            if (!$PermissionService->deleteByRoleId($id)) {
                throw new \Exception('权限删除失败');
            }

            if (!$this->RoleModel->deleteById($id)) {
                throw new \Exception('角色删除失败');
            }

            Db::commit();

        } catch (\Throwable $throwable) {

            Db::rollback();

            return $this->setMessage($throwable->getMessage());
        }

        return true;
    }

    /**
     * 创建角色
     * @param array $params
     * @return mixed
     */
    public function createRecord(array $params)
    {
        $permission        = $params['permission'];
        $PermissionService = new \app\admin\service\Permission();

        unset($params['permission']);

        Db::startTrans();

        try {

            $role = $this->RoleModel->createRecord($params);

            if (!$role) {
                throw new \Exception('角色创建失败');
            }

            $result = $PermissionService->createRecord($role['id'], $permission);

            if (!$result) {
                throw new \Exception('权限创建失败');
            }

            Db::commit();

        } catch (\Throwable $throwable) {

            Db::rollback();

            return $this->setMessage($throwable->getMessage());
        }

        return true;
    }

    /**
     * 创建角色
     * @param array $params
     * @return mixed
     */
    public function updateByParamsId(array $params)
    {
        $permission        = $params['permission'];
        $PermissionService = new \app\admin\service\Permission();

        unset($params['permission']);

        Db::startTrans();

        try {

            $result = $this->RoleModel->updateById($params['id'], $params);

            if (!$result) {
                throw new \Exception('角色修改失败');
            }

            $result = $PermissionService->updateRecord($params['id'], $permission);

            if (!$result) {
                throw new \Exception('权限修改失败');
            }

            Db::commit();

        } catch (\Throwable $throwable) {

            Db::rollback();

            return $this->setMessage($throwable->getMessage());
        }

        return true;
    }
}