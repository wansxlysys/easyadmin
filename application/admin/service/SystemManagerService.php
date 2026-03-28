<?php


namespace app\admin\service;


use Exception;

use app\common\util\Md5Util;
use app\common\util\StringUtil;
use app\common\util\DateTimeUtil;
use app\common\service\Service;
use app\common\repository\Wrapper;
use app\common\constant\YesnoConstant;
use app\common\exception\ServiceException;

use app\admin\helper\SystemManagerHelper;
use app\admin\constant\SystemManagerConstant;
use app\admin\repository\SystemManagerRepository;

class SystemManagerService extends Service
{
    /**
     * 存储类
     * @var SystemManagerRepository
     */
    protected SystemManagerRepository $ManagerRepository;

    /**
     * 登录日志服务类
     * @var SystemLoginLogService
     */
    protected SystemLoginLogService $SystemLoginLogService;

    /**
     * 系统菜单服务类
     * @var SystemMenuService
     */
    protected SystemMenuService $SystemMenuService;

    /**
     * 获取列表
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function getPageManager(array $params = [])
    {
        $Wrapper = new Wrapper();

        if (!empty($params['status'])) {
            $Wrapper->addWhere('manager.status', '=', $params['status']);
        }

        if (!empty($params['roleId'])) {
            $Wrapper->addWhere('manager.roleId', '=', $params['roleId']);
        }

        if (!empty($params['realName'])) {
            $Wrapper->addWhere('manager.realName', 'LIKE', $params['realName'] . '%');
        }

        if (!empty($params['account'])) {
            $Wrapper->addWhere('manager.account', 'LIKE', $params['account'] . '%');
        }

        if (SystemManagerHelper::isNotSuper()) {
            $Wrapper->addWhere('manager.managerId', '<>', SystemManagerConstant::SUPER_ID);
        }

        $Wrapper->addWhere('manager.isDelete', '=', YesnoConstant::N);

        $field = [
            'manager.managerId', 'manager.avatar', 'manager.account', 'manager.realName', 'manager.status',
            'manager.loginTime', 'role.name roleName'
        ];

        $Wrapper->setField($field);
        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->addOrder('manager.managerId');

        return $this->ManagerRepository->getPageWithRole($Wrapper);
    }

    /**
     * 通过ID获取管理员
     * @param $managerId
     * @return array
     * @throws Exception
     */
    public function getByManagerId($managerId)
    {
        return $this->ManagerRepository->getById($managerId);
    }

    /**
     * 获取管理员
     * @return array
     * @throws Exception
     */
    public function getLoginManager()
    {
        $Wrapper = new Wrapper();

        $Wrapper->setField([
            'manager.managerId', 'manager.roleId', 'manager.avatar', 'manager.realName', 'manager.account',
            'manager.password', 'manager.status', 'manager.isDelete', 'role.identify roleIdentify',
            'role.permission rolePermission', 'role.level roleLevel'
        ]);

        $Wrapper->addWhere('manager.managerId', '=', SystemManagerHelper::getManagerId());

        $manager = $this->ManagerRepository->getWithRole($Wrapper);

        if (!empty($manager['rolePermission'])) {
            $manager['permissionMenuIds'] = StringUtil::toArray($manager['rolePermission']);
        }

        if (!empty($manager['rolePermission'])) {
            $manager['permissionMenuIdentify'] = $this->SystemMenuService->getPermissionCode($manager['rolePermission']);
        }

        return $manager;
    }

    /**
     * 通过角色ID获取管理员列表
     * @param $roleId
     * @return array
     * @throws Exception
     */
    public function getByRoleId($roleId)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('roleId', '=', $roleId);
        $Wrapper->addWhere('isDelete', '=', YesnoConstant::N);

        return $this->ManagerRepository->getOne($Wrapper);
    }

    /**
     * 通过账号查询
     * @param $account
     * @return array
     * @throws Exception
     */
    public function getByAccount($account)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('account', '=', $account);
        $Wrapper->addWhere('isDelete', '=', YesnoConstant::N);

        return $this->ManagerRepository->getOne($Wrapper);
    }

    /**
     * 添加菜单
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function createManager(array $params)
    {
        $params['password'] = Md5Util::encrypt($params['password']);

        return $this->ManagerRepository->createRecord($params);
    }

    /**
     * 通过ID更新数据
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function updateManager(array $params)
    {
        /**
         * 检测管理员是否存在
         */
        $manager = $this->getByManagerId($params['managerId']);

        if (empty($manager)) {
            throw new ServiceException('修改失败，管理员不存在');
        }

        /**
         * 如果密码不为空则加密密码
         */
        if (empty($params['password'])) {
            unset($params['password']);
        } else {
            $params['password'] = Md5Util::encrypt($params['password']);
        }

        return $this->ManagerRepository->updateById($params['managerId'], $params);
    }

    /**
     * 删除管理员
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function deleteManager(array $params)
    {
        if ($params['managerId'] == SystemManagerConstant::SUPER_ID) {
            throw new ServiceException('删除失败，超级管理员禁止删除');
        }

        return $this->ManagerRepository->removeById($params['managerId']);
    }

    /**
     * 管理员登录
     * @param array $params
     * @return bool
     * @throws Exception
     */
    public function login(array $params)
    {
        $manager = $this->getByAccount($params['account']);

        /**
         * 检测账号是否存在
         */
        if (!$manager) {
            throw new ServiceException('登录失败，管理员不存在');
        }

        try {

            /**
             * 检测管理员是否被禁用
             */
            if ($manager['status'] == SystemManagerConstant::STATUS_DISABLED) {
                throw new ServiceException('登录失败，管理员已被禁用');
            }

            /**
             * 检测管理员已被锁定
             */
            if ($manager['status'] == SystemManagerConstant::STATUS_LOCKED) {
                throw new ServiceException('登录失败，管理员已被锁定');
            }

            /**
             * 检测密码是否正确
             */
            if (!Md5Util::equals($params['password'], $manager['password'])) {

                /**
                 * 检测登录次数
                 */
                $loginError = $manager['loginError'] + 1;

                if ($loginError >= SystemManagerConstant::LOCK_LOGIN_ERROR_NUMBER) {

                    /**
                     * 更新管理员为锁定状态
                     */
                    $this->ManagerRepository->updateById($manager['managerId'], ['status' => SystemManagerConstant::STATUS_LOCKED, 'loginError' => 0]);

                } else {

                    /**
                     * 登录失败次数递增
                     */
                    $this->ManagerRepository->updateById($manager['managerId'], ['loginError' => $loginError]);
                }

                throw new ServiceException('登录失败，密码输入错误');
            }

        } catch (Exception $e) {

            /**
             * 登录失败日志
             */
            $this->SystemLoginLogService->loginError($manager['managerId'], $e->getMessage());

            throw new ServiceException($e->getMessage());
        }

        /**
         * 设置登录缓存
         */
        SystemManagerHelper::login($manager['managerId'], $manager['account'], $manager['password']);

        /**
         * 更新最后登录时间
         */
        $this->ManagerRepository->updateById($manager['managerId'], ['loginError' => 0, 'loginTime' => DateTimeUtil::dateTime()]);

        /**
         * 登录成功日志
         */
        $this->SystemLoginLogService->loginSuccess($manager['managerId'], '登录成功');

        return true;
    }
}