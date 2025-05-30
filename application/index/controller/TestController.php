<?php


namespace app\index\controller;


use app\admin\repository\SystemManagerRepository;
use app\common\dependency\Dependency;
use app\common\dependency\DependencyAspect;
use app\common\helper\ExcelHelper;
use app\common\helper\RedisHelper;
use app\common\library\lock\RedisLock;
use app\index\aspect\LockAspect;
use app\index\aspect\RoleAspect;
use app\index\aspect\TestAspect;
use app\index\aspect\UserAspect;
use app\index\dependency\DataDependency;
use app\index\dependency\TestDependency;
use app\index\dependency\UserDependency;
use app\index\repository\UserRepository;
use app\index\service\LockService;
use app\index\service\UserService;
use app\queue\producer\TestProducer;
use Exception;
use think\exception\DbException;


class TestController
{
    /**
     * sql封装
     * @return void
     * @throws DbException
     */
    public function sqlAction()
    {
        $UserRepository = new UserRepository();
        var_dump($UserRepository->selectWithInfo([
            'log'          => 1,
            'oper'         => 1,
            'departmentId' => 1,
        ]));
    }

    /**
     * lock测试
     * @return int
     */
    public function lockAction()
    {
        $RedisLock = new RedisLock("lock:1");

        if ($RedisLock->tryLock()) {
            try {
                sleep(2);
            } catch (Exception $exception) {
                $RedisLock->unlock();
            }
        }

        return 2;
    }

    /**
     * redis测试
     * @return void
     */
    public function redisAction()
    {
        RedisHelper::set('name', '张三');
    }

    /**
     * aop锁测试
     * @return void
     */
    public function aspectAction()
    {
        DependencyAspect::register(LockService::class, '*', LockAspect::class);

        $LockService = Dependency::getProxy(LockService::class);

        $LockService->execute();
    }

    /**
     * 动态代理测试
     * @return void
     */
    public function proxyAction()
    {
        DependencyAspect::register(UserService::class, 'getName', UserAspect::class);
        DependencyAspect::register(UserService::class, 'getName', RoleAspect::class);
        DependencyAspect::register(UserService::class, 'getName', TestAspect::class);

        $UserService = UserDependency::getService();

        dump($UserService->getName("张三"));
    }

    /**
     * 注入依赖测试
     * @throws Exception
     */
    public function injectAction()
    {
        $UserService = UserDependency::getService();
        $TestService = TestDependency::getService();
        $DataService = DataDependency::getService();

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
        $ManagerRepostory = new SystemManagerRepository();

        $manager1 = $ManagerRepostory->nonSub()->getById(1);
        dump($manager1);

        $manager2 = $ManagerRepostory->useSub(100)->getById(1);
        dump($manager2);
    }

    /**
     * 队列测试
     * @throws Exception
     */
    public function queueAction()
    {
        TestProducer::test(['userId' => 1]);
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