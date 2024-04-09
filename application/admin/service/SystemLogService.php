<?php


namespace app\admin\service;


use Throwable;

use think\facade\Request;
use app\common\util\ArrayUtil;
use app\common\enum\ManagerEnum;
use app\common\enum\SystemLogEnum;
use app\common\helper\ManagerHelper;
use app\common\repository\Wrapper;

class SystemLogService extends \app\common\service\SystemLogService
{
    /**
     * 获取列表
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

        if (!empty($params['menu'])) {
            $Wrapper->addWhere('log.menu', 'LIKE', $params['menu'] . '%');
        }

        if (!empty($params['account'])) {
            $Wrapper->addWhere('manager.account', 'LIKE', $params['account'] . '%');
        }

        if (ManagerHelper::isNotSuper()) {
            $Wrapper->addWhere('manager.id', '<>', ManagerEnum::SUPER_ID);
        }

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);
        $Wrapper->setOrder(['log.id' => 'desc']);
        $Wrapper->setField(['log.*', 'manager.avatar', 'manager.realName', 'manager.account']);

        $list  = $this->SystemLogRepository->getListWithManager($Wrapper);
        $total = $this->SystemLogRepository->getTotalWithManager($Wrapper);

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

        return $this->SystemLogRepository->getWithManager($Wrapper);
    }

    /**
     * 日志写入
     * @param $description
     * @param $status
     * @return mixed
     * @throws Throwable
     */
    public function writeLog($description, $status)
    {
        $MenuService = new SystemMenuService();

        $currentMenu = $MenuService->getCurrentMenu();

        if (!$currentMenu) {
            return false;
        }

        $manager = ManagerHelper::getManager();
        $params  = ArrayUtil::toJson(Request::post());

        $data = [
            'url'         => Request::url(),
            'requestIp'  => Request::ip(),
            'menu'        => $currentMenu['name'],
            'managerId'  => $manager['id'],
            'params'      => $params,
            'description' => $description,
            'status'      => $status
        ];

        return $this->SystemLogRepository->createRecord($data);
    }

    /**
     * 清空日志
     * @return mixed
     * @throws Throwable
     */
    public function clearLog()
    {
        return $this->SystemLogRepository->clearLog();
    }

    /**
     * 转换状态码
     * @param $code
     * @return int
     */
    public function translateCode($code)
    {
        $codeMap = [
            0 => SystemLogEnum::STATUS_ERROR,
            1 => SystemLogEnum::STATUS_SUCCESS
        ];

        return isset($codeMap[$code]) ? $codeMap[$code] : SystemLogEnum::STATUS_ERROR;
    }
}