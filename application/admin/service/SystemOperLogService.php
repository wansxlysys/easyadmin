<?php


namespace app\admin\service;


use Exception;

use app\common\service\Service;
use app\common\repository\Wrapper;

use app\admin\enum\SystemManagerEnum;
use app\admin\helper\SystemManagerHelper;
use app\admin\repository\SystemOperLogRepository;

class SystemOperLogService extends Service
{
    /**
     * 存储类
     * @var SystemOperLogRepository
     */
    protected SystemOperLogRepository $SystemOperLogRepository;

    /**
     * 获取列表
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

        if (!empty($params['menuName'])) {
            $Wrapper->addWhere('menu.name', 'LIKE', $params['menuName'] . '%');
        }

        if (!empty($params['account'])) {
            $Wrapper->addWhere('manager.account', 'LIKE', $params['account'] . '%');
        }

        if (SystemManagerHelper::isNotSuper()) {
            $Wrapper->addWhere('manager.managerId', '<>', SystemManagerEnum::SUPER_ID);
        }

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->setOrder(['log.logId' => 'desc']);
        $Wrapper->setField(['log.*', 'manager.avatar', 'manager.realName', 'manager.account', 'menu.name menuName']);

        $page = $this->SystemOperLogRepository->getPageWithInfo($Wrapper);

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
        return $this->SystemOperLogRepository->getById($logId);
    }

    /**
     * 创建日志
     * @param array $params
     * @return int
     */
    public function createLog(array $params)
    {
        return $this->SystemOperLogRepository->createRecord($params);
    }

    /**
     * 清空日志
     * @return int
     * @throws Exception
     */
    public function clearLog()
    {
        return $this->SystemOperLogRepository->deleteByWhere([
            ['logId', '>', 0]
        ]);
    }
}