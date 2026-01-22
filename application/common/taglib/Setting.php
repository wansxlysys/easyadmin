<?php


namespace app\common\taglib;


class Setting extends TagLib
{
    /**
     * 标签定义
     * @var array[]
     */
    protected $tags = [
        'value' => ['attr' => 'identify', 'close' => 0]
    ];

    /**
     * 系统设置
     * {setting:value identify="system.captcha.enabled" /}
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagValue($tag, $content)
    {
        return <<<TEMPLATE
    {php} 
        echo tag_parser('SettingParser')
                ->add('identify', {$this->parseVar($tag, 'identify', true)})
                ->getValue(); 
    {/php}
TEMPLATE;
    }
}