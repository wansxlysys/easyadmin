<?php


namespace app\common\command\generator;


use think\facade\Env;
use think\console\Input;
use think\console\Output;
use think\console\Command;
use think\console\input\Option;

use app\common\util\ConsoleUtil;

class Generator extends Command
{
    /**
     * 配置命令
     * php think generator:code --module admin --class User --tableId userId --comment 用户管理
     * @return void
     */
    protected function configure()
    {
        $this->setName('generator:code')
            ->addOption('class', null, Option::VALUE_REQUIRED, "Class Name")
            ->addOption('module', null, Option::VALUE_REQUIRED, "Module Name")
            ->addOption('comment', null, Option::VALUE_REQUIRED, 'Comment Text')
            ->addOption('tableId', null, Option::VALUE_REQUIRED, 'Table Id')
            ->setDescription('Generator Code');
    }

    /**
     * 执行命令
     * @param Input $input
     * @param Output $output
     * @return void
     */
    protected function execute(Input $input, Output $output)
    {
        $templates = [
            ['layer' => 'service', 'stub' => 'Service'],
            ['layer' => 'validate', 'stub' => 'Validate'],
            ['layer' => 'controller', 'stub' => 'Controller'],
            ['layer' => 'repository', 'stub' => 'Repository'],
        ];

        $replace = [
            '{{class}}'   => $input->getOption('class'),
            '{{module}}'  => $input->getOption('module'),
            '{{comment}}' => $input->getOption('comment'),
            '{{tableId}}' => $input->getOption('tableId'),
        ];

        foreach ($templates as $template) {

            $savePath = $this->getSavePath($input->getOption('module'), $input->getOption('class'), $template['layer']);

            if (file_exists($savePath)) {
                ConsoleUtil::writeln('文件存在：' . $savePath);
            } else {

                $dirPath = dirname($savePath);

                if (!is_dir($dirPath)) {
                    mkdir($dirPath, 0777, true);
                }

                file_put_contents($savePath, strtr($this->getStubContent($template['stub']), $replace));

                ConsoleUtil::writeln('创建成功：' . $savePath);
            }
        }
    }

    /**
     * 获取模板
     * @return string
     */
    protected function getStubContent($stub)
    {
        return file_get_contents(Env::get('app_path') . 'common/command/generator/stub/' . $stub . '.stub');
    }

    /**
     * 获取保存目录
     * @return string
     */
    protected function getSavePath($module, $class, $layer)
    {
        return Env::get('app_path') . $module . '/' . $layer . '/' . $class . ucfirst($layer) . '.php';
    }
}