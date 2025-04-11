<?php


namespace app\common\taglib;


class Permission extends TagLib
{
    /**
     * 标签定义
     * @var array[]
     */
    protected $tags = [
        'allow' => ['attr' => 'menu', 'close' => 1],
    ];

    /**
     * 权限检测
     * {permission:allow menu="1,2" condition="and"} 已授权 {else/} 未授权 {/permission:allow}
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagAllow($tag, $content)
    {
        $menu      = $this->quotesVar($tag['menu']);
        $condition = $this->quotesVar($tag['condition'] ?? 'and');

        $parse = '{if \app\admin\helper\SystemManagerHelper::checkAccessByMenuId(' . $menu . ', ' . $condition . ')}';
        $parse .= $content;
        $parse .= '{/if}';

        return $parse;
    }
}