<?php


namespace app\admin\service;


use Exception;

use app\common\service\Service;
use app\common\repository\Wrapper;

use app\admin\enum\SystemManagerEnum;
use app\admin\enum\SystemLoginLogEnum;
use app\admin\helper\SystemManagerHelper;
use app\admin\repository\SystemLoginLogRepository;

class SystemLoginLogService extends Service
{
    /**
     * 存储类
     * @var SystemLoginLogRepository
     */
    protected SystemLoginLogRepository $SystemLoginLogRepository;

    /**
     * 获取列表和总数
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function getPageLog(array $params = [])
    {
        $Wrapper = new Wrapper();

        if (!empty($params['status'])) {
            $Wrapper->addWhere('log.status', '=', $params['status']);
        }

        if (!empty($params['account'])) {
            $Wrapper->addWhere('manager.account', 'LIKE', $params['account'] . '%');
        }

        if (!empty($params['realName'])) {
            $Wrapper->addWhere('manager.realName', 'LIKE', $params['realName'] . '%');
        }

        if (SystemManagerHelper::isNotSuper()) {
            $Wrapper->addWhere('manager.managerId', '<>', SystemManagerEnum::SUPER_ID);
        }

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->setField(['log.*', 'manager.avatar', 'manager.realName', 'manager.account']);
        $Wrapper->setOrder(['log.createTime' => 'desc']);

        $page = $this->SystemLoginLogRepository->getPageWithManager($Wrapper);

        return ['list' => $page->items(), 'total' => $page->total()];
    }

    /**
     * 获取详情
     * @param $logId
     * @return array
     * @throws Exception
     */
    public function detailLog($logId)
    {
        return $this->SystemLoginLogRepository->getById($logId);
    }

    /**
     * 清空日志
     * @return int
     * @throws Exception
     */
    public function clearLog()
    {
        return $this->SystemLoginLogRepository->deleteByWhere([['logId', '>', 0]]);
    }

    /**
     * 登录成功
     * @param $loginIp
     * @param $managerId
     * @param $message
     * @return int
     */
    public function loginSuccess($loginIp, $managerId, $message)
    {
        $data['status']    = SystemLoginLogEnum::STATUS_SUCCESS;
        $data['loginIp']   = $loginIp;
        $data['managerId'] = $managerId;
        $data['message']   = $message;

        return $this->SystemLoginLogRepository->createRecord($data);
    }

    /**
     * 登录失败
     * @param $loginIp
     * @param $managerId
     * @param $message
     * @return int
     */
    public function loginError($loginIp, $managerId, $message)
    {
        $data['status']    = SystemLoginLogEnum::STATUS_ERROR;
        $data['loginIp']   = $loginIp;
        $data['managerId'] = $managerId;
        $data['message']   = $message;

        return $this->SystemLoginLogRepository->createRecord($data);
    }
}