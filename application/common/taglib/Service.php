<?php


namespace app\common\taglib;


class Service extends TagLib
{
    /**
     * 标签定义
     * @var array[]
     */
    protected $tags = [
        'invoke' => ['attr' => 'type,identify', 'close' => 0]
    ];

    /**
     * 权限检测
     * {service:invoke class="SystemSetting" method="getSystemSetting" module="admin" value="data" /}
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagInvoke($tag, $content)
    {
        return <<<TEMPLATE
    {php} 
        {$this->parseVal($tag, 'value')} = tag_parser('ServiceParser')
                ->add('class', {$this->parseVar($tag, 'class', true)})
                ->add('value', {$this->parseVar($tag, 'value', true)})
                ->add('method', {$this->parseVar($tag, 'method', true)})
                ->add('module', {$this->parseVar($tag, 'layer', false)})
                ->add('params', {$this->parseVar($tag, 'params', false)})
                ->add('wrapper', {$this->parseVar($tag, 'wrapper', false, true)})
                ->invoke(); 
    {/php}
TEMPLATE;
    }
}