<?php


namespace app\index\logic;


use Exception;

use app\index\service\TestService;

class TestLogic extends \app\common\logic\Logic
{
    /**
     * 存储类
     * @var TestService
     */
    protected $TestService;

    /**
     * 初始化
     */
    public function initialize()
    {
        $this->TestService = new TestService();
    }

    /**
     * 关联删除
     * @return void
     * @throws Exception
     */
    public function deleteRoleWithManager()
    {

    }
}