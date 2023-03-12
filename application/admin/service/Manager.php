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
    public function createRecord(array $params)
    {
        $params = $this->buildData($params);

        return $this->ManagerModel->createRecord($params);
    }

    /**
     * 通过ID更新数据
     * @param array $params
     * @return bool
     */
    public function updateByParamsId(array $params)
    {
        return $this->ManagerModel->updateById($params['id'], $this->buildData($params));
    }

    /**
     * 删除管理员
     * @param array $params
     * @return mixed
     */
    public function deleteByParamsId(array $params)
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
        $manager = $this->ManagerModel->getByUserName($params['username']);

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
     * 构建储存数据
     * @param $params
     * @return mixed
     */
    protected function buildData($params)
    {
        // 如果不修改密码则释放密码变量
        if (empty($params['password'])) {
            unset($params['password']);
        } else {
            $params['password'] = Encryption::encrypt($params['password']);
        }

        return $params;
    }
}