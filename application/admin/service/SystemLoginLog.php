<?php


namespace app\admin\service;


class SystemLoginLog extends \app\common\service\SystemLoginLog
{
    /**
     * 系统登录日志
     * @var \app\admin\repository\SystemLoginLog
     */
    protected $SystemLoginLogRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemLoginLogRepository = new \app\admin\repository\SystemLoginLog();
    }

    /**
     * 获取列表和总数
     * @param array $params
     * @return array
     */
    public function getListWithTotal(array $params = [])
    {
        $Query = new \app\common\repository\Query();

        if (!empty($params['status'])) {
            $Query->setWhere(['log.status', '=', $params['status']]);
        }

        if (!empty($params['username'])) {
            $Query->setWhere(['manager.account', 'LIKE', "%{$params['account']}%"]);
        }

        if (!empty($params['nickname'])) {
            $Query->setWhere(['manager.nickname', 'LIKE', "%{$params['nickname']}%"]);
        }

        $Query->setPage($params['page']);
        $Query->setLimit($params['limit']);
        $Query->setField(['log.*', 'manager.avatar', 'manager.nickname', 'manager.account']);
        $Query->setOrder(['log.create_time' => 'desc']);

        $list  = $this->SystemLoginLogRepository->getListWithManager($Query);
        $total = $this->SystemLoginLogRepository->getTotalWithManager($Query);

        return ['list' => $list, 'total' => $total];
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