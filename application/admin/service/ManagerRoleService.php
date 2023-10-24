<?php


namespace app\admin\service;


use think\Db;
use Throwable;
use RuntimeException;
use app\common\repository\Query;
use app\common\enum\ManagerRoleEnum;
use app\common\helper\ManagerHelper;

class ManagerRoleService extends \app\common\service\ManagerRoleService
{
    /**
     * 获取列表和总数
     * @param array $params
     * @return array
     */
    public function getListWithTotal(array $params = [])
    {
        $Query = new Query();

        if (!empty($params['title'])) {
            $Query->addWhere('title', 'LIKE', "%{$params['title']}%");
        }

        $Query->setPage($params['page']);
        $Query->setLimit($params['limit']);
        $Query->addOrder('sort', 'asc');

        $list  = $this->ManagerRoleRepository->getList($Query);
        $total = $this->ManagerRoleRepository->getTotal($Query);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 获取全部角色
     * @param array $params
     * @return mixed
     */
    public function getAll(array $params = [])
    {
        $Query = new Query();

        if (ManagerHelper::isNotSuper()) {
            $Query->addWhere('identify', '<>', ManagerRoleEnum::SUPER_NAME);
        }

        $Query->addOrder('sort', 'asc');

        return $this->ManagerRoleRepository->getAll($Query);
    }

    /**
     * 通过ID获取角色
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->ManagerRoleRepository->getById($id);
    }

    /**
     * 通过角色ID删除
     * @param $id
     * @return bool
     */
    public function deleteRole($id)
    {
        $ManagerService    = new ManagerService();
        $PermissionService = new PermissionService();

        if ($ManagerService->getByRoleId($id)) {
            return $this->setMessage('禁止删除，角色下存在管理员');
        }

        $role = $this->ManagerRoleRepository->getById($id);

        if ($role['identify'] == ManagerRoleEnum::SUPER_NAME) {
            return $this->setMessage('禁止删除，超级管理员角色');
        }

        Db::startTrans();

        try {

            if (!$PermissionService->deleteByRoleId($id)) {
                throw new RuntimeException('执行错误，权限删除失败');
            }

            if (!$this->ManagerRoleRepository->deleteById($id)) {
                throw new RuntimeException('执行错误，角色删除失败');
            }

            Db::commit();

        } catch (Throwable $throwable) {

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
    public function createRole(array $params)
    {
        Db::startTrans();

        try {

            /**
             * 创建角色
             */
            $roleData['name']     = $params['name'];
            $roleData['remark']   = $params['remark'];
            $roleData['identify'] = $params['identify'];

            $roleId = $this->ManagerRoleRepository->createRecord($roleData);

            if (!$roleId) {
                throw new RuntimeException('角色创建失败');
            }

            /**
             * 创建权限
             */
            $PermissionService = new PermissionService();

            $result = $PermissionService->createPermission($roleId, $params['permission']);

            if (!$result) {
                throw new RuntimeException('权限创建失败');
            }

            Db::commit();

        } catch (Throwable $throwable) {

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
    public function updateRole(array $params)
    {
        Db::startTrans();

        try {

            /**
             * 更新角色
             */
            $roleData['name']     = $params['name'];
            $roleData['remark']   = $params['remark'];
            $roleData['identify'] = $params['identify'];

            $result = $this->ManagerRoleRepository->updateById($params['id'], $roleData);

            if (!$result) {
                throw new RuntimeException('角色修改失败');
            }

            /**
             * 更新权限
             */
            $PermissionService = new PermissionService();

            $result = $PermissionService->updateRecord($params['id'], $params['permission']);

            if (!$result) {
                throw new RuntimeException('权限修改失败');
            }

            Db::commit();

        } catch (Throwable $throwable) {

            Db::rollback();

            return $this->setMessage($throwable->getMessage());
        }

        return true;
    }
}