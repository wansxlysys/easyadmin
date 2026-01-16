<?php


namespace app\common\taglib;


class Output extends TagLib
{
    /**
     * 标签定义
     * @var array[]
     */
    protected $tags = [
        'script' => ['attr' => 'name,value', 'close' => 0]
    ];

    /**
     * 权限检测
     * {output:script data="$data" value="value"}
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagScript($tag, $content)
    {
        return <<<TEMPLATE
    {php}
        echo tag_parser('OutputParser')
                ->add('name', {$this->parseVar($tag, 'name', true)})
                ->add('value', {$this->parseVar($tag, 'value', true)})
                ->getScript(); 
    {/php}
TEMPLATE;
    }
}