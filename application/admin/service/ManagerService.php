<?php


namespace app\admin\service;


use Throwable;

use think\facade\Cache;

use app\common\util\StringUtil;
use app\common\enum\ManagerEnum;
use app\common\repository\Wrapper;
use app\common\util\EncryptionUtil;
use app\common\helper\ManagerHelper;

use app\admin\event\SystemLoginLogEvent;
use app\common\exception\ServiceException;

class ManagerService extends \app\common\service\ManagerService
{
    /**
     * 获取列表
     * @param array $params
     * @return array
     * @throws Throwable
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

        if (ManagerHelper::isNotSuper()) {
            $Wrapper->addWhere('manager.id', '<>', ManagerEnum::SUPER_ID);
        }

        $field = [
            'manager.id', 'manager.avatar', 'manager.account', 'manager.realName', 'manager.status',
            'manager.loginTime', 'role.name role_name'
        ];

        $Wrapper->setField($field);
        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->addOrder('manager.id', 'asc');

        $list  = $this->ManagerRepository->getListWithRole($Wrapper);
        $total = $this->ManagerRepository->getTotalWithRole($Wrapper);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 通过ID获取管理员
     * @param $id
     * @return mixed
     * @throws Throwable
     */
    public function getById($id)
    {
        return $this->ManagerRepository->getById($id);
    }

    /**
     * 获取管理员
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function getManager($id)
    {
        $Wrapper = new Wrapper();

        $field = [
            'manager.id', 'manager.roleId', 'manager.avatar', 'manager.realName', 'manager.account', 'manager.account',
            'manager.isSystem', 'manager.status', 'role.identify', 'permission',
        ];

        $Wrapper->setField($field);
        $Wrapper->addWhere('manager.id', '=', $id);

        $manager = $this->ManagerRepository->getWithRole($Wrapper);

        if (!$manager) {
            throw new ServiceException('管理员不存在');
        }

        /**
         * 格式化权限为数组
         */
        $manager['permission'] = StringUtil::toArray($manager['permission']);

        return $manager;
    }

    /**
     * 通过角色ID获取管理员列表
     * @param $roleId
     * @return mixed
     * @throws Throwable
     */
    public function getByRoleId($roleId)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('roleId', '=', $roleId);

        return $this->ManagerRepository->getOne($Wrapper);
    }

    /**
     * 通过账号查询
     * @param $account
     * @return mixed
     * @throws Throwable
     */
    public function getByAccount($account)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('account', '=', $account);

        return $this->ManagerRepository->getOne($Wrapper);
    }

    /**
     * 添加菜单
     * @param array $params
     * @return mixed
     * @throws Throwable
     */
    public function createManager(array $params)
    {
        $params['password'] = EncryptionUtil::encrypt($params['password']);

        return $this->ManagerRepository->createRecord($params);
    }

    /**
     * 通过ID更新数据
     * @param array $params
     * @return bool
     * @throws Throwable
     */
    public function updateManager(array $params)
    {
        /**
         * 检测管理员是否存在
         */
        $manager = $this->getById($params['id']);

        if (empty($manager)) {
            return $this->setMessage('修改失败，管理员不存在');
        }

        /**
         * 如果密码不为空则加密密码
         */
        if (empty($params['password'])) {
            unset($params['password']);
        } else {
            $params['password'] = EncryptionUtil::encrypt($params['password']);
        }

        return $this->ManagerRepository->updateById($params['id'], $params);
    }

    /**
     * 删除管理员
     * @param array $params
     * @return mixed
     * @throws Throwable
     */
    public function deleteManager(array $params)
    {
        if ($params['id'] == ManagerEnum::SUPER_ID) {
            return $this->setMessage('删除失败，超级管理员禁止删除');
        }

        return $this->ManagerRepository->deleteById($params['id']);
    }

    /**
     * 管理员登录
     * @param array $params
     * @return bool
     * @throws Throwable
     */
    public function login(array $params)
    {
        $manager = $this->getByAccount($params['account']);

        /**
         * 检测账号是否存在
         */
        if (!$manager) {
            return $this->setMessage('登录失败，管理员不存在');
        }

        /**
         * 更新最后登录时间
         */
        if (!$this->ManagerRepository->updateById($manager['id'], ['loginTime' => date('Y-m-d H:i:s')])) {
            return $this->setMessage('执行失败，登录时间更新失败');
        }

        /**
         * 组合缓存key
         */
        $cacheKey = ManagerEnum::CACHE_LOGIN_ERROR_NUMBER . $manager['id'];

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

            try {

                /**
                 * 检测密码是否正确
                 */
                if (!EncryptionUtil::equals($params['password'], $manager['password'])) {
                    throw new ServiceException('登录失败，密码输入错误');
                }

            } catch (Throwable $Throwable) {

                /**
                 * 记录登录次数和锁定状态
                 */
                $errorNumber = Cache::get($cacheKey, 1);

                if ($errorNumber >= ManagerEnum::LOCK_LOGIN_ERROR_NUMBER) {

                    /**
                     * 更新管理员为锁定状态
                     */
                    $this->ManagerRepository->updateById($manager['id'], ['status' => ManagerEnum::STATUS_LOCKED]);

                    /**
                     * 清除登录锁定缓存
                     */
                    Cache::rm($cacheKey);

                } else {

                    /**
                     * 递增失败次数
                     */
                    Cache::set($cacheKey, $errorNumber + 1);
                }

                throw new ServiceException($Throwable->getMessage());
            }

        } catch (Throwable $Throwable) {

            /**
             * 登录失败日志
             */
            SystemLoginLogEvent::loginError([
                'managerId'  => $manager['id'],
                'description' => $Throwable->getMessage()
            ]);

            return $this->setMessage($Throwable->getMessage());
        }

        /**
         * 清除登录锁定缓存
         */
        Cache::rm($cacheKey);

        /**
         * 设置登录缓存
         */
        ManagerHelper::login($manager['id']);

        /**
         * 登录成功日志
         */
        SystemLoginLogEvent::loginSuccess([
            'managerId'  => $manager['id'],
            'description' => '登录成功'
        ]);

        return true;
    }
}