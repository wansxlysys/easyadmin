<?php


namespace app\admin\format;


use app\common\util\JsonUtil;
use app\common\util\ArrayUtil;

class SystemRequestLogFormat
{
    /**
     * 构建数据
     * @param $data
     * @return mixed
     */
    public static function buildData(&$data)
    {
        if (is_array($data['params'])) {
            $data['params'] = ArrayUtil::toJson($data['params']);
        }

        if (is_array($data['cookie'])) {
            $data['cookie'] = ArrayUtil::toJson($data['cookie']);
        }

        return $data;
    }

    /**
     * 格式化url
     * @param $data
     * @return mixed|string
     */
    public static function formatParams(&$data)
    {
        if (!empty($data['params'])) {
            $data['params'] = JsonUtil::toArray($data['params']);
        }

        return $data;
    }
}