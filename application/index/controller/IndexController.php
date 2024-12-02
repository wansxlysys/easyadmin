<?php


namespace app\index\controller;


use app\common\helper\ExcelHelper;

class IndexController
{
    /**
     * 首页
     * @return string
     */
    public function index_action()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div>';
    }

    public function test_action()
    {
        $readOptions = [
            '姓名' => ['field' => 'string', 'type' => 'string'],
            '年龄' => ['field' => 'int', 'type' => 'int'],
            '日期' => ['field' => 'date', 'type' => 'datetime', 'format' => 'Y-m-d'],
            '时间' => ['field' => 'time', 'type' => 'datetime', 'format' => 'H:m:s'],
            '入学' => ['field' => 'datetime', 'type' => 'datetime', 'format' => 'Y-m-d H:m:s'],
        ];

        $readData = ExcelHelper::read("C:/Users/liming/Desktop/read.xlsx", $readOptions);

        dump($readData);

        $writeOptions = [
            'name' => ['title' => '姓名', 'type' => 'string', 'explicit' => false],
            'age'  => ['title' => '年龄', 'type' => 'string', 'explicit' => false],
            'date' => ['title' => '日期', 'type' => 'string', 'explicit' => false],
            'tel'  => ['title' => '电话', 'type' => 'string', 'explicit' => true],
        ];

        $writeData = [
            ['name' => '张三', 'age' => 18, 'date' => '2024-12-01', 'tel' => '1889588889688999966'],
            ['name' => '李四', 'age' => 20, 'date' => '2024-12-01', 'tel' => 13858965874],
            ['name' => '王五', 'age' => 19, 'date' => '2024-12-01', 'tel' => 19589668558],
        ];

        ExcelHelper::save("C:/Users/liming/Desktop/write.xlsx", $writeOptions, $writeData);
    }
}