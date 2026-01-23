{extend name="common@layout/layout" /}

{block name="css"}
<style>
    .easy-info pre {
        font-family: 'Courier New', 'Consolas', 'Lucida Console', 'monospace';
    }
</style>
{/block}

{block name="content"}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            {assign name="menu" value=":service('SystemMenu')->getByMenuId($log.menuId)"}
            {assign name="manager" value=":service('SystemManager')->getByManagerId($log.managerId)"}
            <div class="easy-info">
                <div class="easy-info-grid easy-info-grid-100 easy-info-grid-center">
                    <div class="easy-info-grid-left">管理员头像：</div>
                    <div class="easy-info-grid-right">
                        <img src="{$manager.avatar}" width="35" height="35" class="layui-circle">
                    </div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">管理员姓名：</div>
                    <div class="easy-info-grid-right">{$manager.realName}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">管理员账号：</div>
                    <div class="easy-info-grid-right">{$manager.account}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">操作菜单：</div>
                    <div class="easy-info-grid-right">{$menu.name}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">操作状态：</div>
                    <div class="easy-info-grid-right">
                        {if $log.status == 1}<span class="layui-badge layui-bg-green">操作成功</span>{/if}
                        {if $log.status == 2}<span class="layui-badge">操作失败</span>{/if}
                    </div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">请求地址：</div>
                    <div class="easy-info-grid-right">{$log.requestUrl}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">请求IP：</div>
                    <div class="easy-info-grid-right">{$log.requestIp}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">操作时间：</div>
                    <div class="easy-info-grid-right">{$log.createTime}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">消耗时间：</div>
                    <div class="easy-info-grid-right">{$log.costTime}秒</div>
                </div>
                <div class="easy-info-grid easy-info-grid-100">
                    <div class="easy-info-grid-left">用户代理：</div>
                    <div class="easy-info-grid-right">{$log.userAgent}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-100">
                    <div class="easy-info-grid-left">操作信息：</div>
                    <div class="easy-info-grid-right">{$log.message}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-100">
                    <div class="easy-info-grid-left">请求参数：</div>
                    <div class="easy-info-grid-right">
                        <pre>{:json_encode(json_decode($log.params), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)}</pre>
                    </div>
                </div>
            </div>
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