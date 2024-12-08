<?php


namespace app\common\command\generator;


use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;

class Generator extends Command
{
    /**
     * 配置命令
     * php think system:generator --class User --remark 用户
     * @return void
     */
    protected function configure()
    {
        $this->setName('system:generator')
            ->addOption('class', null, Option::VALUE_REQUIRED, "Class Name")
            ->addOption('remark', null, Option::VALUE_REQUIRED, 'Remark Text')
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
        Executor::execute($input->getOption('class'), [
            $input->getOption('class'),
            $input->getOption('remark')
        ]);
    }
}