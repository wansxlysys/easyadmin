<?php


namespace app\admin\service;


use app\common\util\StringUtil;
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
     * 获取角色
     * @param $id
     * @return mixed
     */
    public function getRole($id)
    {
        $role = $this->ManagerRoleRepository->getById($id);

        return $this->formatData($role);
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
     * @param $params
     * @return bool
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
     * 创建角色
     * @param array $params
     * @return mixed
     */
    public function createRole(array $params)
    {
        $roleData['name']       = $params['name'];
        $roleData['remark']     = $params['remark'];
        $roleData['identify']   = $params['identify'];
        $roleData['permission'] = $params['permission'];

        return $this->ManagerRoleRepository->createRecord($roleData);
    }

    /**
     * 创建角色
     * @param array $params
     * @return mixed
     */
    public function updateRole(array $params)
    {
        $roleData['name']       = $params['name'];
        $roleData['remark']     = $params['remark'];
        $roleData['identify']   = $params['identify'];
        $roleData['permission'] = $params['permission'];

        return $this->ManagerRoleRepository->updateById($params['id'], $roleData);
    }

    /**
     * 格式化数据
     * @param $data
     * @return mixed
     */
    public function formatData($data)
    {
        $data['permission'] = StringUtil::toArray($data['permission']);

        return $data;
    }
}