<?php


namespace app\Queue\service;


use Exception;

use app\Common\service\Service;
use app\Common\repository\Wrapper;

use app\Queue\format\QueueFailedFormat;
use app\Queue\repository\QueueFailedRepository;

class QueueFailedService extends Service
{
    /**
     * 存储类
     * @var QueueFailedRepository
     */
    protected QueueFailedRepository $QueueFailedRepository;

    /**
     * 获取失败列表
     * @throws Exception
     */
    public function getListFailed($queue)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addOrder('queueId', 'desc');
        $Wrapper->addWhere('queue', '=', $queue);

        return $this->QueueFailedRepository->getAll($Wrapper);
    }

    /**
     * 创建失败记录
     * @param array $data
     * @return int
     */
    public function createFailed(array $data)
    {
        return $this->QueueFailedRepository->createRecord(QueueFailedFormat::buildPayload($data));
    }

    /**
     * 删除失败记录
     * @param $id
     * @return int
     * @throws Exception
     */
    public function deleteFailed($id)
    {
        return $this->QueueFailedRepository->deleteById($id);
    }
}