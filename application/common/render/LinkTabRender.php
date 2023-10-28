<?php


namespace app\common\render;


class LinkTabRender
{
    /**
     * 渲染
     * @param $tabs
     * @param $params
     * @param $action
     * @return string
     */
    public static function render($tabs, array $params, $action)
    {
        $render = '';
        $params = http_build_query($params);

        foreach ($tabs as $key => $item) {
            $render .= "<li " . ($action == $key ? 'class="layui-this"' : '') . "><a href='{$item['url']}?{$params}'>{$item['title']}</a></li>";
        }

        return '<ul class="layui-tab-title">' . $render . '</ul>';
    }
}