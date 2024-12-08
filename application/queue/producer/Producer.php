<?php


namespace app\queue\producer;


use think\Queue;

class Producer
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
}