<?php


namespace app\admin\service;


use Throwable;
use RuntimeException;
use think\facade\Cache;
use app\common\enum\ManagerEnum;
use app\common\repository\Query;
use app\common\helper\ManagerHelper;
use app\common\helper\EncryptionHelper;
use app\admin\behavior\SystemLoginLogBehavior;

class ManagerService extends \app\common\service\ManagerService
{
    /**
     * 获取列表
     * @param array $params
     * @return array
     */
    public function listManager(array $params = [])
    {
        $Query = new Query();

        if (!empty($params['status'])) {
            $Query->addWhere('manager.status', '=', $params['status']);
        }

        if (!empty($params['role_id'])) {
            $Query->addWhere('manager.role_id', '=', $params['role_id']);
        }

        if (!empty($params['real_name'])) {
            $Query->addWhere('manager.real_name', 'LIKE', $params['real_name'] . '%');
        }

        if (ManagerHelper::isNotSuper()) {
            $Query->addWhere('manager.id', '<>', ManagerEnum::SUPER_ID);
        }

        $field = [
            'manager.id', 'manager.avatar', 'manager.account', 'manager.real_name', 'manager.status',
            'manager.login_time', 'role.name role_name'
        ];

        $Query->setField($field);
        $Query->setPage($params['page']);
        $Query->setLimit($params['limit']);
        $Query->addOrder('manager.id', 'asc');

        $list  = $this->ManagerRepository->getListWithRole($Query);
        $total = $this->ManagerRepository->getTotalWithRole($Query);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 通过ID获取管理员
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->ManagerRepository->getById($id);
    }

    /**
     * 通过角色ID获取管理员列表
     * @param $roleId
     * @return mixed
     */
    public function getByRoleId($roleId)
    {
        $Query = new Query();

        $Query->addWhere('role_id', '=', $roleId);

        return $this->ManagerRepository->getOne($Query);
    }

    /**
     * 添加菜单
     * @param array $params
     * @return mixed
     */
    public function createManager(array $params)
    {
        $params['password'] = EncryptionHelper::encrypt($params['password']);

        return $this->ManagerRepository->createRecord($params);
    }

    /**
     * 通过ID更新数据
     * @param array $params
     * @return bool
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
            $params['password'] = EncryptionHelper::encrypt($params['password']);
        }

        return $this->ManagerRepository->updateById($params['id'], $params);
    }

    /**
     * 删除管理员
     * @param array $params
     * @return mixed
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
     */
    public function login(array $params)
    {
        $manager = $this->ManagerRepository->getByAccount($params['account']);

        /**
         * 检测账号是否存在
         */
        if (!$manager) {
            return $this->setMessage('登录失败，管理员不存在');
        }

        /**
         * 更新最后登录时间
         */
        if (!$this->ManagerRepository->updateById($manager['id'], ['login_time' => date('Y-m-d H:i:s')])) {
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
                throw new RuntimeException('登录失败，管理员已被禁用');
            }

            /**
             * 检测管理员已被锁定
             */
            if ($manager['status'] == ManagerEnum::STATUS_LOCKED) {
                throw new RuntimeException('登录失败，管理员已被锁定');
            }

            try {

                /**
                 * 检测密码是否正确
                 */
                if (!EncryptionHelper::equals($params['password'], $manager['password'])) {
                    throw new RuntimeException('登录失败，密码输入错误');
                }

            } catch (Throwable $throwable) {

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

                throw new RuntimeException($throwable->getMessage());
            }

        } catch (Throwable $throwable) {

            /**
             * 登录失败日志
             */
            SystemLoginLogBehavior::loginError([
                'manager_id'  => $manager['id'],
                'description' => $throwable->getMessage()
            ]);

            return $this->setMessage($throwable->getMessage());
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
        SystemLoginLogBehavior::loginSuccess([
            'manager_id'  => $manager['id'],
            'description' => '登录成功'
        ]);

        return true;
    }
}