<?php


namespace app\queue\consumer;


use Throwable;

use think\queue\Job;

use app\common\helper\MonologHelper;

abstract class Consumer
{
    /**
     * 消费方法
     * 启动命令：php think queue:listen --sleep 5 --tries 3 --delay 5 --timeout 120
     * @param Job $job
     * @param $payload
     * @throws Throwable
     */
    public function fire(Job $job, $payload)
    {
        try {

            $this->{$payload['method']}($job, $payload['params']);

        } catch (Throwable $e) {

            /**
             * 错误日志
             */
            MonologHelper::channel('queue')->error("{$e->getMessage()} in {$e->getFile()}:{$e->getLine()}", $payload);

            throw $e;
        }
    }

    /**
     * 消费失败
     * @param $data
     */
    public function failed($data)
    {
        /**
         * 消费方法抛出异常时触发
         */
    }
}