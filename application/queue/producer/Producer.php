<?php


namespace app\queue\producer;


use think\Queue;

abstract class Producer
{
    /**
     * 投递队列
     * @param $consumer
     * @param $method
     * @param $params
     * @param $queue
     * @return void
     */
    public static function push($consumer, $method, $params, $queue = null)
    {
        Queue::push($consumer . '@fire', ['method' => $method, 'params' => $params], $queue);
    }

    /**
     * 投递队列
     * @param $consumer
     * @param $method
     * @param $params
     * @param $delay
     * @param null $queue
     * @return void
     */
    public static function delay($consumer, $method, $params, $delay, $queue = null)
    {
        Queue::later($delay, $consumer . '@fire', ['method' => $method, 'params' => $params], $queue);
    }
}