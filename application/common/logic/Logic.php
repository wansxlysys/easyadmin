<?php


namespace app\common\logic;


abstract class Logic
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