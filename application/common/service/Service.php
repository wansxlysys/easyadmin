<?php


namespace app\common\service;


abstract class Service
{
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