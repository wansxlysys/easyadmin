<?php


namespace app\admin\service;


use app\common\helper\Encryption;

class Manager extends \app\common\service\Manager
{

    /**
     * 角色存储嘞
     * @var \app\admin\model\Role
     */
    protected $ManagerRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->ManagerRepository = new \app\admin\model\Manager();
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
            $Query->where[] = ['status', '=', $params['status']];
        }

        if (!empty($params['nickname'])) {
            $Query->where[] = ['nickname', 'LIKE', "%{$params['nickname']}%"];
        }

        $Query->page  = !empty($params['page']) ? $params['page'] : 1;
        $Query->limit = !empty($params['limit']) ? $params['limit'] : 10;

        $list = $this->ManagerRepository->getList($Query);
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
     * 通过昵称获取
     * @param $userName
     * @return mixed
     */
    public function getByUserName($userName)
    {
        $Query = new \app\common\repository\Query();

        $Query->where[] = ['username', '=', $userName];

        return $this->ManagerRepository->getOne($Query);
    }

    /**
     * 通过角色ID获取管理员列表
     * @param $roleId
     * @return mixed
     */
    public function getByRoleId($roleId)
    {
        $Query = new \app\common\repository\Query();

        $Query->where[] = ['role_id', '=', $roleId];

        return $this->ManagerRepository->getOne($Query);
    }

    /**
     * 添加菜单
     * @param array $params
     * @return mixed
     */
    public function createRecord(array $params)
    {
        $params = $this->buildData($params);

        return $this->ManagerRepository->createRecord($params);
    }

    /**
     * 通过ID更新数据
     * @param array $params
     * @return bool
     */
    public function updateByParamsId(array $params)
    {
        $params = $this->buildData($params);

        $Query = new \app\common\repository\Query();

        $Query->where[] = ['id', '=', $params['id']];

        return $this->ManagerRepository->updateRecord($Query, $params);
    }

    /**
     * 删除管理员
     * @param array $params
     * @return mixed
     */
    public function deleteByParamsId(array $params)
    {
        $Query = new \app\common\repository\Query();

        $Query->where[] = ['id', '=', $params['id']];

        return $this->ManagerRepository->deleteRecord($Query);
    }

    /**
     * 管理员登录
     * @param array $params
     * @return bool
     */
    public function login(array $params)
    {
        $manager = $this->getByUserName($params['username']);

        if (!$manager) {
            return $this->setMessage('管理员不存在');
        }

        if ($manager['password'] != Encryption::encrypt($params['password'])) {
            return $this->setMessage('密码错误');
        }

        if ($manager['status'] == \app\common\constant\Manager::STATUS_DISABLED) {
            return $this->setMessage('管理员已被禁用');
        }

        $ManagerHelper = new \app\admin\helper\Manager();

        $ManagerHelper->login($manager['id']);

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