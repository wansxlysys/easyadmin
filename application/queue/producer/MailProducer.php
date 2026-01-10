<?php


namespace app\queue\producer;


use app\queue\consumer\MailConsumer;

class MailProducer extends Producer
{
    /**
     * 测试方法
     * @param array $data
     * @param $delay
     * @return void
     */
    public static function send(array $data, $delay = 0)
    {
        static::delay(MailConsumer::class, 'sendMail', $data, $delay);
    }
}