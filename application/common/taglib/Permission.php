<?php


namespace app\common\taglib;


class Permission extends TagLib
{
    /**
     * 标签定义
     * @var array[]
     */
    protected $tags = [
        'check' => ['attr' => 'menuIds,condition', 'close' => 1]
    ];

    /**
     * 权限检测
     * {permission:check menuIds="1,2" condition="and"} 已授权 {else/} 未授权 {/permission:check}
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagCheck($tag, $content)
    {
        return <<<TEMPLATE
    {if tag_parser('PermissionParser')
            ->add('menuIds', {$this->parseVar($tag, 'menuIds', true)})
            ->add('condition', {$this->parseVar($tag, 'condition', false, 'and')})
            ->check()}
        $content
    {/if}
TEMPLATE;
    }
}