<?php


namespace app\admin\service;


use Throwable;

use app\common\enum\ManagerRoleEnum;
use app\common\helper\ManagerHelper;
use app\common\repository\Wrapper;

class ManagerRoleService extends \app\common\service\ManagerRoleService
{
    /**
     * 获取列表
     * @param array $params
     * @return array
     * @throws Throwable
     */
    public function listRole(array $params = [])
    {
        $Wrapper = new Wrapper();

        if (!empty($params['name'])) {
            $Wrapper->addWhere('name', 'LIKE', $params['name'] . '%');
        }

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->addOrder('sort', 'asc');

        $list  = $this->ManagerRoleRepository->getList($Wrapper);
        $total = $this->ManagerRoleRepository->getTotal($Wrapper);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 获取全部角色
     * @param array $params
     * @return mixed
     * @throws Throwable
     */
    public function getAll(array $params = [])
    {
        $Wrapper = new Wrapper();

        if (ManagerHelper::isNotSuper()) {
            $Wrapper->addWhere('identify', '<>', ManagerRoleEnum::SUPER_NAME);
        }

        $Wrapper->addOrder('sort', 'asc');

        return $this->ManagerRoleRepository->getAll($Wrapper);
    }

    /**
     * 通过ID获取角色
     * @param $id
     * @return mixed
     * @throws Throwable
     */
    public function getById($id)
    {
        return $this->ManagerRoleRepository->getById($id);
    }

    /**
     * 删除
     * @param $params
     * @return bool
     * @throws Throwable
     */
    public function deleteRole($params)
    {
        $ManagerService = new ManagerService();

        if ($ManagerService->getByRoleId($params['id'])) {
            return $this->setMessage('禁止删除，角色下存在管理员');
        }

        /**
         * 超级管理员角色禁止删除
         */
        $role = $this->ManagerRoleRepository->getById($params['id']);

        if ($role['identify'] == ManagerRoleEnum::SUPER_NAME) {
            return $this->setMessage('禁止删除，超级管理员角色');
        }

        return $this->ManagerRoleRepository->deleteById($params['id']);
    }

    /**
     * 创建
     * @param array $params
     * @return mixed
     */
    public function createRole(array $params)
    {
        return $this->ManagerRoleRepository->createRecord($params);
    }

    /**
     * 修改
     * @param array $params
     * @return mixed
     * @throws Throwable
     */
    public function updateRole(array $params)
    {
        return $this->ManagerRoleRepository->updateById($params['id'], $params);
    }
}