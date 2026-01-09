<?php


namespace app\common\taglib;


class Dictionary extends TagLib
{
    /**
     * 标签定义
     * @var array[]
     */
    protected $tags = [
        'list' => ['attr' => 'identify,value', 'close' => 1]
    ];

    /**
     * 权限检测
     * {dictionary:list menu="1,2" condition="and"} {/dictionary:list}
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagList($tag, $content)
    {
        return <<<TEMPLATE
    {php}
        \$dictList = tag_parser('DictionaryParser')
            ->add('identify', {$this->parseVar($tag, 'identify', true)})
            ->add('value', {$this->parseVar($tag, 'value', false)})
            ->getList(); 
    {/php}
    {volist name="\$dictList" id="dict"}
        $content
    {/volist}
TEMPLATE;
    }
}