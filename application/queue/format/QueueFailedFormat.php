<?php


namespace app\queue\format;


use app\common\util\JsonUtil;
use app\common\util\ArrayUtil;

class QueueFailedFormat
{
    /**
     * 格式化荷载
     * @param $data
     * @return mixed
     */
    public static function buildPayload(&$data)
    {
        if (!empty($data)) {
            $data['payload'] = ArrayUtil::toJson($data['payload']);
        }

        return $data;
    }

    /**
     * 格式化荷载
     * @param $data
     * @return mixed
     */
    public static function formatPayload(&$data)
    {
        if (!empty($data)) {
            $data['payload'] = JsonUtil::toArray($data['payload']);
        }

        return $data;
    }
}