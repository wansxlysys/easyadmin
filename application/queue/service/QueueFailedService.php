<?php


namespace app\queue\service;


use Exception;

use app\common\service\Service;
use app\common\util\JsonUtil;
use app\common\util\ArrayUtil;
use app\common\repository\Wrapper;

use app\queue\repository\QueueFailedRepository;

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

        $Wrapper->addOrder('id', 'desc');
        $Wrapper->addWhere('queue', '=', $queue);

        return $this->formatList($this->QueueFailedRepository->getAll($Wrapper));
    }

    /**
     * 创建失败记录
     * @param array $data
     * @return int
     */
    public function createFailed(array $data)
    {
        return $this->QueueFailedRepository->createRecord($this->buildData($data));
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

    /**
     * 格式化数据
     * @param array $data
     * @return array
     */
    public function formatData(array $data)
    {
        if (!empty($data['payload'])) {
            $data['payload'] = JsonUtil::toArray($data['payload']);
        }
        
        return $data;
    }

    /**
     * 构建数据
     * @param array $data
     * @return array
     */
    public function buildData(array $data)
    {
        if (!empty($data['payload'])) {
            $data['payload'] = ArrayUtil::toJson($data['payload']);
        }

        return $data;
    }
}