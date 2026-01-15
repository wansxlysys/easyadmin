<?php


namespace app\common\render;


use think\facade\View;

class LinkTabRender
{
    /**
     * 渲染
     * @param array $tabList
     * @param array $params
     * @param $action
     * @return string
     */
    public static function render(array $tabList, array $params, $action)
    {
        $template = '
            <ul class="layui-tab-title">
                {foreach $tabList as $key => $tab}
                <li class="{if $action == $key}layui-this{/if}">
                    <a href="{$tab.url}?{:http_build_query($params)}">{$tab.title}</a>
                </li>
                {/foreach}
            </ul>';

        return View::display($template, ['params' => $params, 'action' => $action, 'tabList' => $tabList]);
    }
}