<?php


namespace app\admin\service;


use think\facade\Cache;
use app\common\helper\Encryption;

class Manager extends \app\common\service\Manager
{

    /**
     * 角色存储嘞
     * @var \app\admin\repository\Manager
     */
    protected $ManagerRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->ManagerRepository = new \app\admin\repository\Manager();
    }

    /**
     * 获取列表和总数
     * @param array $params
     * @return array
     */
    public function getListWithTotal(array $params = [])
    {
        $Query = new \app\common\repository\Query();

        if (!empty($params['status'])) {
            $Query->addWhere(['status', '=', $params['status']]);
        }

        if (!empty($params['nickname'])) {
            $Query->addWhere(['nickname', 'LIKE', "%{$params['nickname']}%"]);
        }

        $Query->setPage($params['page']);
        $Query->setLimit($params['limit']);

        $list  = $this->ManagerRepository->getList($Query);
        $total = $this->ManagerRepository->getTotal($Query);

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
        $Query = new \app\common\repository\Query();

        $Query->addWhere(['role_id', '=', $roleId]);

        return $this->ManagerRepository->getOne($Query);
    }

    /**
     * 添加菜单
     * @param array $params
     * @return mixed
     */
    public function createManager(array $params)
    {
        $params['password'] = Encryption::encrypt($params['password']);

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
            return $this->setMessage('管理员不存在');
        }

        /**
         * 如果密码不为空则加密密码
         */
        if (empty($params['password'])) {
            unset($params['password']);
        } else {
            $params['password'] = Encryption::encrypt($params['password']);
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
            return $this->setMessage('管理员不存在');
        }

        /**
         * 更新最后登录时间
         */
        if (!$this->ManagerRepository->updateById($manager['id'], ['login_time' => date('Y-m-d H:i:s')])) {
            return $this->setMessage('登录时间更新失败');
        }

        /**
         * 组合缓存key
         */
        $cacheKey = static::CACHE_LOGIN_ERROR_NUMBER . $manager['id'];

        try {

            /**
             * 检测管理员是否被禁用
             */
            if ($manager['status'] == static::STATUS_DISABLED) {
                throw new \RuntimeException('管理员已被禁用');
            }

            /**
             * 检测管理员已被锁定
             */
            if ($manager['status'] == static::STATUS_LOCKED) {
                throw new \RuntimeException('管理员已被锁定');
            }

            try {

                /**
                 * 检测密码是否正确
                 */
                if ($manager['password'] != Encryption::encrypt($params['password'])) {
                    throw new \RuntimeException('密码错误');
                }

            } catch (\Throwable $throwable) {

                /**
                 * 记录登录次数和锁定状态
                 */
                $errorNumber = Cache::get($cacheKey, 1);

                if ($errorNumber >= static::LOCK_LOGIN_ERROR_NUMBER) {

                    /**
                     * 更新管理员为锁定状态
                     */
                    $this->ManagerRepository->updateById($manager['id'], ['status' => static::STATUS_LOCKED]);

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

                throw new \RuntimeException($throwable->getMessage());
            }

        } catch (\Throwable $throwable) {

            /**
             * 登录失败日志
             */
            \app\admin\behavior\SystemLoginLog::error([
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
        \app\common\helper\Manager::login($manager['id']);

        /**
         * 登录成功日志
         */
        \app\admin\behavior\SystemLoginLog::success([
            'manager_id'  => $manager['id'],
            'description' => '登录成功'
        ]);

        return true;
    }
}