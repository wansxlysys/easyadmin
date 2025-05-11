<?php


namespace app\admin\service;


use app\admin\dependency\SystemManagerDependency;
use app\admin\enum\ManagerRoleEnum;
use app\admin\helper\SystemManagerHelper;
use app\admin\repository\SystemManagerRoleRepository;
use app\common\enum\DeleteEnum;
use app\common\exception\ServiceException;
use app\common\repository\Wrapper;
use Exception;

class SystemManagerRoleService
{
    /**
     * 存储类
     * @var SystemManagerRoleRepository
     */
    protected $ManagerRoleRepository;

    /**
     * 初始化
     */
    public function injectRepostitory(SystemManagerRoleRepository $ManagerRoleRepository)
    {
        $this->ManagerRoleRepository = $ManagerRoleRepository;
    }

    /**
     * 获取列表
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function listRole(array $params = [])
    {
        $Wrapper = new Wrapper();

        if (!empty($params['name'])) {
            $Wrapper->addWhere('name', 'LIKE', $params['name'] . '%');
        }

        $Wrapper->addWhere('isDelete', '=', DeleteEnum::DELETE_NOT);

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
     * @return array
     * @throws Exception
     */
    public function getAll(array $params = [])
    {
        $Wrapper = new Wrapper();

        if (SystemManagerHelper::isNotSuper()) {
            $Wrapper->addWhere('identify', '<>', ManagerRoleEnum::SUPER_NAME);
        }

        $Wrapper->addWhere('isDelete', '=', DeleteEnum::DELETE_NOT);
        $Wrapper->addOrder('sort', 'asc');

        return $this->ManagerRoleRepository->getAll($Wrapper);
    }

    /**
     * 通过ID获取角色
     * @param $id
     * @return array
     * @throws Exception
     */
    public function getById($id)
    {
        return $this->ManagerRoleRepository->getById($id);
    }

    /**
     * 删除
     * @param $params
     * @return int
     * @throws Exception
     */
    public function deleteRole($params)
    {
        $ManagerService = SystemManagerDependency::getService();

        if ($ManagerService->getByRoleId($params['roleId'])) {
            throw new ServiceException('删除失败，角色下存在管理员');
        }

        /**
         * 超级管理员角色禁止删除
         */
        $role = $this->ManagerRoleRepository->getById($params['roleId']);

        if ($role['identify'] == ManagerRoleEnum::SUPER_NAME) {
            throw new ServiceException('删除失败，禁止删除超管角色');
        }

        return $this->ManagerRoleRepository->updateById($params['roleId'], ['isDelete' => DeleteEnum::DELETE_YES]);
    }

    /**
     * 创建
     * @param array $params
     * @return int
     */
    public function createRole(array $params)
    {
        return $this->ManagerRoleRepository->createRecord($params);
    }

    /**
     * 修改
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function updateRole(array $params)
    {
        return $this->ManagerRoleRepository->updateById($params['roleId'], $params);
    }
}