<?php


namespace app\job;


use Exception;
use think\queue\Job;

class TestJob
{
    /**
     * 消费方法
     * @param Job $job
     * @param $data
     * @throws Exception
     */
    public function fire(Job $job, $data)
    {
        // php think queue:listen --sleep 1 --tries 3 --memory 256
    }

    /**
     * 消费失败
     * @param $data
     */
    public function failed($data)
    {

    }
}