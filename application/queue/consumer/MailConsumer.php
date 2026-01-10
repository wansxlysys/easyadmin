<?php


namespace app\queue\consumer;


use Exception;

use think\queue\Job;

use app\common\helper\MailHelper;

class MailConsumer extends Consumer
{
    /**
     * 发送邮件
     * @param Job $job
     * @param $data
     * @throws Exception
     */
    public function sendMail(Job $job, $data)
    {
        /**
         * 发送邮件
         */
        MailHelper::sendMail($data);

        /**
         * 删除队列
         */
        $job->delete();
    }
}