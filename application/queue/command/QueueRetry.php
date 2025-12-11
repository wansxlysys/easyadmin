<?php


namespace app\queue\command;


use Exception;

use app\common\dependency\Dependency;
use app\queue\service\QueueFailedService;

use think\Queue;
use think\console\Input;
use think\console\Output;
use think\console\Command;
use think\console\input\Option;

class QueueRetry extends Command
{
    /**
     * 配置命令
     * php think queue:retry --queue default
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

        $QueueFiledService = Dependency::getProxy(QueueFailedService::class);

        $failedList = $QueueFiledService->getListFailed($queue);

        foreach ($failedList as $failed) {

            /**
             * 重新投递队列
             */
            Queue::push($failed['consumer'], $failed['payload'], $failed['queue']);

            /**
             * 删除失败记录
             */
            $QueueFiledService->deleteFailed($failed['id']);
        }
    }
}