<?php


namespace app\admin\service;


use Exception;

use app\common\repository\Wrapper;

use app\admin\enum\ManagerEnum;
use app\admin\enum\SystemLoginLogEnum;
use app\admin\helper\SystemManagerHelper;
use app\admin\repository\SystemLoginLogRepository;

class SystemLoginLogService
{
    /**
     * 存储类
     * @var SystemLoginLogRepository
     */
    protected $SystemLoginLogRepository;

    /**
     * 初始化
     */
    public function injectRepostitory(SystemLoginLogRepository $SystemLoginLogRepository)
    {
        $this->SystemLoginLogRepository = $SystemLoginLogRepository;
    }

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

        if (!empty($params['username'])) {
            $Wrapper->addWhere('manager.account', 'LIKE', $params['account'] . '%');
        }

        if (!empty($params['realName'])) {
            $Wrapper->addWhere('manager.realName', 'LIKE', $params['realName'] . '%');
        }

        if (SystemManagerHelper::isNotSuper()) {
            $Wrapper->addWhere('manager.managerId', '<>', ManagerEnum::SUPER_ID);
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