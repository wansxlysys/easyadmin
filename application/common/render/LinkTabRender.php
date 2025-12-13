<?php


namespace app\common\render;


class LinkTabRender
{
    /**
     * 渲染
     * @param $tabs
     * @param array $params
     * @param $action
     * @return string
     */
    public static function render($tabs, array $params, $action)
    {
        $render = '';
        $params = http_build_query($params);

        foreach ($tabs as $key => $item) {
            $render .= "<li " . ($action == $key ? 'class="layui-this"' : '') . ">";
            $render .= "    <a href='{$item['url']}?{$params}'>{$item['title']}</a>";
            $render .= "</li>";
        }

        return '<ul class="layui-tab-title">' . $render . '</ul>';
    }
}