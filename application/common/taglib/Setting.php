<?php


namespace app\common\taglib;


class Setting extends TagLib
{
    /**
     * 标签定义
     * @var array[]
     */
    protected $tags = [
        'value' => ['attr' => 'type,identify', 'close' => 0]
    ];

    /**
     * 权限检测
     * {setting:value type="system" identify="name" /}
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagValue($tag, $content)
    {
        return <<<TEMPLATE
    {php} 
        echo tag_parser('SettingParser')
                ->add('type', {$this->parseVar($tag, 'type', true)})
                ->add('identify', {$this->parseVar($tag, 'identify', true)})
                ->getValue(); 
    {/php}
TEMPLATE;
    }
}