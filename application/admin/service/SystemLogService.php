<?php


namespace app\admin\service;


use app\admin\enum\ManagerEnum;
use app\admin\helper\SystemManagerHelper;
use app\admin\helper\SystemMenuHelper;
use app\admin\repository\SystemLogRepository;
use app\common\repository\Wrapper;
use app\common\util\ArrayUtil;
use Exception;
use think\facade\Request;

class SystemLogService
{
    /**
     * 存储类
     * @var SystemLogRepository
     */
    protected $SystemLogRepository;

    /**
     * 初始化
     */
    public function injectRepostitory(SystemLogRepository $SystemLogRepository)
    {
        $this->SystemLogRepository = $SystemLogRepository;
    }

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

        if (SystemManagerHelper::isNotSuper()) {
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
     * @return array
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
     * @return int
     * @throws Exception
     */
    public function writeLog($description, $status)
    {
        $currentMenu = SystemMenuHelper::getCurrentMenu();

        $manager = SystemManagerHelper::getManager();
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
     * @return int
     * @throws Exception
     */
    public function clearLog()
    {
        return $this->SystemLogRepository->deleteByWhere([
            ['id', '>', 0]
        ]);
    }
}