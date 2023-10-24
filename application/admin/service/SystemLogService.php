<?php


namespace app\admin\service;


use think\facade\Request;
use app\common\util\ArrayUtil;
use app\common\repository\Query;
use app\common\enum\ManagerEnum;
use app\common\helper\ManagerHelper;

class SystemLogService extends \app\common\service\SystemLogService
{
    /**
     * 获取列表和总数
     * @param array $params
     * @return array
     */
    public function getListWithTotal(array $params = [])
    {
        $Query = new Query();

        if (!empty($params['status'])) {
            $Query->addWhere('log.status', '=', $params['status']);
        }

        if (!empty($params['menu'])) {
            $Query->addWhere('log.menu', 'LIKE', "%{$params['menu']}%");
        }

        if (!empty($params['account'])) {
            $Query->addWhere('manager.account', 'LIKE', "%{$params['account']}%");
        }

        if (ManagerHelper::isNotSuper()) {
            $Query->addWhere('manager.id', '<>', ManagerEnum::SUPER_ID);
        }

        $Query->setPage($params['page']);
        $Query->setLimit($params['limit']);
        $Query->setOrder(['log.id' => 'desc']);
        $Query->setField(['log.*', 'manager.avatar', 'manager.real_name', 'manager.account']);

        $list  = $this->SystemLogRepository->getListWithManager($Query);
        $total = $this->SystemLogRepository->getTotalWithManager($Query);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 获取详情
     * @param $id
     * @return mixed
     */
    public function getDetail($id)
    {
        $Query = new Query();

        $Query->addWhere('log.id', '=', $id);
        $Query->setField(['log.*', 'manager.avatar', 'manager.real_name', 'manager.account']);

        return $this->SystemLogRepository->getWithManager($Query);
    }

    /**
     * 日志写入
     * @param $description
     * @param $status
     * @return bool|mixed
     */
    public function writeLog($description, $status)
    {
        $MenuService = new MenuService();

        $currentMenu = $MenuService->getCurrentMenu();

        if (!$currentMenu) {
            return false;
        }

        $manager = ManagerHelper::getManager();
        $params  = ArrayUtil::toJson(Request::post());

        $data = [
            'url'         => Request::url(),
            'request_ip'  => Request::ip(),
            'menu'        => $currentMenu['name'],
            'manager_id'  => $manager['id'],
            'params'      => $params,
            'description' => $description,
            'status'      => $status
        ];

        return $this->SystemLogRepository->createRecord($data);
    }

    /**
     * 清空日志
     * @return mixed
     */
    public function clear()
    {
        return $this->SystemLogRepository->clear();
    }
}