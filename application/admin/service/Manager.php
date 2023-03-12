<?php


namespace app\admin\service;


use app\common\helper\Encryption;

class Manager extends \app\common\service\Manager
{

    /**
     * 角色存储嘞
     * @var \app\admin\model\Manager
     */
    protected $ManagerModel;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->ManagerModel = new \app\admin\model\Manager();
    }

    /**
     * 获取列表和总数
     * @param array $params
     * @return array
     */
    public function getListWithTotal(array $params = [])
    {
        $Query = new \app\common\model\Query();

        if (!empty($params['status'])) {
            $Query->addWhere(['status', '=', $params['status']]);
        }

        if (!empty($params['nickname'])) {
            $Query->addWhere(['nickname', 'LIKE', "%{$params['nickname']}%"]);
        }

        $Query->setPage($params['page']);
        $Query->setLimit($params['limit']);

        $list  = $this->ManagerModel->getList($Query);
        $total = $this->ManagerModel->getTotal($Query);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 通过ID获取管理员
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->ManagerModel->getById($id);
    }

    /**
     * 通过角色ID获取管理员列表
     * @param $roleId
     * @return mixed
     */
    public function getByRoleId($roleId)
    {
        $Query = new \app\common\model\Query();

        $Query->addWhere(['role_id', '=', $roleId]);

        return $this->ManagerModel->getOne($Query);
    }

    /**
     * 添加菜单
     * @param array $params
     * @return mixed
     */
    public function createManager(array $params)
    {
        /**
         * 检测账号是否存在
         */
        if ($this->checkExistByAccount($params['account'])) {
            return $this->setMessage('账号已存在');
        }

        $params['password'] = Encryption::encrypt($params['password']);

        return $this->ManagerModel->createRecord($params);
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
         * 检测账号是否存在
         */
        if ($this->checkExistByAccount($params['account'], $params['id'])) {
            return $this->setMessage('账号已存在');
        }

        /**
         * 如果密码不为空则加密密码
         */
        if (empty($params['password'])) {
            unset($params['password']);
        } else {
            $params['password'] = Encryption::encrypt($params['password']);
        }

        return $this->ManagerModel->updateById($params['id'], $params);
    }

    /**
     * 删除管理员
     * @param array $params
     * @return mixed
     */
    public function deleteManager(array $params)
    {
        return $this->ManagerModel->deleteById($params['id']);
    }

    /**
     * 管理员登录
     * @param array $params
     * @return bool
     */
    public function login(array $params)
    {
        $manager = $this->ManagerModel->getByAccount($params['account']);

        if (!$manager) {
            return $this->setMessage('管理员不存在');
        }

        if ($manager['password'] != Encryption::encrypt($params['password'])) {
            return $this->setMessage('密码错误');
        }

        if ($manager['status'] == \app\common\constant\Manager::STATUS_DISABLED) {
            return $this->setMessage('管理员已被禁用');
        }

        \app\common\helper\Manager::login($manager['id']);

        return true;
    }

    /**
     * 检测账号是否存在
     * @param string $account
     * @param string $id
     * @return mixed
     */
    protected function checkExistByAccount($account, $id = '')
    {
        $Query = new \app\common\model\Query();

        if (!empty($id)) {
            $Query->addWhere(['id', '<>', $id]);
        }

        $Query->addWhere(['account', '=', $account]);

        return $this->ManagerModel->getOne($Query);
    }
}