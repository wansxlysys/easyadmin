<?php


namespace app\admin\service;


use think\Db;

class Role extends \app\common\service\Role
{
    /**
     * 角色存储嘞
     * @var \app\admin\repository\Role
     */
    protected $RoleRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->RoleRepository = new \app\admin\repository\Role();
    }

    /**
     * 获取列表和总数
     * @param array $params
     * @return array
     */
    public function getListWithTotal(array $params = [])
    {
        $Query = new \app\common\repository\Query();

        if (!empty($params['title'])) {
            $Query->where[] = ['title', 'LIKE', "%{$params['title']}%"];
        }

        $Query->page  = !empty($params['page']) ? $params['page'] : 1;
        $Query->limit = !empty($params['limit']) ? $params['limit'] : 10;

        $list = $this->RoleRepository->getList($Query);
        $total = $this->RoleRepository->getTotal($Query);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 获取全部角色
     * @param array $params
     * @return mixed
     */
    public function getAll(array $params = [])
    {
        $Query = new \app\common\repository\Query();

        return $this->RoleRepository->getAll($Query);
    }

    /**
     * 通过ID获取角色
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->RoleRepository->getById($id);
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
            $this->setMessage('角色下存在管理员，禁止删除');
            return false;
        }

        Db::startTrans();

        try {

            if (!$PermissionService->deleteByRoleId($id)) {
                throw new \Exception('权限删除失败');
            }

            $Query = new \app\common\repository\Query();

            $Query->where[] = ['id', '=', $id];

            if (!$this->RoleRepository->deleteRecord($Query)) {
                throw new \Exception('角色删除失败');
            }

            Db::commit();

        } catch (\Exception $Exception) {

            Db::rollback();

            $this->setMessage($Exception->getMessage());

            return false;
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

            $role = $this->RoleRepository->createRecord($params);

            if (!$role) {
                throw new \Exception('角色创建失败');
            }

            $result = $PermissionService->createRecord($role['id'], $permission);

            if (!$result) {
                throw new \Exception('权限创建失败');
            }

            Db::commit();

        } catch (\Exception $Exception) {

            Db::rollback();

            $this->setMessage($Exception->getMessage());

            return false;
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

            $Query = new \app\common\repository\Query();

            $Query->where[] = ['id', '=', $params['id']];

            $result = $this->RoleRepository->updateRecord($Query, $params);

            if (!$result) {
                throw new \Exception('角色修改失败');
            }

            $result = $PermissionService->updateRecord($params['id'], $permission);

            if (!$result) {
                throw new \Exception('权限修改失败');
            }

            Db::commit();

        } catch (\Exception $Exception) {

            Db::rollback();

            $this->setMessage($Exception->getMessage());

            return false;
        }

        return true;
    }
}