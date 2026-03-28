{extend name="common@layout/layout" /}

{block name="css"}
<style>
    html,
    body,
    .layui-card {
        height: 100%;
    }

    .system .system-cell {
        display: flex;
        height: 35px;
        line-height: 35px;
    }

    .system .system-cell .system-title {
        width: 100px;
    }

    .system .system-cell .system-value {
        color: #999;
    }
</style>
{/block}

{block name="content"}
<div class="layui-card">
    <div class="layui-card-body">
        <div class="system">
            {foreach $system as $key => $val}
            <div class="system-cell">
                <div class="system-title">{$key}</div>
                <div class="system-value">{$val}</div>
            </div>
            {/foreach}
        </div>
    </div>
</div>
{/block}

{block name="js"}
<script>
    layui.use(['easyModule'], function () {

    });
</script>
{/block}

