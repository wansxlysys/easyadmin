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
        /*开发环境，性能底，支持代码热更新*/
        // php think queue:listen
        /*生产环境，性能高，不支持代码热更新*/
        // php think queue:work --daemon
    }

    /**
     * 消费失败
     * @param $data
     */
    public function failed($data)
    {

    }
}