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
     * 创建登录成功日志
     * @param array $params
     * @return mixed
     */
    public function createPassLoginLog(array $params)
    {
        return $this->createLoginLog($params, static::STATUS_PASS);
    }

    /**
     * 创建登录失败日志
     * @param array $params
     * @return mixed
     */
    public function createFailLoginLog(array $params)
    {
        return $this->createLoginLog($params, static::STATUS_FAIL);
    }

    /**
     * 创建登录日志
     * @param array $params
     * @param $status
     * @return mixed
     */
    public function createSystemLoginLog(array $params, $status)
    {
        $params['status']   = $status;
        $params['login_ip'] = Request::ip();

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