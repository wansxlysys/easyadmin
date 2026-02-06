<?php


namespace app\common\taglib;


class Dictionary extends TagLib
{
    /**
     * 标签定义
     * @var array[]
     */
    protected $tags = [
        'tag'    => ['attr' => 'identify,value', 'close' => 0],
        'list'   => ['attr' => 'identify,value,name', 'close' => 1],
        'script' => ['attr' => 'identify,value,id', 'close' => 0],
    ];

    /**
     * 字典列表
     * {dictionary:list identify="identify" value="value"} {/dictionary:list}
     * @param $tag
     * @return string
     */
    public function tagTag($tag)
    {
        return <<<TEMPLATE
    {php}
        \$dictList = tag_parser('DictionaryParser')
            ->add('identify', {$this->parseVar($tag, 'identify', true)})
            ->add('value', {$this->parseVar($tag, 'value', false)})
            ->getList(); 
    {/php}
    {foreach \$dictList as \$key => \$dict}
        <span class="layui-badge {\$dict.style}">{\$dict.label}</span>
    {/foreach}
TEMPLATE;
    }

    /**
     * 字典列表
     * {dictionary:list name="dict" identify="identify" value="value"} {/dictionary:list}
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
    {foreach \$dictList as \$key => {$this->parseName($tag, 'name')}}
        $content
    {/foreach}
TEMPLATE;
    }

    /**
     * 字典脚本
     * {dictionary:script identify="identify" value="value"}
     * @param $tag
     * @return string
     */
    public function tagScript($tag)
    {
        return <<<TEMPLATE
    {php}
        \$dictList = tag_parser('DictionaryParser')
                ->add('identify', {$this->parseVar($tag, 'identify', true)})
                ->add('value', {$this->parseVar($tag, 'value', false)})
                ->getList();
    {/php}
    <script type="text/html" id="{$this->parseVal($tag, 'id')}"> 
        {foreach \$dictList as \$key => \$dict}
            {{# if(d.status == '{\$dict.value}'){ }}<span class="layui-badge {\$dict.style}">{\$dict.label}</span>{{# } }}
        {/foreach}
    </script>
TEMPLATE;
    }
}