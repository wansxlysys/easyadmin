<?php


namespace app\queue\behavior;


use think\queue\Job;

use app\common\util\JsonUtil;
use app\common\helper\InjectHelper;
use app\queue\service\QueueFailedService;

class QueueFailedBehavior
{
    /**
     * 异常处理
     * @param Job $job
     * @return void
     */
    public function run(Job $job)
    {
        $rawBody = JsonUtil::toArray($job->getRawBody());

        $failed['queue']    = $job->getQueue();
        $failed['consumer'] = $job->getName();
        $failed['payload']  = $rawBody['data'];
        $failed['uniqid']   = $rawBody['data']['uniqid'];

        InjectHelper::getClass(QueueFailedService::class)->createFailed($failed);
    }
}