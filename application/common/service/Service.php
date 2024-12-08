<?php


namespace app\common\service;


abstract class Service
{
    /**
     * 格式化数据
     * @param array $data
     * @return array
     */
    public function formatData(array $data)
    {
        return $data;
    }

    /**
     * 格式化列表
     * @param array $list
     * @return array
     */
    public function formatList(array $list)
    {
        foreach ($list as $key => $data) {
            $list[$key] = $this->formatData($data);
        }

        return $list;
    }

    /**
     * 批量构建
     * @param array $list
     * @return array
     */
    public function buildList(array $list)
    {
        foreach ($list as $key => $data) {
            $list[$key] = $this->buildData($data);
        }

        return $list;
    }

    /**
     * 构建数据
     * @param array $data
     * @return array
     */
    public function buildData(array $data)
    {
        return $data;
    }
}