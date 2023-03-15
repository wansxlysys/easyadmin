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
            $Query->addWhere(['title', 'LIKE', "%{$params['title']}%"]);
        }

        $Query->setPage($params['page']);
        $Query->setLimit($params['limit']);

        $list  = $this->RoleRepository->getList($Query);
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
        return $this->RoleRepository->getAll(new \app\common\repository\Query());
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
            return $this->setMessage('角色下存在管理员，禁止删除');
        }

        Db::startTrans();

        try {

            if (!$PermissionService->deleteByRoleId($id)) {
                throw new \Exception('权限删除失败');
            }

            if (!$this->RoleRepository->deleteById($id)) {
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
        /**
         * 检测角标识是否重复
         */
        if ($this->checkExistByName($params['name'])) {
            return $this->setMessage('角色标识已存在');
        }

        Db::startTrans();

        try {

            /**
             * 创建角色
             */
            $roleData['name']   = $params['name'];
            $roleData['title']  = $params['title'];
            $roleData['remark'] = $params['remark'];

            $role = $this->RoleRepository->createRecord($params);

            if (!$role) {
                throw new \Exception('角色创建失败');
            }

            /**
             * 创建权限
             */
            $PermissionService = new \app\admin\service\Permission();

            $result = $PermissionService->createRecord($role['id'], $params['permission']);

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
        /**
         * 检测角标识是否重复
         */
        if ($this->checkExistByName($params['name'], $params['id'])) {
            return $this->setMessage('角色标识已存在');
        }

        Db::startTrans();

        try {

            /**
             * 更新角色
             */
            $roleData['name']   = $params['name'];
            $roleData['title']  = $params['title'];
            $roleData['remark'] = $params['remark'];

            $result = $this->RoleRepository->updateById($params['id'], $roleData);

            if (!$result) {
                throw new \Exception('角色修改失败');
            }

            /**
             * 更新权限
             */
            $PermissionService = new \app\admin\service\Permission();

            $result = $PermissionService->updateRecord($params['id'], $params['permission']);

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

    /**
     * 通过标识检测是否存在
     * @param string $name 角色标识
     * @param string $id 排除ID
     * @return mixed
     */
    protected function checkExistByName($name, $id = '')
    {
        $Query = new \app\common\repository\Query();

        if (!empty($id)) {
            $Query->addWhere(['id', '<>', $id]);
        }

        $Query->addWhere(['name', '=', $name]);

        return $this->RoleRepository->getOne($Query);
    }
}