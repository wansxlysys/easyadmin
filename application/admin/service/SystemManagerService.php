<?php


namespace app\admin\service;


use Exception;

use app\common\util\DateTimeUtil;
use app\common\util\Md5Util;
use app\common\util\StringUtil;
use app\common\enum\DeleteEnum;
use app\common\repository\Wrapper;
use app\common\exception\ServiceException;

use app\admin\enum\ManagerEnum;
use app\admin\helper\SystemManagerHelper;
use app\admin\repository\SystemManagerRepository;
use app\admin\dependency\SystemLoginLogDependency;

class SystemManagerService
{
    /**
     * 存储类
     * @var SystemManagerRepository
     */
    protected $ManagerRepository;

    /**
     * 初始化
     */
    public function injectRepostitory(SystemManagerRepository $ManagerRepository)
    {
        $this->ManagerRepository = $ManagerRepository;
    }

    /**
     * 获取列表
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function listManager(array $params = [])
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

        if (SystemManagerHelper::isNotSuper()) {
            $Wrapper->addWhere('manager.managerId', '<>', ManagerEnum::SUPER_ID);
        }

        $Wrapper->addWhere('manager.isDelete', '=', DeleteEnum::DELETE_NOT);

        $field = [
            'manager.managerId', 'manager.avatar', 'manager.account', 'manager.realName', 'manager.status',
            'manager.loginTime', 'role.name roleName'
        ];

        $Wrapper->setField($field);
        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->addOrder('manager.managerId', 'asc');

        $page = $this->ManagerRepository->getPageWithRole($Wrapper);

        return ['list' => $page->items(), 'total' => $page->total()];
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
    public function getManager()
    {
        $Wrapper = new Wrapper();

        $Wrapper->setField([
            'manager.managerId', 'manager.roleId', 'manager.avatar', 'manager.realName', 'manager.account',
            'manager.password', 'manager.status', 'manager.isDelete', 'role.identify', 'role.permission',
        ]);

        $Wrapper->addWhere('manager.managerId', '=', SystemManagerHelper::getManagerId());

        $manager = $this->ManagerRepository->getWithRole($Wrapper);

        if (!empty($manager['permission'])) {
            $manager['permission'] = StringUtil::toArray($manager['permission']);
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
        $Wrapper->addWhere('isDelete', '=', DeleteEnum::DELETE_NOT);

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
        $Wrapper->addWhere('isDelete', '=', DeleteEnum::DELETE_NOT);

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
        if ($params['managerId'] == ManagerEnum::SUPER_ID) {
            throw new ServiceException('删除失败，超级管理员禁止删除');
        }

        return $this->ManagerRepository->updateById($params['managerId'], ['isDelete' => DeleteEnum::DELETE_NOT]);
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

        /**
         * 更新最后登录时间
         */
        if (!$this->ManagerRepository->updateById($manager['managerId'], ['loginTime' => DateTimeUtil::dateTime()])) {
            throw new ServiceException('执行失败，登录时间更新失败');
        }

        $SystemLoginLogService = SystemLoginLogDependency::getService();

        try {

            /**
             * 检测管理员是否被禁用
             */
            if ($manager['status'] == ManagerEnum::STATUS_DISABLED) {
                throw new ServiceException('登录失败，管理员已被禁用');
            }

            /**
             * 检测管理员已被锁定
             */
            if ($manager['status'] == ManagerEnum::STATUS_LOCKED) {
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

                if ($loginError >= ManagerEnum::LOCK_LOGIN_ERROR_NUMBER) {

                    /**
                     * 更新管理员为锁定状态
                     */
                    $this->ManagerRepository->updateById($manager['managerId'], ['status' => ManagerEnum::STATUS_LOCKED, 'loginError' => 0]);

                } else {

                    /**
                     * 登录失败次数递增
                     */
                    $this->ManagerRepository->updateById($manager['managerId'], ['loginError' => $loginError]);
                }

                throw new ServiceException('登录失败，密码输入错误');
            }

        } catch (Exception $exception) {

            /**
             * 登录失败日志
             */
            $SystemLoginLogService->loginError([
                'loginIp'     => $params['loginIp'],
                'managerId'   => $manager['managerId'],
                'description' => $exception->getMessage(),
            ]);

            throw new ServiceException($exception->getMessage());
        }

        /**
         * 设置登录缓存
         */
        SystemManagerHelper::login($manager['managerId'], $manager['account'], $manager['password']);

        /**
         * 登录成功日志
         */
        $SystemLoginLogService->loginSuccess([
            'loginIp'     => $params['loginIp'],
            'managerId'   => $manager['managerId'],
            'description' => '登录成功',
        ]);

        return true;
    }
}