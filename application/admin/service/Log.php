<?php


namespace app\admin\service;


use think\facade\Request;

class Log extends \app\common\service\Log
{
    /**
     * 日志存储类
     * @var \app\admin\repository\Log
     */
    protected $LogRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->LogRepository = new \app\admin\repository\Log();
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
            $Query->addWhere(['menu', 'LIKE', "%{$params['menu']}%"]);
        }

        if (!empty($params['status'])) {
            $Query->addWhere(['status', '=', $params['status']]);
        }

        $Query->setPage($params['page']);
        $Query->setLimit($params['limit']);
        $Query->setOrder(['id' => 'desc']);

        $list  = $this->LogRepository->getList($Query);
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
        $MenuService = new \app\admin\service\Menu();

        $currentMenu = $MenuService->getCurrentMenu();

        if (!$currentMenu) {
            return false;
        }

        $manager = \app\common\helper\Manager::getManager();
        $params  = \app\common\helper\JsonArray::arrayToJson(Request::post());

        $data = [
            'url'         => Request::url(),
            'menu'        => $currentMenu['title'],
            'manager_id'  => $manager['id'],
            'params'      => $params,
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