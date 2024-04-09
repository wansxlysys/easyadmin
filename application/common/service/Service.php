<?php


namespace app\common\service;


abstract class Service
{
    /*
     * 导入业务特征
     */
    use Business;

    /**
     * 初始化
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