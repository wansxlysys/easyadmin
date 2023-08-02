<?php


namespace app\common\render;


class Step
{
    /**
     * 渲染
     * @param array $process
     * @param $step
     * @return string
     */
    public static function render(array $process, $step)
    {
        $render = '';

        foreach ($process as $key => $item) {
            $render .= '<div class="easy-step-item ' . ($step >= $key ? 'easy-step-over' : '') . '">';
            $render .= '    <div class="easy-step-item-number">' . $key . '</div>';
            $render .= '    <div class="easy-step-item-title">' . $item['title'] . '</div>';
            $render .= '    <div class="easy-step-item-tips">' . $item['tips'] . '</div>';
            $render .= '</div>';
        }

        return '<div class="easy-step">' . $render . '</div>';
    }
}