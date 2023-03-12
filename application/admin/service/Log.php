<?php


namespace app\admin\service;


use helper\JsonArray;
use think\facade\Request;

class Log extends \app\common\service\Log
{
    /**
     * 日志存储类
     * @var \app\admin\model\Log
     */
    protected $LogRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->LogRepository = new \app\admin\model\Log();
    }

    /**
     * 获取列表和总数
     * @param array $params
     * @return array
     */
    public function getListWithTotal(array $params = [])
    {
        $Query = new \app\common\repository\Query();

        if (!empty($params['menu'])) {
            $Query->where[] = ['menu', 'LIKE', "%{$params['menu']}%"];
        }

        if (!empty($params['status'])) {
            $Query->where[] = ['status', '=', $params['status']];
        }

        $Query->page  = !empty($params['page']) ? $params['page'] : 1;
        $Query->limit = !empty($params['limit']) ? $params['limit'] : 10;
        $Query->order = ['id' => 'desc'];

        $list = $this->LogRepository->getList($Query);
        $total = $this->LogRepository->getTotal($Query);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 获取详情
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->LogRepository->getById($id);
    }

    /**
     * 日志写入
     * @param $description
     * @param $status
     * @return bool|mixed
     */
    public function writeLog($description, $status)
    {
        $MenuService   = new \app\admin\service\Menu();
        $ManagerHelper = new \app\admin\helper\Manager();

        $manager     = $ManagerHelper->getManager();
        $currentMenu = $MenuService->getCurrentMenu();

        if (!$currentMenu) {
            return false;
        }

        $data = [
            'url'         => Request::url(),
            'menu'        => $currentMenu['title'],
            'manager_id'  => $manager['id'],
            'username'    => $manager['username'],
            'params'      => JsonArray::arrayToJson(Request::post()),
            'description' => $description,
            'status'      => $status
        ];

        return $this->LogRepository->createRecord($data);
    }

    /**
     * 清空日志
     * @return mixed
     */
    public function clear()
    {
        return $this->LogRepository->clear();
    }
}