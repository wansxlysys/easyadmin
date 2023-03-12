<?php


namespace app\common\service;


class Service
{
    /*
     * 导入业务特征
     */
    use Business;

    /**
     * Service constructor.
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * 初始化
     */
    protected function initialize()
    {

    }
}