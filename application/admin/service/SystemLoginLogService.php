<?php


namespace app\admin\service;


use app\common\repository\Query;
use app\common\enum\ManagerEnum;
use app\common\helper\ManagerHelper;

class SystemLoginLogService extends \app\common\service\SystemLoginLogService
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

        if (!empty($params['username'])) {
            $Query->addWhere('manager.account', 'LIKE', $params['account'] . '%');
        }

        if (!empty($params['real_name'])) {
            $Query->addWhere('manager.real_name', 'LIKE', $params['real_name'] . '%');
        }

        if (ManagerHelper::isNotSuper()) {
            $Query->addWhere('manager.id', '<>', ManagerEnum::SUPER_ID);
        }

        $Query->setPage($params['page']);
        $Query->setLimit($params['limit']);
        $Query->setField(['log.*', 'manager.avatar', 'manager.real_name', 'manager.account']);
        $Query->setOrder(['log.create_time' => 'desc']);

        $list  = $this->SystemLoginLogRepository->getListWithManager($Query);
        $total = $this->SystemLoginLogRepository->getTotalWithManager($Query);

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

        return $this->SystemLoginLogRepository->getWithManager($Query);
    }

    /**
     * 创建登录日志
     * @param array $params
     * @return mixed
     */
    public function createSystemLoginLog(array $params)
    {
        return $this->SystemLoginLogRepository->createRecord($params);
    }

    /**
     * 清空日志
     * @return mixed
     */
    public function clearSystemLoginLog()
    {
        return $this->SystemLoginLogRepository->clearSystemLoginLog();
    }
}