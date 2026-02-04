<?php


namespace app\admin\service;


use Exception;

use app\common\service\Service;
use app\common\repository\Wrapper;
use app\common\constant\YesnoConstant;
use app\common\exception\ServiceException;

use app\admin\enum\SystemManagerRoleEnum;
use app\admin\helper\SystemManagerHelper;
use app\admin\repository\SystemManagerRoleRepository;

class SystemManagerRoleService extends Service
{
    /**
     * 存储类
     * @var SystemManagerRoleRepository
     */
    protected SystemManagerRoleRepository $SystemManagerRoleRepository;

    /**
     * 管理员服务类
     * @var SystemManagerService
     */
    protected SystemManagerService $SystemManagerService;

    /**
     * 获取列表
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function getPageRole(array $params = [])
    {
        $Wrapper = new Wrapper();

        if (!empty($params['name'])) {
            $Wrapper->addWhere('name', 'LIKE', "{$params['name']}");
        }

        if (!empty($params['identify'])) {
            $Wrapper->addWhere('identify', 'LIKE', "{$params['identify']}");
        }

        $Wrapper->addWhere('isDelete', '=', YesnoConstant::N);

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->addOrder('level');

        $page = $this->SystemManagerRoleRepository->getPage($Wrapper);

        return ['list' => $page->items(), 'total' => $page->total()];
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
            $Wrapper->addWhere('level', '>=', SystemManagerHelper::getRoleLevel());
        }

        $Wrapper->addWhere('isDelete', '=', YesnoConstant::N);
        $Wrapper->addOrder('level');

        return $this->SystemManagerRoleRepository->getAll($Wrapper);
    }

    /**
     * 通过ID获取角色
     * @param $roleId
     * @return array
     * @throws Exception
     */
    public function getRoleById($roleId)
    {
        return $this->SystemManagerRoleRepository->getById($roleId);
    }

    /**
     * 删除
     * @param $params
     * @return int
     * @throws Exception
     */
    public function deleteRole($params)
    {
        if ($this->SystemManagerService->getByRoleId($params['roleId'])) {
            throw new ServiceException('删除失败，角色下存在管理员');
        }

        /**
         * 超级管理员角色禁止删除
         */
        $role = $this->SystemManagerRoleRepository->getById($params['roleId']);

        if ($role['identify'] == SystemManagerRoleEnum::SUPER_NAME) {
            throw new ServiceException('删除失败，禁止删除超管角色');
        }

        return $this->SystemManagerRoleRepository->removeById($params['roleId']);
    }

    /**
     * 创建
     * @param array $params
     * @return int
     */
    public function createRole(array $params)
    {
        return $this->SystemManagerRoleRepository->createRecord($params);
    }

    /**
     * 修改
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function updateRole(array $params)
    {
        return $this->SystemManagerRoleRepository->updateById($params['roleId'], $params);
    }
}