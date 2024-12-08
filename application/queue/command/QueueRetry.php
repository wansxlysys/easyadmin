<?php


namespace app\queue\command;


use Exception;

use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;

use app\queue\dependency\QueueFailedDependency;
use think\Queue;

class QueueRetry extends Command
{
    /**
     * 配置命令
     */
    protected function configure()
    {
        $this->setName('queue:retry')
            ->addOption('queue', null, Option::VALUE_REQUIRED, 'Queue Name', 'default')
            ->setDescription('Queue Retry');
    }

    /**
     * 执行命令
     * @param Input $input
     * @param Output $output
     * @throws Exception
     */
    protected function execute(Input $input, Output $output)
    {
        $queue = $input->getOption('queue');

        $QueueFiledService = QueueFailedDependency::getService();

        $failedList = $QueueFiledService->getListFailed($queue);

        foreach ($failedList as $failed) {

            /**
             * 重新投递队列
             */
            Queue::push($failed['consumer'], $failed['payload'], $queue);

            /**
             * 删除失败记录
             */
            $QueueFiledService->deleteFaild($failed['id']);
        }
    }
}