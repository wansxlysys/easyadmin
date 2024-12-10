<?php


namespace app\queue\consumer;


use Exception;

use think\queue\Job;

abstract class Consumer
{
    /**
     * 消费方法
     * 启动命令：php think queue:listen --sleep 5 --tries 3 --delay 5
     * @param Job $job
     * @param $data
     * @throws Exception
     */
    public function fire(Job $job, $data)
    {
        $this->{$data['method']}($job, $data);
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