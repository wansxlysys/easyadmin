<?php


namespace app\queue\consumer;


use Exception;

use think\queue\Job;

class TesConsumer extends Consumer
{
    /**
     * 测试消费方法
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