<?php


namespace app\index\service;


use Exception;

use app\index\logic\TestLogic;

class TestService extends \app\common\service\Service
{
    /**
     * 逻辑层
     * @var TestLogic
     */
    protected $TestLogic;

    /**
     * 初始化
     */
    public function initialize()
    {
        $this->TestLogic = new TestLogic();
    }

    /**
     * 删除
     * @return void
     * @throws Exception
     */
    public function delete()
    {
        $this->TestLogic->deleteRoleWithManager();
    }
}