<?php


namespace app\admin\service;


use Throwable;

use app\common\enum\ManagerEnum;
use app\common\helper\ManagerHelper;
use app\common\repository\Wrapper;

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
        $Wrapper = new Wrapper();

        if (!empty($params['status'])) {
            $Wrapper->addWhere('log.status', '=', $params['status']);
        }

        if (!empty($params['username'])) {
            $Wrapper->addWhere('manager.account', 'LIKE', $params['account'] . '%');
        }

        if (!empty($params['realName'])) {
            $Wrapper->addWhere('manager.realName', 'LIKE', $params['realName'] . '%');
        }

        if (ManagerHelper::isNotSuper()) {
            $Wrapper->addWhere('manager.id', '<>', ManagerEnum::SUPER_ID);
        }

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->setField(['log.*', 'manager.avatar', 'manager.realName', 'manager.account']);
        $Wrapper->setOrder(['log.createTime' => 'desc']);

        $list  = $this->SystemLoginLogRepository->getListWithManager($Wrapper);
        $total = $this->SystemLoginLogRepository->getTotalWithManager($Wrapper);

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
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('log.id', '=', $id);
        $Wrapper->setField(['log.*', 'manager.avatar', 'manager.realName', 'manager.account']);

        return $this->SystemLoginLogRepository->getWithManager($Wrapper);
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