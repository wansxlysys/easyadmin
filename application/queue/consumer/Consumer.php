<?php


namespace app\queue\consumer;


use Exception;

use think\queue\Job;

use app\common\helper\MonologHelper;

abstract class Consumer
{
    /**
     * 消费方法
     * 启动命令：php think queue:listen --sleep 5 --tries 3 --delay 5 --timeout 120
     * @param Job $job
     * @param $payload
     * @throws Exception
     */
    public function fire(Job $job, $payload)
    {
        try {

            $this->{$payload['method']}($job, $payload['params']);

        } catch (Exception $e) {

            /**
             * 错误日志
             */
            MonologHelper::error(MonologHelper::formatException($e), $payload);

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