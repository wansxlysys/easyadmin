<?php


namespace app\index\controller;


use Exception;

use app\common\helper\ExcelHelper;
use app\common\repository\ManagerRepository;

use app\index\factory\DataFactory;
use app\index\factory\TestFactory;
use app\index\factory\UserFactory;

class TestController
{
    /**
     * 逻辑层测试
     * @throws Exception
     */
    public function logicAction()
    {
        $UserService = UserFactory::getService();
        $TestService = TestFactory::getService();
        $DataService = DataFactory::getService();

        dump($UserService->sayName());
        dump($TestService->sayName());
        dump($DataService->sayName());
    }

    /**
     * 分表测试
     * @throws Exception
     */
    public function daoAction()
    {
        $ManagerRepostory = new ManagerRepository();

        $manager1 = $ManagerRepostory->nonSub()->getById(1);
        dump($manager1);

        $manager2 = $ManagerRepostory->useSub(100)->getById(1);
        dump($manager2);
    }

    /**
     * Execl测试
     * @throws Exception
     */
    public function execlAction()
    {
        $readOptions = [
            '姓名' => ['field' => 'string', 'type' => 'string'],
            '年龄' => ['field' => 'int', 'type' => 'int'],
            '日期' => ['field' => 'date', 'type' => 'datetime', 'format' => 'Y-m-d'],
            '时间' => ['field' => 'time', 'type' => 'datetime', 'format' => 'H:m:s'],
            '入学' => ['field' => 'datetime', 'type' => 'datetime', 'format' => 'Y-m-d H:m:s'],
        ];

        $readData = ExcelHelper::read("C:/Users/liming/Desktop/read.xlsx", $readOptions);

        dump($readData);

        $writeOptions = [
            'name' => ['title' => '姓名', 'type' => 'string', 'explicit' => false],
            'age'  => ['title' => '年龄', 'type' => 'string', 'explicit' => false],
            'date' => ['title' => '日期', 'type' => 'string', 'explicit' => false],
            'tel'  => ['title' => '电话', 'type' => 'string', 'explicit' => true],
        ];

        $writeData = [
            ['name' => '张三', 'age' => 18, 'date' => '2024-12-01', 'tel' => '1889588889688999966'],
            ['name' => '李四', 'age' => 20, 'date' => '2024-12-01', 'tel' => 13858965874],
            ['name' => '王五', 'age' => 19, 'date' => '2024-12-01', 'tel' => 19589668558],
        ];

        ExcelHelper::save("C:/Users/liming/Desktop/write.xlsx", $writeOptions, $writeData);
    }
}