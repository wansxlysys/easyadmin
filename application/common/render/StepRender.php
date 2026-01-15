<?php


namespace app\common\render;


use think\facade\View;

class StepRender
{
    /**
     * 渲染
     * @param array $process
     * @param $step
     * @return string
     */
    public static function render(array $process, $step)
    {
        $template = '
            <div class="easy-step">
                {foreach $processes as $key => $process}
                <div class="easy-step-item {if $step >= $key}easy-step-over{/if}">
                    <div class="easy-step-item-number">{$key}</div>
                    <div class="easy-step-item-title">{$process.title}</div>
                    <div class="easy-step-item-tips">{$process.tips}</div>
                </div>
                {/foreach}
            </div>';

        return View::display($template, ['step' => $step, 'processes' => $process]);
    }
}