<?php


namespace app\common\command\generator;


class Executor
{
    /**
     * 执行器
     * @var array
     */
    private static $stubs = [
        ['module' => 'common', 'layer' => 'service', 'stub' => 'CommonService'],
        ['module' => 'common', 'layer' => 'validate', 'stub' => 'CommonValidate'],
        ['module' => 'common', 'layer' => 'repository', 'stub' => 'CommonRepository'],
        ['module' => 'common', 'layer' => 'dependency', 'stub' => 'CommonDependency'],
        ['module' => 'admin', 'layer' => 'service', 'stub' => 'AdminService'],
        ['module' => 'admin', 'layer' => 'validate', 'stub' => 'AdminValidate'],
        ['module' => 'admin', 'layer' => 'controller', 'stub' => 'AdminController'],
        ['module' => 'admin', 'layer' => 'dependency', 'stub' => 'AdminDependency'],
    ];

    /**
     * 执行器
     * @param $class
     * @param $replace
     * @return void
     */
    public static function execute($class, $replace)
    {
        foreach (static::$stubs as $stub) {

            $Handler = new Handler();

            $Handler->setClass($class);
            $Handler->setReplace($replace);
            $Handler->setStub($stub['stub']);
            $Handler->setLayer($stub['layer']);
            $Handler->setModule($stub['module']);

            $Handler->generate();
        }
    }
}