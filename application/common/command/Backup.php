<?php


namespace app\common\command;


use think\facade\Env;
use think\facade\Config;
use think\console\Input;
use think\console\Output;
use think\console\input\Option;
use Ifsnop\Mysqldump\Mysqldump;

class Backup extends \think\console\Command
{
    /**
     * 配置命令
     */
    protected function configure()
    {
        $this->setName('backup')
            ->addOption('saveName', null, Option::VALUE_REQUIRED, 'File SaveName', 'easyadmin')
            ->setDescription('DataBases Backup');
    }

    /**
     * 执行命令
     * @param Input $input
     * @param Output $output
     */
    protected function execute(Input $input, Output $output)
    {
        $rootPath = Env::get('root_path');
        $saveName = $input->getOption('saveName');

        try {
            $hostname = Config::get('database.hostname');
            $hostport = Config::get('database.hostport');
            $database = Config::get('database.database');
            $username = Config::get('database.username');
            $password = Config::get('database.password');
            $connect  = "mysql:host={$hostname}:{$hostport};dbname={$database}";

            $MysqlDump = new Mysqldump($connect, $username, $password);
            $MysqlDump->start($rootPath . "data/{$saveName}.sql");

            $output->writeln("备份成功");

        } catch (\Throwable $throwable) {
            $output->writeln("备份失败：{$throwable->getMessage()}");
        }
    }
}