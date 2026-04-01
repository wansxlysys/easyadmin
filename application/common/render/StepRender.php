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
            <div class="one-step">
                {foreach $processes as $key => $process}
                <div class="one-step-item {if $step >= $key}one-step-over{/if}">
                    <div class="one-step-item-number">{$key}</div>
                    <div class="one-step-item-title">{$process.title}</div>
                    <div class="one-step-item-tips">{$process.tips}</div>
                </div>
                {/foreach}
            </div>';

        return View::display($template, ['step' => $step, 'processes' => $process]);
    }
}