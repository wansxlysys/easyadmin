<?php


namespace app\admin\service;


use Exception;

use app\common\enum\ManagerEnum;
use app\common\enum\SystemLoginLogEnum;
use app\common\helper\ManagerHelper;
use app\common\repository\Wrapper;

class SystemLoginLogService extends \app\common\service\SystemLoginLogService
{
    /**
     * 获取列表和总数
     * @param array $params
     * @return array
     * @throws Exception
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
     * @return array
     * @throws Exception
     */
    public function detailLog($id)
    {
        return $this->SystemLoginLogRepository->getById($id);
    }

    /**
     * 清空日志
     * @return int
     * @throws Exception
     */
    public function clearLog()
    {
        return $this->SystemLoginLogRepository->deleteByWhere([['id', '>', 0]]);
    }

    /**
     * 登录成功
     * @param array $params
     * @return int
     */
    public function loginSuccess(array $params)
    {
        $data['status']      = SystemLoginLogEnum::STATUS_SUCCESS;
        $data['loginIp']     = $params['loginIp'];
        $data['managerId']   = $params['managerId'];
        $data['description'] = $params['description'];

        return $this->SystemLoginLogRepository->createRecord($data);
    }

    /**
     * 登录失败
     * @param array $params
     * @return int
     */
    public function loginError(array $params)
    {
        $data['status']      = SystemLoginLogEnum::STATUS_SUCCESS;
        $data['loginIp']     = $params['loginIp'];
        $data['managerId']   = $params['managerId'];
        $data['description'] = $params['description'];

        return $this->SystemLoginLogRepository->createRecord($data);
    }
}