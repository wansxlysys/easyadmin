<?php


namespace app\index\controller;


use app\admin\repository\SystemManagerRepository;
use app\common\builder\RelationBuilder;
use app\common\dependency\Dependency;
use app\common\dependency\DependencyAspect;
use app\common\helper\RedisHelper;
use app\common\extend\lock\RedisLock;
use app\common\util\ExcelUtil;
use app\index\aspect\LockAspect;
use app\index\aspect\RoleAspect;
use app\index\aspect\TestAspect;
use app\index\aspect\UserAspect;
use app\index\repository\UserRepository;
use app\index\service\DataService;
use app\index\service\LockService;
use app\index\service\TestService;
use app\index\service\UserService;
use app\queue\producer\MailProducer;
use Exception;
use think\exception\DbException;


class TestController
{

    /**
     * 数据关联
     * @return void
     * @throws Exception
     */
    public function relationAction()
    {
        $managerList = db()->name('system_manager')->select();

        $queryFn = function ($mainKeys) {
            return db()->name('system_login_log')->whereIn('managerId', $mainKeys)->select();
        };

        $withOneList = RelationBuilder::from($managerList, 'managerId')
            ->query($queryFn)
            ->withOne('loginLog')->get();

        $withManyList = RelationBuilder::from($managerList, 'managerId')
            ->query($queryFn)
            ->withMany('loginLog')->get();

        $withOneFnList = RelationBuilder::from($managerList, 'managerId')
            ->query($queryFn)
            ->withOne(function (&$main, $with) {
                $main['message'] = $with['message'];
            })->get();

        $withManyFnList = RelationBuilder::from($managerList, 'managerId')
            ->query($queryFn)
            ->withMany(function (&$main, $withList) {
                foreach ($withList as $with) {
                    $main['loginLog'][] = $with['message'];
                }
            })->get();

        dump($withOneList);
        dump($withManyList);
        dump($withOneFnList);
        dump($withManyFnList);
    }

    /**
     * 邮件
     * @return void
     * @throws Exception
     */
    public function mailAction()
    {
        MailProducer::send([
            'body'    => '测试邮件内容',
            'subject' => '测试邮件主题',
            'address' => '1628883533@qq.com',
        ]);
    }

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
     * @return string
     */
    public function lockAction()
    {
        $RedisLock = new RedisLock("lock:1");

        if ($RedisLock->tryLock()) {
            try {
                return 'success';
            } catch (Exception $e) {
                $RedisLock->unlock();
            }
        }

        return 'error';
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

        $UserService = Dependency::getProxy(UserService::class);

        dump($UserService->getName("张三"));
    }

    /**
     * 注入依赖测试
     * @throws Exception
     */
    public function diAction()
    {
        dump(Dependency::getProxy(UserService::class)->sayName());
        dump(Dependency::getProxy(TestService::class)->sayName());
        dump(Dependency::getProxy(DataService::class)->sayName());
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

        $readData = ExcelUtil::read("C:/Users/liming/Desktop/read.xlsx", $readOptions);

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

        ExcelUtil::save("C:/Users/liming/Desktop/write.xlsx", $writeOptions, $writeData);
    }
}