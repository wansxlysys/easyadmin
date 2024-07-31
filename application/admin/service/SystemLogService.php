<?php


namespace app\admin\service;


use Exception;

use think\facade\Request;

use app\common\util\ArrayUtil;
use app\common\enum\ManagerEnum;
use app\common\enum\SystemLogEnum;
use app\common\repository\Wrapper;
use app\common\helper\ManagerHelper;
use app\common\helper\SystemMenuHelper;

class SystemLogService extends \app\common\service\SystemLogService
{
    /**
     * 获取列表
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
        $Wrapper->setField(['log.*', 'manager.avatar', 'manager.realName', 'manager.account', 'menu.name menuName']);

        $list  = $this->SystemLogRepository->getListWithInfo($Wrapper);
        $total = $this->SystemLogRepository->getTotalWithInfo($Wrapper);

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 获取详情
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function detailLog($id)
    {
        return $this->SystemLogRepository->getById($id);
    }

    /**
     * 日志写入
     * @param $description
     * @param $status
     * @return mixed
     * @throws Exception
     */
    public function writeLog($description, $status)
    {
        $currentMenu = SystemMenuHelper::getCurrentMenu();

        $manager = ManagerHelper::getManager();
        $params  = ArrayUtil::toJson(Request::post());

        $data = [
            'requestIp'   => Request::ip(),
            'requestUrl'  => Request::url(),
            'managerId'   => $manager['id'],
            'menuId'      => $currentMenu['id'],
            'params'      => $params,
            'status'      => $status,
            'description' => $description
        ];

        return $this->SystemLogRepository->createRecord($data);
    }

    /**
     * 清空日志
     * @return mixed
     * @throws Exception
     */
    public function clearLog()
    {
        return false !== $this->SystemLogRepository->deleteByWhere([['id', '>', 0]]);
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