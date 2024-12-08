<?php


namespace app\queue\service;


use Exception;

use app\common\repository\Wrapper;
use app\common\util\ArrayUtil;
use app\common\util\JsonUtil;

class QueueFailedService extends \app\common\service\QueueFailedService
{
    /**
     * 获取失败列表
     * @throws Exception
     */
    public function getFiledList($queue)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addOrder('id', 'desc');
        $Wrapper->addWhere('queue', '=', $queue);

        return $this->formatList($this->QueueFailedRepostitory->getAll($Wrapper));
    }

    /**
     * 创建失败记录
     * @param array $data
     * @return int
     */
    public function createFailed(array $data)
    {
        return $this->QueueFailedRepostitory->createRecord($this->buildData($data));
    }

    /**
     * 删除失败记录
     * @param $id
     * @return int
     * @throws Exception
     */
    public function deleteFaild($id)
    {
        return $this->QueueFailedRepostitory->deleteById($id);
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