<?php


namespace tests;


class ExampleTest extends BaseCase
{
    /**
     * 访问测试
     */
    public function testBasicExample()
    {
        $this->visit('/')->see('ThinkPHP');
    }
}