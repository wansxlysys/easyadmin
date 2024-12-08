<?php


namespace app\queue\consumer;


use Exception;

use think\queue\Job;

class TesConsumer extends Consumer
{
    /**
     * 消费方法
     * 队列重启：php think:queue:restart
     * 开发环境：php think queue:listen --sleep 5 --tries 3 --delay 5
     * 生产环境：php think queue:work --daemon --sleep 5 --tries 3 --delay 5
     * @param Job $job
     * @param $data
     * @throws Exception
     */
    public function test(Job $job, $data)
    {
        /**
         * 消费失败抛出异常
         */
        var_dump($data);

        /**
         * 消费成功删除队列
         */
        $job->delete();
    }
}