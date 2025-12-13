<?php


namespace app\queue\producer;


use app\queue\consumer\TesConsumer;

class TestProducer extends Producer
{
    /**
     * 测试方法
     * @param array $data
     * @return void
     */
    public static function testPush(array $data)
    {
        static::push(TesConsumer::class, 'test', $data);
    }

    /**
     * 测试方法
     * @param array $data
     * @param $delay
     * @return void
     */
    public static function testDelay(array $data, $delay)
    {
        static::delay(TesConsumer::class, 'test', $data, $delay);
    }
}