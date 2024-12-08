<?php


namespace app\queue\exception;


use app\common\util\JsonUtil;
use app\queue\dependency\QueueFailedDependency;
use think\queue\Job;

class QueueExceptionHandler
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

        QueueFailedDependency::getService()->createFailed($failed);
    }
}