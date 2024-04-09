<?php


namespace app\admin\service;


use Throwable;

use app\common\repository\Query;
use app\common\enum\ManagerEnum;
use app\common\helper\ManagerHelper;

class SystemLoginLogService extends \app\common\service\SystemLoginLogService
{
    /**
     * 获取列表和总数
     * @param array $params
     * @return array
     * @throws Throwable
     */
    public function listLog(array $params = [])
    {
        $Query = new Query();

        if (!empty($params['status'])) {
            $Query->addWhere('log.status', '=', $params['status']);
        }

        if (!empty($params['username'])) {
            $Query->addWhere('manager.account', 'LIKE', $params['account'] . '%');
        }

        if (!empty($params['realName'])) {
            $Query->addWhere('manager.realName', 'LIKE', $params['realName'] . '%');
        }

        if (ManagerHelper::isNotSuper()) {
            $Query->addWhere('manager.id', '<>', ManagerEnum::SUPER_ID);
        }

        $Query->setPage($params['page']);
        $Query->setLimit($params['limit']);
        $Query->setField(['log.*', 'manager.avatar', 'manager.realName', 'manager.account']);
        $Query->setOrder(['log.createTime' => 'desc']);

        $list  = $this->SystemLoginLogRepository->getListWithManager($Query);
        $total = $this->SystemLoginLogRepository->getTotalWithManager($Query);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 获取详情
     * @param $id
     * @return mixed
     * @throws Throwable
     */
    public function detailLog($id)
    {
        $Query = new Query();

        $Query->addWhere('log.id', '=', $id);
        $Query->setField(['log.*', 'manager.avatar', 'manager.realName', 'manager.account']);

        return $this->SystemLoginLogRepository->getWithManager($Query);
    }

    /**
     * 创建登录日志
     * @param array $params
     * @return mixed
     * @throws Throwable
     */
    public function createLog(array $params)
    {
        return $this->SystemLoginLogRepository->createRecord($params);
    }

    /**
     * 清空日志
     * @return mixed
     * @throws Throwable
     */
    public function clearLog()
    {
        return $this->SystemLoginLogRepository->clearSystemLoginLog();
    }
}