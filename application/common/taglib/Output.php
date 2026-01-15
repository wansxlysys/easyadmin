<?php


namespace app\common\taglib;


class Output extends TagLib
{
    /**
     * 标签定义
     * @var array[]
     */
    protected $tags = [
        'script' => ['attr' => 'identify,value', 'close' => 0]
    ];

    /**
     * 权限检测
     * {dictionary:list menu="1,2" condition="and"} {/dictionary:list}
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagScript($tag, $content)
    {
        return <<<TEMPLATE
    {php}
        echo tag_parser('OutputParser')
                ->add('data', {$this->parseVar($tag, 'data', true)})
                ->add('value', {$this->parseVar($tag, 'value', true)})
                ->getScript(); 
    {/php}
TEMPLATE;
    }
}