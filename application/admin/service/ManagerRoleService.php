<?php


namespace app\admin\service;


use app\common\repository\Query;
use app\common\helper\ManagerHelper;
use app\common\enum\ManagerRoleEnum;
use app\common\exception\SystemException;

class ManagerRoleService extends \app\common\service\ManagerRoleService
{
    /**
     * 获取列表
     * @param array $params
     * @return array
     * @throws SystemException
     */
    public function listRole(array $params = [])
    {
        $Query = new Query();

        if (!empty($params['name'])) {
            $Query->addWhere('name', 'LIKE', $params['name'] . '%');
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
     * @throws SystemException
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
     * @throws SystemException
     */
    public function getById($id)
    {
        return $this->ManagerRoleRepository->getById($id);
    }

    /**
     * 删除
     * @param $params
     * @return bool
     * @throws SystemException
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
     * @throws SystemException
     */
    public function createRole(array $params)
    {
        return $this->ManagerRoleRepository->createRecord($params);
    }

    /**
     * 修改
     * @param array $params
     * @return mixed
     * @throws SystemException
     */
    public function updateRole(array $params)
    {
        return $this->ManagerRoleRepository->updateById($params['id'], $params);
    }
}