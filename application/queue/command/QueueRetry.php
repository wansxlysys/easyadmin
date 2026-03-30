<?php


namespace app\queue\command;


use Exception;

use think\Queue;
use think\console\Input;
use think\console\Output;
use think\console\Command;
use think\console\input\Option;

use app\common\helper\InjectHelper;
use app\queue\format\QueueFailedFormat;
use app\queue\service\QueueFailedService;

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
            ->setDescription('Retry failed queue');
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

        $QueueFiledService = InjectHelper::getClass(QueueFailedService::class);

        $failedList = $QueueFiledService->getListFailed($queue);

        foreach ($failedList as $failed) {

            /**
             * 格式化数据
             */
            QueueFailedFormat::formatPayload($failed);

            /**
             * 重新投递队列
             */
            Queue::push($failed['consumer'], $failed['payload'], $failed['queue']);

            /**
             * 删除失败记录
             */
            $QueueFiledService->deleteFailed($failed['queueId']);
        }
    }
}