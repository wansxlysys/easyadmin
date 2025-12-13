<?php


namespace app\queue\producer;


use think\Queue;

abstract class Producer
{
    /**
     * 投递队列
     * @param $consumer
     * @param $method
     * @param $data
     * @param $queue
     * @return void
     */
    public static function push($consumer, $method, $data, $queue = null)
    {
        Queue::push($consumer . '@' . $method, $data, $queue);
    }

    /**
     * 投递队列
     * @param $consumer
     * @param $method
     * @param $data
     * @param $delay
     * @param null $queue
     * @return void
     */
    public static function delay($consumer, $method, $data, $delay, $queue = null)
    {
        Queue::later($delay, $consumer . '@' . $method, $data, $queue);
    }
}