<?php


namespace app\common\taglib;


class Permission extends TagLib
{
    /**
     * 标签定义
     * @var array[]
     */
    protected $tags = [
        'menu' => ['attr' => 'menuIds,condition', 'close' => 1],
        'code' => ['attr' => 'identify,condition', 'close' => 1],
    ];

    /**
     * 权限检测
     * {permission:menu menu="1,2" condition="and"} 已授权 {else/} 未授权 {/permission:menu}
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagMenu($tag, $content)
    {
        return <<<TEMPLATE
    {if tag_parser('PermissionParser')
            ->add('menuIds', {$this->parseVar($tag, 'menuIds', true)})
            ->add('condition', {$this->parseVar($tag, 'condition', false, 'and')})
            ->checkMenu()}
        $content
    {/if}
TEMPLATE;
    }

    /**
     * 权限检测
     * {permission:code code="sadasasd,sadasda" condition="and"} 已授权 {else/} 未授权 {/permission:code}
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagCode($tag, $content)
    {
        return <<<TEMPLATE
    {if tag_parser('PermissionParser')
            ->add('identify', {$this->parseVar($tag, 'identify', true)})
            ->add('condition', {$this->parseVar($tag, 'condition', false, 'and')})
            ->checkCode()}
        $content
    {/if}
TEMPLATE;
    }
}