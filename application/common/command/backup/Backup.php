<?php


namespace app\common\command\backup;


use Exception;

use think\facade\Env;
use think\facade\Config;

use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;

use Ifsnop\Mysqldump\Mysqldump;

class Backup extends Command
{
    /**
     * 配置命令
     * php think database:backup --file easyadmin
     */
    protected function configure()
    {
        $this->setName('database:backup')
            ->addOption('file', null, Option::VALUE_REQUIRED, 'File Name', 'easyadmin')
            ->setDescription('DataBases Backup');
    }

    /**
     * 执行命令
     * @param Input $input
     * @param Output $output
     */
    protected function execute(Input $input, Output $output)
    {
        $name = $input->getOption('file');

        try {

            $hostname = Config::get('database.hostname');
            $hostport = Config::get('database.hostport');
            $database = Config::get('database.database');
            $username = Config::get('database.username');
            $password = Config::get('database.password');

            $MysqlDump = new Mysqldump("mysql:host={$hostname}:{$hostport};dbname={$database}", $username, $password);
            $MysqlDump->start(Env::get('root_path') . "data/database/{$name}.sql");

            $output->writeln("备份成功");

        } catch (Exception $Exception) {
            $output->writeln("备份失败：{$Exception->getMessage()}");
        }
    }
}