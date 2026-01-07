<?php


namespace app\common\taglib;


class Advert extends TagLib
{
    /**
     * 标签定义
     * @var array[]
     */
    protected $tags = [
        'list' => ['attr' => 'typeId,assign', 'close' => 0]
    ];


    /**
     * 广告列表
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagList($tag, $content)
    {
        return <<<TEMPLATE
    <?php
        {$this->parseVar($tag, 'assign', true)} = service('PluginAdvert', 'index')->listAdvert(
            params()
                ->add('typeId', {$this->parseVar($tag, 'typeId', false)})
                ->add('orderBy', {$this->parseVar($tag, 'orderBy', true, 'sort asc')})
                ->toArray()
            );
    ?>
TEMPLATE;
    }
}